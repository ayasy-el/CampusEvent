@props(['event'])
<!-- BREADCRUMB -->
<nav class="text-[11px] md:text-xs text-slate-500 mb-3 md:mb-4">
    <a href="{{ route('home') }}" class="hover:text-slate-700">Beranda</a>
    <span class="mx-1">/</span>
    <a href="{{ route('events') }}" class="hover:text-slate-700">Semua Event</a>
    <span class="mx-1">/</span>
    <span class="text-slate-600">{{ $event['title'] ?? 'Detail Event' }}</span>
</nav>
