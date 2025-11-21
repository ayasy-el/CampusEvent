<?php

namespace App\Http\Controllers;

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
}
