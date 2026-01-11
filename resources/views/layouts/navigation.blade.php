<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <x-application-logo class="block h-9 w-auto fill-current text-ink" />
                    <span class="font-semibold text-ink hidden sm:block">Wisata Paluta</span>
                </a>

                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'text-ink' : 'text-muted' }} hover:text-ink text-sm font-medium">
                        Beranda
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="{{ request()->routeIs('dashboard') ? 'text-ink' : 'text-muted' }} hover:text-ink text-sm font-medium">
                            Dashboard
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.wisata.index') }}"
                               class="{{ (request()->routeIs('admin.wisata.index') || request()->routeIs('admin.wisata.edit')) ? 'text-ink' : 'text-muted' }} hover:text-ink text-sm font-medium">
                                Kelola Wisata
                            </a>

                            <a href="{{ route('admin.wisata.create') }}"
                               class="{{ request()->routeIs('admin.wisata.create') ? 'text-ink' : 'text-muted' }} hover:text-ink text-sm font-medium">
                                Tambah Wisata
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition">
                                <span class="text-sm font-medium text-ink">{{ auth()->user()?->name }}</span>
                                <svg class="h-4 w-4 text-muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 text-sm text-muted">
                                <div class="font-medium text-ink">{{ auth()->user()?->name }}</div>
                                <div class="text-xs">{{ auth()->user()?->email }}</div>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-muted hover:text-ink">Login</a>
                    <x-btn href="{{ route('register') }}">Sign up</x-btn>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-muted hover:text-ink hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="block text-sm font-medium {{ request()->routeIs('home') ? 'text-ink' : 'text-muted' }}">
                Beranda
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="block text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-ink' : 'text-muted' }}">
                    Dashboard
                </a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.wisata.index') }}" class="block text-sm font-medium {{ (request()->routeIs('admin.wisata.index') || request()->routeIs('admin.wisata.edit')) ? 'text-ink' : 'text-muted' }}">
                        Kelola Wisata
                    </a>

                    <a href="{{ route('admin.wisata.create') }}" class="block text-sm font-medium {{ request()->routeIs('admin.wisata.create') ? 'text-ink' : 'text-muted' }}">
                        Tambah Wisata
                    </a>
                @endif

                <div class="pt-3 border-t border-gray-100">
                    <div class="text-sm font-medium text-ink">{{ auth()->user()?->name }}</div>
                    <div class="text-xs text-muted">{{ auth()->user()?->email }}</div>
                    <div class="mt-3 space-y-2">
                        <a href="{{ route('profile.edit') }}" class="block text-sm text-muted hover:text-ink">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-sm text-muted hover:text-ink">Log Out</button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div class="pt-3 border-t border-gray-100 flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-muted hover:text-ink">Login</a>
                    <x-btn href="{{ route('register') }}">Sign up</x-btn>
                </div>
            @endguest
        </div>
    </div>
</nav>
