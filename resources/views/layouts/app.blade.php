<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Portal Event Kampus')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- Dark Mode Initial Script (HARUS di atas, prevent flash) --}}
    <script>
        (function() {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    {{-- Tailwind CDN v4 --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    {{-- Tailwind Config dengan darkMode selector --}}
    <style type="text/tailwindcss">
        @theme {
            --color-pastelBlue: #E4F0FF;
            --color-pastelPeach: #FFE6D9;
            --color-pastelLilac: #F1E4FF;
        }
        @variant dark (&:where(.dark, .dark *));
    </style>

    {{-- Alpine.js for Interactivity --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Hide x-cloak elements until Alpine loads --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
    @stack('head')
</head>

<body class="font-sans bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-100 transition-colors duration-300">
    <div class="min-h-screen bg-linear-to-b from-pastelBlue/60 via-white to-pastelLilac/50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 pb-16">

            {{-- NAVBAR --}}
            <x-navbar />

            {{-- MAIN CONTENT --}}
            @yield('content')

            {{-- FOOTER --}}
            <x-footer />
        </div>
    </div>

    @stack('scripts')
</body>

</html>
