<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService) {}

    public function index()
    {
        $selectedFilters = [
            'categories' => collect(request()->query('categories'))
                ->when(!is_array(request()->query('categories')), fn ($c) => collect(explode(',', request()->query('categories', ''))))
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
        ];

        $events = $this->eventService->getPublishedEvents($selectedFilters);
        $eventsCount = $events->count();
        $filters = $this->eventService->getFilterOptions();

        return view('pages.events.index', compact('events', 'eventsCount', 'filters', 'selectedFilters'));
    }

    public function show(string $slug)
    {
        $event = $this->eventService->getEventBySlug($slug);
        $relatedEvents = $this->eventService
            ->getPublishedEvents()
            ->reject(fn($item) => $item['slug'] === $slug)
            ->take(3);

        return view('pages.events.show', compact('event', 'relatedEvents'));
    }

    public function registered()
    {
        $user = User::first();

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
