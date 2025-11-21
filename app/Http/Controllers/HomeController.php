<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\EventService;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function __construct(protected EventService $eventService) {}

    public function home()
    {
        $events = $this->eventService
            ->getPublishedEvents(['date' => 'upcoming', 'sort' => 'upcoming']);

        $upcomingEvents = $events->take(3);
        $eventsCount = $events->count();

        $featuredEvent = $this->eventService
            ->getPublishedEvents(['date' => 'upcoming', 'sort' => 'popular'])
            ->first() ?? $upcomingEvents->first();

        $categories = Category::query()
            ->orderBy('name')
            ->get()
            ->map(fn(Category $category) => [
                'title' => $category->name,
                'slug' => Str::slug($category->name),
            ]);

        return view('pages.home', compact('upcomingEvents', 'featuredEvent', 'categories', 'eventsCount'));
    }
}
