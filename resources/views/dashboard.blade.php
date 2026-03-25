<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">

        {{-- Welcome Header --}}
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-display font-bold text-surface-900">
                ¡Hola, {{ Auth::user()->username }}! 👋
            </h1>
            <p class="mt-1 text-surface-500">Aquí tienes un resumen de tu actividad en StudyHub.</p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            {{-- Courses Completed --}}
            <div class="stat-card animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-card-icon bg-accent-50">
                        <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    @if(isset($userNumeroCursosFinalizados) && $userNumeroCursosFinalizados > 0)
                        <span class="badge badge-active">Completados</span>
                    @endif
                </div>
                <h3 class="text-3xl font-bold text-surface-900">{{ $userNumeroCursosFinalizados ?? 0 }}</h3>
                <p class="text-sm text-surface-500 mt-1">Cursos completados</p>
            </div>

            {{-- Active Courses --}}
            <div class="stat-card animate-slide-up" style="animation-delay: 0.15s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-card-icon bg-primary-50">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-surface-900">{{ $userActual->userCourseProgresses()->where('users_courses_statuses_id', 2)->count() }}</h3>
                <p class="text-sm text-surface-500 mt-1">Cursos en progreso</p>
            </div>

            {{-- Courses Created --}}
            <div class="stat-card animate-slide-up" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-card-icon bg-warning-50">
                        <svg class="w-6 h-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-surface-900">{{ App\Models\Course::withTrashed()->where('owner_id', Auth::id())->count() }}</h3>
                <p class="text-sm text-surface-500 mt-1">Cursos creados</p>
            </div>

            {{-- Payment Status --}}
            <div class="stat-card animate-slide-up" style="animation-delay: 0.25s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-card-icon bg-surface-100">
                        <svg class="w-6 h-6 text-surface-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    @if($userActual->billingInformation)
                        <span class="badge badge-active">Activo</span>
                    @else
                        <span class="badge badge-pending">Pendiente</span>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-surface-900">
                    @if($userActual->billingInformation)
                        •••• {{ substr($userActual->billingInformation->credit_card_number, -4) }}
                    @else
                        Sin tarjeta
                    @endif
                </h3>
                <p class="text-sm text-surface-500 mt-1">Método de pago</p>
            </div>
        </div>

        {{-- Continue Learning / Getting Started --}}
        @if(isset($mostrarPasosPorHacer) && $mostrarPasosPorHacer)
            {{-- Getting Started Card --}}
            <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 rounded-2xl p-8 text-white mb-8 animate-slide-up" style="animation-delay: 0.3s">
                <div class="max-w-2xl">
                    <h2 class="text-2xl font-display font-bold mb-2">🚀 ¡Bienvenido a StudyHub!</h2>
                    <p class="text-primary-200 mb-6">Empieza a explorar nuestra colección de cursos o crea tu propio contenido educativo.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('marketplace') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary-700 font-semibold text-sm rounded-xl hover:bg-primary-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Explorar Marketplace
                        </a>
                        <a href="{{ route('mycourses.createCourse') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/15 text-white font-semibold text-sm rounded-xl hover:bg-white/25 transition-all border border-white/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Crear un curso
                        </a>
                    </div>
                </div>
            </div>
        @elseif(isset($ultimoCursoEmpezado))
            {{-- Continue Learning Card --}}
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-6 md:p-8 text-white mb-8 animate-slide-up" style="animation-delay: 0.3s">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-5">
                    <div class="w-16 h-16 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                        @if($ultimoCursoEmpezado->getMedia('courses_images')->count() > 0)
                            <img src="{{ $ultimoCursoEmpezado->getMedia('courses_images')->last()->getUrl() }}"
                                 class="w-16 h-16 rounded-xl object-cover" alt="{{ $ultimoCursoEmpezado->name }}">
                        @else
                            <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-primary-200 text-sm font-medium mb-1">Continúa donde lo dejaste</p>
                        <h3 class="text-xl font-display font-bold">{{ $ultimoCursoEmpezado->name }}</h3>
                        <div class="mt-3 flex items-center gap-3">
                            <div class="flex-1 progress-bar !bg-white/20">
                                <div class="progress-bar-fill !bg-accent-400" style="width: {{ $porcentajeCurso ?? 0 }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-white/90">{{ $porcentajeCurso ?? 0 }}%</span>
                        </div>
                    </div>
                    <a href="{{ route('mycourses.createPlay', $ultimoCursoEmpezado->id) }}"
                       class="flex items-center gap-2 px-5 py-2.5 bg-white/15 hover:bg-white/25 border border-white/20 text-white font-semibold text-sm rounded-xl transition-all flex-shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        @if(isset($progresoUltimoCurso) && $progresoUltimoCurso->users_courses_statuses_id == 3)
                            Repetir curso
                        @elseif(isset($progresoUltimoCurso) && $progresoUltimoCurso->users_courses_statuses_id == 2)
                            Continuar
                        @else
                            Empezar
                        @endif
                    </a>
                </div>
            </div>
        @endif

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <a href="{{ route('marketplace') }}" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-primary-200 animate-slide-up" style="animation-delay: 0.35s">
                <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center mb-4 group-hover:bg-primary-100 transition-colors">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-surface-900 mb-1">Explorar Marketplace</h3>
                <p class="text-sm text-surface-500">Descubre nuevos cursos de diferentes temáticas.</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-primary-600 group-hover:text-primary-700">
                    Explorar <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>

            <a href="{{ route('mycourses') }}" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-accent-200 animate-slide-up" style="animation-delay: 0.4s">
                <div class="w-12 h-12 rounded-xl bg-accent-50 flex items-center justify-center mb-4 group-hover:bg-accent-100 transition-colors">
                    <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-surface-900 mb-1">Mis cursos</h3>
                <p class="text-sm text-surface-500">Accede a tus cursos comprados y creados.</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-accent-600 group-hover:text-accent-700">
                    Ver cursos <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>

            <a href="{{ route('mycourses.createCourse') }}" class="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 border border-surface-100 hover:border-warning-200 animate-slide-up" style="animation-delay: 0.45s">
                <div class="w-12 h-12 rounded-xl bg-warning-50 flex items-center justify-center mb-4 group-hover:bg-warning-100 transition-colors">
                    <svg class="w-6 h-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-surface-900 mb-1">Crear un curso</h3>
                <p class="text-sm text-surface-500">Comparte tus conocimientos creando tu propio curso.</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-warning-600 group-hover:text-warning-500">
                    Crear ahora <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>
        </div>

        {{-- Credit Card Warning --}}
        @if(!$userActual->billingInformation && isset($mostrarTarjeta) && $mostrarTarjeta)
            <div class="alert alert-warning animate-slide-up" style="animation-delay: 0.5s">
                <svg class="w-5 h-5 text-warning-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div class="flex-1">
                    <span class="font-medium">¡Configura tu método de pago!</span>
                    <span class="ml-1 text-surface-600">Para poder comprar cursos necesitas añadir tu tarjeta de crédito.</span>
                </div>
                <a href="{{ route('billinginfo') }}" class="btn-primary text-xs !py-2 !px-4 flex-shrink-0">
                    Añadir tarjeta
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
