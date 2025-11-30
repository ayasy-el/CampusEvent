<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Portal Event Kampus')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- Tailwind CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- Alpine.js for Interactivity --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'ui-sans-serif', 'sans-serif'],
                    },
                    colors: {
                        pastelBlue: '#E4F0FF',
                        pastelPeach: '#FFE6D9',
                        pastelLilac: '#F1E4FF',
                    },
                },
            },
        };
    </script>

    @stack('head')
</head>

<body class="font-sans bg-slate-50 text-slate-900">
    <div class="min-h-screen bg-gradient-to-b from-pastelBlue/60 via-white to-pastelLilac/50">
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
