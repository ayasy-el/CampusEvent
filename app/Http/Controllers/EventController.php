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
        $events = $this->eventService->getPublishedEvents();
        $eventsCount = $events->count();

        return view('pages.events.index', compact('events', 'eventsCount'));
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
