<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Services\FilamentAuthService;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService, private FilamentAuthService $filamentAuthService) {}

    public function index()
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();
        $registeredEvents = $user
            ? $this->eventService->getRegisteredEventsForUser($user, 'upcoming')->take(3)
            : collect();
        $registeredEventsCount = $user
            ? $this->eventService->getRegisteredEventsForUser($user)->count()
            : 0;

        $selectedFilters = [
            'categories' => collect(request()->query('categories'))
                ->when(!is_array(request()->query('categories')), fn($c) => collect(explode(',', request()->query('categories', ''))))
                ->filter()
                ->unique()
                ->values()
                ->all(),
            'date' => request()->query('date'),
            'mode' => request()->query('mode'),
            'price' => request()->query('price'),
            'status' => request()->query('status'),
            'date_from' => request()->query('date_from'),
            'date_to' => request()->query('date_to'),
            'location' => request()->query('location'),
            'q' => request()->query('q'),
            'sort' => request()->query('sort', 'upcoming'),
        ];

        $registeredEventIds = $user
            ? $this->eventService->getRegisteredEventIds($user)
            : [];

        $events = $this->eventService->getPublishedEvents([
            ...$selectedFilters,
            'exclude_event_ids' => $registeredEventIds,
        ], true, 6);

        $totalActiveEvents = $this->eventService->getPublishedEvents($selectedFilters)->count();
        $eventsCount = $events->total();
        $filters = $this->eventService->getFilterOptions();

        return view('pages.events.index', compact(
            'user',
            'events',
            'eventsCount',
            'filters',
            'selectedFilters',
            'registeredEvents',
            'registeredEventsCount',
            'totalActiveEvents'
        ));
    }

    public function show(string $slug)
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();

        $event = $this->eventService->getEventBySlug($slug, $user);
        $relatedEvents = $this->eventService
            ->getPublishedEvents(['date' => 'upcoming'])
            ->reject(fn($item) => $item['slug'] === $slug)
            ->shuffle()
            ->take(3);

        return view('pages.events.show', compact('user', 'event', 'relatedEvents'));
    }

    public function register(string $slug)
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();

        if (!$user) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login untuk mendaftar event.');
        }

        $result = $this->eventService->registerUserForEvent($user, $slug);
        $flashKey = $result['status'] === 'success' ? 'success' : 'error';

        return redirect()
            ->route('event_detail', ['slug' => $slug])
            ->with($flashKey, $result['message'])
            ->with('registration_status', $result['status']);
    }

    public function registered()
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();

        if (!$user || $user->role !== 'mahasiswa') {
            return redirect()->route('home');
        }

        $upcomingEvents = $user
            ? $this->eventService->getRegisteredEventsForUser($user, 'upcoming')
            : collect();
        $pastEvents = $user
            ? $this->eventService->getRegisteredEventsForUser($user, 'past')
            : collect();

        $totalEvents = $upcomingEvents->count() + $pastEvents->count();

        return view('pages.events.registered', compact('upcomingEvents', 'pastEvents', 'totalEvents'));
    }
}
