<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EventService
{
    /**
     * Ambil daftar event yang sudah dipublikasikan dengan data siap pakai untuk komponen.
     * $filters:
     *  - category: slug string (boleh list, dipisah koma)
     *  - date: upcoming|today|week|month|all
     *  - mode: onsite|online|hybrid|all
     *  - price: free|paid
     *  - status: open|closed
     *  - date_from/date_to: Y-m-d
     *  - location: string (search)
     *  - q: keyword
     *  - sort: upcoming|newest|popular|az
     */
    public function getPublishedEvents(array $filters = [], bool $paginate = false, int $perPage = 12)
    {
        $dateFilter = $filters['date'] ?? null;
        $categoryFilter = $filters['categories'] ?? [];
        $modeFilter = $filters['mode'] ?? null;
        $priceFilter = $filters['price'] ?? null;
        $registrationStatus = $filters['status'] ?? null;
        $dateFrom = $filters['date_from'] ?? null;
        $dateTo = $filters['date_to'] ?? null;
        $location = $filters['location'] ?? null;
        $search = $filters['q'] ?? $filters['search'] ?? null;
        $sort = $filters['sort'] ?? 'upcoming';
        $excludeIds = collect($filters['exclude_event_ids'] ?? [])->filter()->values();

        $event = Event::query()
            ->with('categories')
            ->withCount('attendees')
            ->where('status', 'published');

        if ($search) {
            $event->where(function ($q) use ($search) {
                $q->where('title', 'ILIKE', "%{$search}%")
                    ->orWhere('organizer', 'ILIKE', "%{$search}%")
                    ->orWhere('excerpt', 'ILIKE', "%{$search}%");
            });
        }

        // Quick date filters
        if ($dateFilter) {
            match ($dateFilter) {
                'today' => $event->whereDate('date', Carbon::today()),
                'week' => $event->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]),
                'month' => $event->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]),
                'upcoming' => $event->whereDate('date', '>=', Carbon::today()),
                default => null,
            };
        }

        // Range date filter overrides quick ones when provided
        if ($dateFrom || $dateTo) {
            $start = $dateFrom ? Carbon::parse($dateFrom) : Carbon::today();
            $end = $dateTo ? Carbon::parse($dateTo) : Carbon::today()->addYears(5);
            $event->whereBetween('date', [$start, $end]);
        }

        // Category filter
        $categoryFilters = collect(
            is_array($categoryFilter)
                ? $categoryFilter
                : explode(',', (string) $categoryFilter)
        )
            ->filter()
            ->map(fn($cat) => Str::slug($cat))
            ->unique()
            ->values();

        if ($categoryFilters->isNotEmpty()) {
            $event->whereHas('categories', function ($q) use ($categoryFilters) {
                $q->whereIn(
                    DB::raw("LOWER(REPLACE(name, ' ', '-'))"),
                    $categoryFilters->all()
                );
            });
        }

        // Mode filter
        $modeMap = [
            'onsite' => 'offline',
            'online' => 'online',
            'hybrid' => 'hybrid',
        ];
        if ($modeFilter && isset($modeMap[$modeFilter])) {
            $event->where('location_type', $modeMap[$modeFilter]);
        }

        // Price filter
        if ($priceFilter === 'free') {
            $event->where('price', 0);
        } elseif ($priceFilter === 'paid') {
            $event->where('price', '>', 0);
        }

        // Registration status filter
        if ($registrationStatus === 'open') {
            $event->whereDate('date', '>', Carbon::today())
                ->where('status', 'published');
        } elseif ($registrationStatus === 'closed') {
            $event->where(function ($q) {
                $q->where('status', 'closed')
                    ->orWhereDate('date', '<=', Carbon::today());
            });
        }

        // Location search
        if ($location) {
            $event->where('location_address', 'like', '%' . $location . '%');
        }

        if ($excludeIds->isNotEmpty()) {
            $event->whereNotIn('id', $excludeIds->all());
        }

        // Sorting
        switch ($sort) {
            case 'newest':
                $event->orderByDesc('created_at');
                break;
            case 'popular':
                $event->orderByDesc('attendees_count')->orderBy('date');
                break;
            case 'az':
                $event->orderBy('title');
                break;
            case 'upcoming':
            default:
                $event->orderBy('date');
                break;
        }

        if ($paginate) {
            return $event
                ->paginate($perPage)
                ->through(fn(Event $event) => $this->transformEvent($event));
        }

        return $event
            ->get()
            ->map(fn(Event $event) => $this->transformEvent($event));
    }

    /**
     * Ambil detail event berdasarkan slug.
     */
    public function getEventBySlug(string $slug, ?User $user = null): array
    {
        $event = Event::query()
            ->with(['categories', 'speakers'])
            ->withCount('attendees')
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->transformEventDetail($event, $user);
    }

    /**
     * Ambil event yang diikuti user, bisa difilter upcoming/past/all.
     */
    public function getRegisteredEventsForUser(User $user, string $status = 'all'): Collection
    {
        $query = Event::query()
            ->whereHas('attendees', fn($q) => $q->where('user_id', $user->id))
            ->with('categories')
            ->withCount('attendees')
            ->orderBy('date');

        if ($status === 'upcoming') {
            $query->whereDate('date', '>=', now()->toDateString());
        } elseif ($status === 'past') {
            $query->whereDate('date', '<', now()->toDateString());
        }

        return $query->get()->map(function (Event $event) {
            $data = $this->transformEvent($event);
            $data['card_status'] = $this->resolveCardStatusForRegistered($event);
            return $data;
        });
    }

    /**
     * Daftarkan user ke event tertentu.
     */
    public function registerUserForEvent(User $user, string $slug): array
    {
        if ($user->role !== 'mahasiswa') {
            return [
                'status' => 'forbidden',
                'message' => 'Hanya mahasiswa yang dapat mendaftar event.',
            ];
        }

        return DB::transaction(function () use ($user, $slug) {
            $event = Event::query()
                ->where('slug', $slug)
                ->where('status', 'published')
                ->lockForUpdate()
                ->withCount('attendees')
                ->firstOrFail();

            if ($event->date->isPast()) {
                return [
                    'status' => 'closed',
                    'message' => 'Pendaftaran sudah ditutup karena event telah berlangsung.',
                ];
            }

            $alreadyRegistered = $event->attendees()
                ->where('user_id', $user->id)
                ->exists();

            if ($alreadyRegistered) {
                return [
                    'status' => 'already_registered',
                    'message' => 'Kamu sudah terdaftar di event ini.',
                ];
            }

            $isQuotaFull = $event->quota > 0 && $event->attendees_count >= $event->quota;
            if ($isQuotaFull) {
                return [
                    'status' => 'quota_full',
                    'message' => 'Kuota event sudah penuh.',
                ];
            }

            $event->attendees()->attach($user->id);

            return [
                'status' => 'success',
                'message' => 'Pendaftaran berhasil! Sampai jumpa di acara.',
            ];
        });
    }

    /**
     * Batalkan pendaftaran event untuk user (hapus relasi pivot).
     */
    public function cancelRegistration(User $user, string $slug): array
    {
        if ($user->role !== 'mahasiswa') {
            return [
                'status' => 'forbidden',
                'message' => 'Hanya mahasiswa yang dapat membatalkan pendaftaran.',
            ];
        }

        return DB::transaction(function () use ($user, $slug) {
            $event = Event::query()
                ->where('slug', $slug)
                ->lockForUpdate()
                ->firstOrFail();

            $isRegistered = $event->attendees()
                ->where('user_id', $user->id)
                ->exists();

            if (!$isRegistered) {
                return [
                    'status' => 'not_registered',
                    'message' => 'Kamu belum terdaftar di event ini.',
                ];
            }

            $event->attendees()->detach($user->id);

            return [
                'status' => 'success',
                'message' => 'Pendaftaran berhasil dibatalkan.',
            ];
        });
    }

    /**
     * Ambil daftar ID event yang sudah diikuti user.
     */
    public function getRegisteredEventIds(User $user): array
    {
        return $user->events()->pluck('events.id')->all();
    }

    /**
     * Data opsi filter untuk halaman daftar event.
     */
    public function getFilterOptions(): array
    {
        return [
            'categories' => Category::query()
                ->orderBy('name')
                ->get()
                ->map(fn(Category $cat) => [
                    'value' => Str::slug($cat->name),
                    'label' => $cat->name,
                ]),
            'dateFilters' => collect([
                ['value' => 'today', 'label' => 'Hari ini'],
                ['value' => 'week', 'label' => 'Minggu ini'],
                ['value' => 'month', 'label' => 'Bulan ini'],
            ]),
            'modeFilters' => collect([
                ['value' => 'onsite', 'label' => 'On-site'],
                ['value' => 'online', 'label' => 'Online'],
                ['value' => 'hybrid', 'label' => 'Hybrid'],
            ]),
            'priceFilters' => collect([
                ['value' => 'free', 'label' => 'Gratis'],
                ['value' => 'paid', 'label' => 'Berbayar'],
            ]),
            'registrationStatus' => collect([
                ['value' => 'open', 'label' => 'Masih Dibuka'],
                ['value' => 'closed', 'label' => 'Ditutup'],
            ]),
        ];
    }

    protected function transformEvent(Event $event): array
    {
        $category = $event->categories->first();
        $categoryName = $category?->name ?? 'Umum';
        $categorySlug = Str::slug($categoryName);

        $registered = $event->attendees_count ?? $event->attendees()->count();
        $quotaInfo = $this->getQuotaInfo($event->quota, $registered);
        $price = $event->price ?? 0;

        return [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->title,
            'category' => $categoryName,
            'category_slug' => $categorySlug,
            'category_icon' => $this->getCategoryIcon($categorySlug),
            'mode' => $this->formatMode($event->location_type),
            'image' => $this->resolveImageUrl($event->image),
            'organizer' => $event->organizer,
            'location' => $this->formatLocation($event),
            'time' => $this->formatTime($event->start_time, $event->end_time),
            'benefit' => $event->benefits ?? '',
            'registered' => $registered,
            'quota_info' => $quotaInfo,
            'price' => $price,
            'price_display' => $price > 0 ? 'Rp ' . number_format($price, 0, ',', '.') : 'Gratis',
            'date' => $event->date,
            'card_status' => $this->resolveCardStatus($event),
            'start_time_obj' => $event->start_time,
            'end_time_obj' => $event->end_time,
            'categories_collection' => $event->categories,
        ];
    }

    protected function transformEventDetail(Event $event, ?User $user = null): array
    {
        $base = $this->transformEvent($event);
        $price = $event->price ?? 0;
        $isRegistered = $user
            ? $event->attendees()->where('user_id', $user->id)->exists()
            : false;

        return array_merge($base, [
            'excerpt' => $event->excerpt,
            'description' => $event->description,
            'agenda' => $event->agenda ?? [],
            'categories_collection' => $event->categories,
            'speakers' => $event->speakers->map(function ($speaker) {
                return [
                    'name' => $speaker->name,
                    'title' => $speaker->title,
                    'bio' => $speaker->bio,
                    'photo' => $speaker->photo,
                    'is_moderator' => $speaker->pivot?->is_moderator,
                ];
            })->all(),
            'quota' => $event->quota,
            'status' => $event->status,
            'price' => $price,
            'price_display' => $price > 0 ? 'Rp ' . number_format($price, 0, ',', '.') : 'Gratis',
            'location_type' => $event->location_type,
            'location_address' => $event->location_address,
            'contact_email' => $event->contact_email,
            'contact_phone' => $event->contact_phone,
            'attendees_count' => $event->attendees_count,
            'registration_status' => $this->resolveRegistrationStatus($event, $isRegistered),
            'is_registered' => $isRegistered,
        ]);
    }

    protected function getCategoryIcon(string $categorySlug): string
    {
        return match ($categorySlug) {
            'seminar' => '🎓',
            'workshop' => '🛠️',
            'kompetisi' => '🏆',
            'webinar' => '💻',
            'pelatihan' => '📚',
            'karir-magang' => '💼',
            'komunitas' => '🤝',
            default => '📅',
        };
    }

    protected function formatMode(?string $mode): string
    {
        return match ($mode) {
            'offline' => 'onsite',
            'online' => 'online',
            default => 'hybrid',
        };
    }

    protected function formatLocation(Event $event): string
    {
        return match ($event->location_type) {
            'online' => 'Online',
            default => $event->location_address ?: 'Lokasi belum ditentukan',
        };
    }

    protected function formatTime($startTime, $endTime): string
    {
        $start = $startTime ? $startTime->format('H.i') : '';
        $end = $endTime ? $endTime->format('H.i') : '';

        if ($start && $end) {
            return "{$start} – {$end}";
        }

        return $start ?: '-';
    }

    /**
     * Pastikan path gambar dari Filament dapat diakses publik.
     */
    protected function resolveImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        $disk = config('filament.default_filesystem_disk') ?? config('filesystems.default', 'public');

        // Filament sering pakai default disk; jika masih "local" (private), pakai public agar bisa diakses.
        if ($disk === 'local') {
            $disk = 'public';
        }

        if (Storage::disk($disk)->exists($path)) {
            return asset('storage/' . ltrim($path, '/'));
        }

        if (Storage::exists($path)) {
            return Storage::url($path);
        }

        return $path;
    }

    protected function getQuotaInfo(int $quota, int $registered): string
    {
        if ($quota > 0) {
            if ($registered >= $quota) {
                return 'Kuota penuh';
            }

            if ($registered >= ($quota * 0.8)) {
                return 'Kuota hampir penuh';
            }
        }

        return 'Kuota tersedia';
    }

    protected function resolveCardStatus(Event $event): string
    {
        if ($event->status === 'closed' || $event->date->isPast()) {
            return 'finished';
        }

        return 'open';
    }

    protected function resolveCardStatusForRegistered(Event $event): string
    {
        return $event->date->isPast() || $event->status === 'closed'
            ? 'finished'
            : 'registered';
    }

    protected function resolveRegistrationStatus(Event $event, bool $isRegistered): string
    {
        if ($isRegistered) {
            return 'registered';
        }

        if ($event->date->isPast()) {
            return 'finished';
        }

        if ($event->status !== 'published') {
            return 'closed';
        }

        $registeredCount = $event->attendees_count ?? $event->attendees()->count();
        if ($event->quota > 0 && $registeredCount >= $event->quota) {
            return 'full';
        }

        return 'open';
    }
}
