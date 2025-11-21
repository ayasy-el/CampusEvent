<header class="sticky top-0 pt-4 md:pt-6 mb-4 md:mb-8 z-[9999]">
    <div
        class="flex items-center justify-between bg-white/80 backdrop-blur rounded-full px-4 md:px-6 py-2.5 shadow-sm border border-slate-100 relative z-[9999]">
        <a href="{{ route('home') }}" class="flex items-center gap-2 md:gap-3">
            <div
                class="w-9 h-9 md:w-10 md:h-10 rounded-2xl bg-gradient-to-tr from-sky-400 to-indigo-500 flex items-center justify-center text-white text-xs md:text-sm font-bold">
                EC
            </div>
            <div>
                <p class="text-[11px] uppercase tracking-wide text-slate-500">Portal</p>
                <p class="text-sm md:text-base font-semibold text-slate-800">Event Kampus</p>
            </div>
        </a>


        @php
            $authUser = app(\App\Services\FilamentAuthService::class)->getAuthenticatedUser();
            $loginRoute = collect(['filament.auth.login', 'filament.admin.auth.login', 'login'])->first(
                fn($route) => \Illuminate\Support\Facades\Route::has($route),
            );
            $logoutRoute = collect(['filament.auth.logout', 'filament.admin.auth.logout', 'logout'])->first(
                fn($route) => \Illuminate\Support\Facades\Route::has($route),
            );
        @endphp

        <div class="flex items-center gap-2 md:gap-3">
            @if (!$authUser && $loginRoute)
                <a href="{{ route($loginRoute) }}"
                    class="text-sm font-semibold hidden md:inline-flex px-4 py-2 rounded-full border border-slate-200 text-slate-700 hover:bg-slate-100">
                    Login
                </a>
            @else
                <div class="relative z-[99999]" id="userMenuWrapper">
                    <!-- Trigger -->
                    <button id="userMenuButton" type="button"
                        class="cursor-pointer flex items-center gap-2 rounded-full bg-slate-900 text-white pl-1.5 pr-2.5 py-1.5 text-xs md:text-sm shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/60">
                        <span
                            class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-[url('{{ $authUser->avatar_url ?? 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png?20170328184010' }}')] bg-cover bg-center border border-white/80"></span>
                        <span class="hidden sm:flex flex-col items-start leading-tight">
                            <span class="font-semibold">{{ $authUser->name ?? 'Pengguna' }}</span>
                            <span class="text-[10px] text-slate-300">{{ $authUser->email ?? 'Mahasiswa' }}</span>
                        </span>
                        <span class="ml-1 text-[11px] md:text-xs text-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="transform: scale(0.75);">
                                <path fill="currentColor"
                                    d="M18 9c.852 0 1.297.986.783 1.623l-.076.084l-6 6a1 1 0 0 1-1.32.083l-.094-.083l-6-6l-.083-.094l-.054-.077l-.054-.096l-.017-.036l-.027-.067l-.032-.108l-.01-.053l-.01-.06l-.004-.057v-.118l.005-.058l.009-.06l.01-.052l.032-.108l.027-.067l.07-.132l.065-.09l.073-.081l.094-.083l.077-.054l.096-.054l.036-.017l.067-.027l.108-.032l.053-.01l.06-.01l.057-.004z" />
                            </svg>
                        </span>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="userMenu"
                        class="absolute right-0 mt-2 w-48 md:w-52 bg-white border border-slate-100 rounded-2xl shadow-lg shadow-slate-200/80 py-1.5 text-xs md:text-sm text-slate-700 hidden z-[10000]">
                        <div class="px-3 py-2 border-b border-slate-100">
                            <p class="text-[11px] uppercase tracking-wide text-slate-400 mb-1">Akun</p>
                            <p class="text-xs font-semibold text-slate-900 truncate">{{ $authUser->name ?? 'Pengguna' }}
                            </p>
                            <p class="text-[11px] text-slate-500 truncate">{{ $authUser->email ?? '-' }}</p>
                        </div>

                        <nav class="py-1">
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-2 px-3 py-1.5 hover:bg-slate-50">
                                <span>👤</span>
                                <span>Profile Saya</span>
                            </a>
                            <a href="{{ route('my_events') }}"
                                class="flex items-center gap-2 px-3 py-1.5 hover:bg-slate-50">
                                <span>📅</span>
                                <span>My Events</span>
                            </a>
                        </nav>

                        @if ($logoutRoute)
                            <div class="border-t border-slate-100 mt-1 pt-1">
                                <form method="POST" action="{{ route($logoutRoute) }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2 px-3 py-1.5 text-left text-red-500 hover:bg-red-50">
                                        <span>🚪</span>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</header>


@once
    @push('scripts')
        <script>
            (function() {
                const wrapper = document.getElementById('userMenuWrapper');
                const button = document.getElementById('userMenuButton');
                const menu = document.getElementById('userMenu');

                if (!wrapper || !button || !menu) return;

                // Toggle saat button diklik
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });

                // Klik di luar dropdown -> tutup
                document.addEventListener('click', function(e) {
                    if (!wrapper.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                });

                // ESC untuk tutup
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        menu.classList.add('hidden');
                    }
                });
            })
            ();
        </script>
    @endpush
@endonce
