<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">{{ __('Panel de Administración') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-display font-bold text-surface-900">
                Panel de Administración
            </h1>
            <p class="mt-1 text-surface-500">Gestiona usuarios, cursos, categorías y roles de la plataforma.</p>
        </div>

        {{-- Admin Navigation Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Users --}}
            <a href="/admin/users" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-primary-200">
                <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center mb-5 group-hover:bg-primary-100 transition-colors">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 mb-1 group-hover:text-primary-700 transition-colors">Usuarios</h3>
                <p class="text-sm text-surface-500">Gestiona cuentas, roles y permisos de usuarios.</p>
                <div class="mt-4 flex items-center text-sm font-medium text-primary-600 group-hover:text-primary-700">
                    Gestionar
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>

            {{-- Courses --}}
            <a href="/admin/courses" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-accent-200">
                <div class="w-14 h-14 rounded-2xl bg-accent-50 flex items-center justify-center mb-5 group-hover:bg-accent-100 transition-colors">
                    <svg class="w-7 h-7 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 mb-1 group-hover:text-accent-700 transition-colors">Cursos</h3>
                <p class="text-sm text-surface-500">Crea, edita y valida los cursos de la plataforma.</p>
                <div class="mt-4 flex items-center text-sm font-medium text-accent-600 group-hover:text-accent-700">
                    Gestionar
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>

            {{-- Categories --}}
            <a href="/admin/categories" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-warning-200">
                <div class="w-14 h-14 rounded-2xl bg-warning-50 flex items-center justify-center mb-5 group-hover:bg-warning-100 transition-colors">
                    <svg class="w-7 h-7 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 mb-1 group-hover:text-warning-600 transition-colors">Categorías</h3>
                <p class="text-sm text-surface-500">Administra las categorías de los cursos.</p>
                <div class="mt-4 flex items-center text-sm font-medium text-warning-600 group-hover:text-warning-500">
                    Gestionar
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>

            {{-- Roles --}}
            <a href="/admin/roles" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-danger-200">
                <div class="w-14 h-14 rounded-2xl bg-danger-50 flex items-center justify-center mb-5 group-hover:bg-danger-100 transition-colors">
                    <svg class="w-7 h-7 text-danger-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 mb-1 group-hover:text-danger-600 transition-colors">Roles</h3>
                <p class="text-sm text-surface-500">Configura los roles y permisos del sistema.</p>
                <div class="mt-4 flex items-center text-sm font-medium text-danger-600 group-hover:text-danger-500">
                    Gestionar
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>
        </div>
    </div>

    <section>
        @yield('content')
    </section>
</x-app-layout>
