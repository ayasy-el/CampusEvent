<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EventService
{
    /**
     * Ambil daftar event yang sudah dipublikasikan dengan data siap pakai untuk komponen.
     * $status : "upcoming" | "past" | "all"
     */
    public function getPublishedEvents(string $status = "upcoming"): Collection
    {
        $event = Event::query()
            ->with('categories')
            ->withCount('attendees')
            ->where('status', 'published')
            ->orderBy('date');

        if ($status === 'upcoming') {
            $event->whereDate('date', '>=', now()->toDateString());
        } elseif ($status === 'past') {
            $event->whereDate('date', '<', now()->toDateString());
        }

        return $event
            ->get()
            ->map(fn (Event $event) => $this->transformEvent($event));
    }

    /**
     * Ambil detail event berdasarkan slug.
     */
    public function getEventBySlug(string $slug): array
    {
        $event = Event::query()
            ->with(['categories', 'speakers'])
            ->withCount('attendees')
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->transformEventDetail($event);
    }

    /**
     * Ambil event yang diikuti user, bisa difilter upcoming/past/all.
     */
    public function getRegisteredEventsForUser(User $user, string $status = 'all'): Collection
    {
        $query = Event::query()
            ->whereHas('attendees', fn ($q) => $q->where('user_id', $user->id))
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

    protected function transformEvent(Event $event): array
    {
        $category = $event->categories->first();
        $categoryName = $category?->name ?? 'Umum';
        $categorySlug = Str::slug($categoryName); // Todo: nanti ganti pakai query filter saja

        $registered = $event->attendees_count;
        $quotaInfo = $this->getQuotaInfo($event->quota, $registered);

        return [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->title,
            'category' => $categoryName,
            'category_slug' => $categorySlug,
            'category_icon' => $this->getCategoryIcon($categorySlug),
            'mode' => $this->formatMode($event->location_type),
            'image' => $event->image,
            'organizer' => $event->organizer,
            'location' => $this->formatLocation($event),
            'time' => $this->formatTime($event->start_time, $event->end_time),
            'benefit' => $event->benefits ?? '',
            'registered' => $registered,
            'quota_info' => $quotaInfo,
            'date' => $event->date,
            'card_status' => $this->resolveCardStatus($event),
            'start_time_obj' => $event->start_time,
            'end_time_obj' => $event->end_time,
        ];
    }

    protected function transformEventDetail(Event $event): array
    {
        $base = $this->transformEvent($event);
        $price = $event->price ?? 0;

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
}
