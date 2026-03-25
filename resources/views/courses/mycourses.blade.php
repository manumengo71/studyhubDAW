<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">{{ __('Mis Cursos') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in" x-data="{ activeTab: 'comprados' }">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-display font-bold text-surface-900" id="titulo">Mis cursos</h1>
                <p class="mt-1 text-surface-500">Gestiona tus cursos comprados y creados.</p>
            </div>

            {{-- Tab Buttons --}}
            <div class="flex items-center gap-2 mt-4 sm:mt-0 bg-surface-100 p-1 rounded-xl">
                <button @click="activeTab = 'comprados'" id="botonComprados"
                    :class="activeTab === 'comprados' ? 'bg-white text-surface-900 shadow-sm' : 'text-surface-500 hover:text-surface-700'"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200">
                    Comprados
                </button>
                <button @click="activeTab = 'creados'" id="botonCreados"
                    :class="activeTab === 'creados' ? 'bg-white text-surface-900 shadow-sm' : 'text-surface-500 hover:text-surface-700'"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200">
                    Creados
                </button>
            </div>
        </div>

        {{-- Created Courses Tab --}}
        <div x-show="activeTab === 'creados'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            @if ($courses->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-surface-900 mb-1">No tienes cursos creados</h3>
                    <p class="text-sm text-surface-500 mb-5">Comparte tus conocimientos creando tu primer curso.</p>
                    <a href="{{ route('mycourses.createCourse') }}" class="btn-primary">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Crear curso
                    </a>
                </div>
            @else
                <div class="data-table">
                    <div class="data-table-header">
                        <h3 class="font-semibold text-surface-900">Cursos creados</h3>
                        <a href="{{ route('mycourses.createCourse') }}" class="btn-primary text-xs !py-2">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Nuevo curso
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-surface-500 uppercase tracking-wider bg-surface-50">Curso</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-surface-500 uppercase tracking-wider bg-surface-50 hidden lg:table-cell">Descripción</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-surface-500 uppercase tracking-wider bg-surface-50 hidden md:table-cell">Idioma</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-surface-500 uppercase tracking-wider bg-surface-50">Precio</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-surface-500 uppercase tracking-wider bg-surface-50">Estado</th>
                                    <th class="px-6 py-3.5 text-right text-xs font-semibold text-surface-500 uppercase tracking-wider bg-surface-50">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-100">
                                @foreach ($courses as $course)
                                    <tr class="hover:bg-surface-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-surface-100">
                                                    @if ($course->getMedia('courses_images')->count() > 0)
                                                        <img class="w-full h-full object-cover"
                                                            src="{{ $course->getMedia('courses_images')->last()->getUrl() }}" alt="">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-medium text-surface-900 text-sm">{{ $course->name }}</p>
                                                    <p class="text-xs text-surface-400 mt-0.5">{{ $course->created_at->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 hidden lg:table-cell">
                                            <p class="text-sm text-surface-600 line-clamp-1">{{ Str::limit($course->short_description, 50) }}</p>
                                        </td>
                                        <td class="px-6 py-4 hidden md:table-cell">
                                            <span class="text-sm text-surface-600">{{ $course->language }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm font-semibold text-surface-900">
                                                {{ $course->price == 0 ? 'Gratis' : number_format($course->price, 2) . '€' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($course->deleted_at == $course->updated_at && $course->validated === 0)
                                                <span class="badge badge-pending">A validar</span>
                                            @elseif ($course->deleted_at == $course->updated_at && $course->validated === 1)
                                                <span class="badge badge-inactive">Inactivo</span>
                                            @elseif ($course->deleted_at === null && $course->validated === 1)
                                                <span class="badge badge-active">Activo</span>
                                            @elseif ($course->deleted_at !== null && $course->validated === null)
                                                <span class="badge badge-inactive">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                {{-- Edit --}}
                                                <a href="{{ route('mycourses.editCourse', $course->id) }}" class="btn-icon" title="Editar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>

                                                {{-- Status Actions --}}
                                                @if ($course->deleted_at == $course->updated_at && $course->validated === 0)
                                                    <span class="btn-icon cursor-default" title="Pendiente de validación">
                                                        <svg class="w-4 h-4 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </span>
                                                @elseif ($course->deleted_at == $course->updated_at && $course->validated === 1)
                                                    <form action="{{ route('mycourses.activate', $course->id) }}" method="POST" class="inline">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="page" value="{{ request()->input('page') }}">
                                                        <button type="submit" class="btn-icon text-accent-600 hover:text-accent-700" title="Activar">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        </button>
                                                    </form>
                                                @elseif ($course->deleted_at === null && $course->validated === 1)
                                                    <form action="{{ route('mycourses.destroy', $course) }}" method="POST" class="inline">
                                                        @csrf @method('DELETE')
                                                        <input type="hidden" name="page" value="{{ request()->input('page') }}">
                                                        <button type="submit" class="btn-icon text-danger-500 hover:text-danger-600" title="Desactivar">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                        </button>
                                                    </form>
                                                @elseif ($course->deleted_at !== null && $course->validated === null)
                                                    <form action="{{ route('mycourses.validate', $course->id) }}" method="POST" class="inline">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="page" value="{{ request()->input('page') }}">
                                                        <button type="submit" class="btn-icon text-accent-600 hover:text-accent-700" title="Enviar a validación">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($courses->hasPages())
                        <div class="px-6 py-4 border-t border-surface-100">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Purchased Courses Tab --}}
        <div x-show="activeTab === 'comprados'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            @if ($usersCourses->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-surface-900 mb-1">No tienes cursos comprados</h3>
                    <p class="text-sm text-surface-500 mb-5">Compra un curso para empezar la experiencia StudyHub.</p>
                    <a href="{{ route('marketplace') }}" class="btn-primary">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Explorar marketplace
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($usersCourses as $userCourse)
                        @php
                            $courseUser = $coursesUsers->firstWhere('id', $userCourse->courses_id);
                        @endphp

                        @if ($courseUser)
                            <div class="course-card-modern animate-slide-up" style="animation-delay: {{ $loop->iteration * 0.05 }}s">
                                {{-- Image --}}
                                <div class="relative aspect-[4/3] overflow-hidden">
                                    @if ($courseUser->getMedia('courses_images')->count() > 0)
                                        <img class="course-image"
                                             src="{{ $courseUser->getMedia('courses_images')->last()->getUrl() }}"
                                             alt="{{ $courseUser->name }}" loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    @php
                                        $progress = $userCourse->userCourseProgresses->first();
                                    @endphp

                                    {{-- Status Badge --}}
                                    <div class="absolute top-3 right-3">
                                        @if($progress && $progress->users_courses_statuses_id == 3)
                                            <span class="badge badge-active !text-xs">Completado</span>
                                        @elseif($progress && $progress->users_courses_statuses_id == 2)
                                            <span class="badge badge-info !text-xs">En progreso</span>
                                        @else
                                            <span class="badge badge-pending !text-xs">Nuevo</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-surface-900 line-clamp-1 mb-3">{{ $courseUser->name }}</h3>

                                    <form action="{{ route('mycourses.createPlay', $courseUser->id) }}" method="GET">
                                        @csrf
                                        @if ($progress && $progress->users_courses_statuses_id == 1)
                                            <button type="submit" class="btn-accent w-full">
                                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                Empezar
                                            </button>
                                        @elseif ($progress && $progress->users_courses_statuses_id == 2)
                                            <input type="hidden" name="continuar" value="true">
                                            <button type="submit" class="btn-primary w-full">
                                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                Continuar
                                            </button>
                                        @elseif ($progress && $progress->users_courses_statuses_id == 3)
                                            <input type="hidden" name="empezarDeNuevo" value="true">
                                            <button type="submit" class="btn-secondary w-full">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                Empezar de nuevo
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        // Handle session-based tab opening (for redirects from edit/create)
        var abrir = @json(session('abrirCreados', false));
        var pageRecibido = @json(session('pageActual'));

        document.addEventListener('alpine:init', () => {
            if (abrir === true || window.location.href.includes('page')) {
                // Set Alpine activeTab to 'creados'
                setTimeout(() => {
                    const el = document.querySelector('[x-data]');
                    if (el && el.__x) {
                        el.__x.$data.activeTab = 'creados';
                    }
                }, 50);

                if (pageRecibido !== null && abrir === true) {
                    window.location.href = window.location.href.split('?')[0] + '?page=' + pageRecibido;
                }
            }
        });
    </script>
</x-app-layout>
