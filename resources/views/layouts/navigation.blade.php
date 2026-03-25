<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-xl border-b border-surface-200/60 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <x-application-logo class="w-9 h-9 rounded-xl" />
                        <span class="hidden sm:block text-lg font-display font-bold text-surface-900">StudyHub</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center ml-8 space-x-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="!px-3.5 !py-2 rounded-lg text-sm font-medium transition-all">
                        <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('mycourses')" :active="request()->routeIs('mycourses')"
                        class="!px-3.5 !py-2 rounded-lg text-sm font-medium transition-all">
                        <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        {{ __('Mis cursos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('marketplace')" :active="request()->routeIs('marketplace*')"
                        class="!px-3.5 !py-2 rounded-lg text-sm font-medium transition-all">
                        <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        {{ __('Marketplace') }}
                    </x-nav-link>

                    <x-nav-link :href="route('billinginfo')" :active="request()->routeIs('billinginfo')"
                        class="!px-3.5 !py-2 rounded-lg text-sm font-medium transition-all">
                        <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        {{ __('Pagos') }}
                    </x-nav-link>

                    @can('admin')
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')"
                            class="!px-3.5 !py-2 rounded-lg text-sm font-medium transition-all">
                            <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl hover:bg-surface-100 transition-colors duration-200 focus:outline-none">
                            <div class="relative">
                                @if (Auth::user()->profile->getMedia('users_avatar')->last())
                                    <img src="{{ Auth::user()->profile->getMedia('users_avatar')->last()->getUrl() }}"
                                        class="h-8 w-8 rounded-lg object-cover ring-2 ring-surface-200">
                                @else
                                    <div class="h-8 w-8 rounded-lg bg-primary-100 flex items-center justify-center ring-2 ring-primary-200">
                                        <span class="text-sm font-semibold text-primary-700">{{ substr(Auth::user()->username, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-accent-500 rounded-full border-2 border-white"></div>
                            </div>
                            <span class="text-sm font-medium text-surface-700">{{ Auth::user()->username }}</span>
                            <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-surface-100">
                            <p class="text-sm font-medium text-surface-900">{{ Auth::user()->username }}</p>
                            <p class="text-xs text-surface-500 mt-0.5">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 py-2.5">
                            <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('Mi Perfil') }}
                        </x-dropdown-link>

                        <div class="border-t border-surface-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="flex items-center gap-2 py-2.5 text-danger-600 hover:text-danger-700"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="btn-icon">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-surface-200">
        <div class="py-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="rounded-lg">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('mycourses')" class="rounded-lg">
                {{ __('Mis cursos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('marketplace')" class="rounded-lg">
                {{ __('Marketplace') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('billinginfo')" class="rounded-lg">
                {{ __('Pagos') }}
            </x-responsive-nav-link>
            @can('admin')
                <x-responsive-nav-link :href="route('admin.index')" class="rounded-lg">
                    {{ __('Admin') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <div class="pt-4 pb-3 border-t border-surface-200 px-4">
            <div class="flex items-center gap-3 px-2 mb-3">
                @if (Auth::user()->profile->getMedia('users_avatar')->last())
                    <img src="{{ Auth::user()->profile->getMedia('users_avatar')->last()->getUrl() }}"
                        class="h-10 w-10 rounded-lg object-cover">
                @else
                    <div class="h-10 w-10 rounded-lg bg-primary-100 flex items-center justify-center">
                        <span class="text-sm font-bold text-primary-700">{{ substr(Auth::user()->username, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <div class="font-medium text-sm text-surface-900">{{ Auth::user()->username }}</div>
                    <div class="text-xs text-surface-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-lg">
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="rounded-lg text-danger-600"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
