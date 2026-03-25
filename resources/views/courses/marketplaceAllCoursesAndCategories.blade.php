@extends('courses.buscadorMarketplace')
@section('content')

    <div class="animate-fade-in">

        {{-- All Courses Section --}}
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-display font-bold text-surface-900" id="allCourses">Todos los cursos</h2>
                    <p class="text-sm text-surface-500 mt-1">Explora la colección completa de cursos disponibles</p>
                </div>
                <a href="#allCategories" class="btn-ghost text-sm">
                    Ir a categorías
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
            </div>

            @if ($courses->isNotEmpty())
                @foreach ($temas as $tema)
                    @if ($courses->where('courses_categories_id', $tema->id)->isNotEmpty())
                        {{-- Category Section Header --}}
                        <div class="flex items-center gap-3 mb-4 mt-8 first:mt-0">
                            <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-surface-800">{{ $tema->name }}</h3>
                            <div class="flex-1 h-px bg-surface-200"></div>
                            <span class="text-xs font-medium text-surface-400">{{ $courses->where('courses_categories_id', $tema->id)->count() }} cursos</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-6">
                            @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                                <div class="course-card-modern group animate-slide-up" style="animation-delay: {{ $loop->iteration * 0.03 }}s">
                                    <div class="relative aspect-[4/3] overflow-hidden">
                                        @if ($course->getMedia('courses_images')->count() > 0)
                                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                                 src="{{ $course->getMedia('courses_images')->last()->getUrl() }}"
                                                 alt="{{ $course->name }}" loading="lazy">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                        @endif

                                        {{-- Price Badge --}}
                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-sm font-bold text-surface-900 shadow-sm">
                                                {{ $course->price == 0 ? 'Gratis' : number_format($course->price, 2) . '€' }}
                                            </span>
                                        </div>

                                        {{-- Language Badge --}}
                                        <div class="absolute top-3 right-3">
                                            <span class="px-2.5 py-1 bg-primary-600/90 backdrop-blur-sm rounded-full text-xs font-medium text-white">
                                                {{ $course->language }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-5">
                                        <span class="text-xs font-semibold text-primary-600 uppercase tracking-wider">{{ $tema->name }}</span>
                                        <h3 class="mt-1.5 text-lg font-bold text-surface-900 line-clamp-1">{{ $course->name }}</h3>
                                        <p class="mt-1 text-sm text-surface-500 line-clamp-2">{{ $course->short_description }}</p>

                                        <div class="mt-4 pt-4 border-t border-surface-100 flex items-center justify-between">
                                            <span class="text-xs text-surface-400">
                                                {{ $course->lesson()->count() }} lecciones
                                            </span>
                                            <a href="{{ route('mycourses.createDetail', $course->id) }}"
                                               class="text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors inline-flex items-center gap-1">
                                                Ver detalle
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-surface-800 mb-1">Ningún resultado</h3>
                    <p class="text-sm text-surface-500">No pudimos encontrar ningún curso que coincida con tu búsqueda.</p>
                </div>
            @endif
        </div>

        {{-- All Categories Section --}}
        <div class="mb-10">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-display font-bold text-surface-900" id="allCategories">Todas las categorías</h2>
                    <p class="text-sm text-surface-500 mt-1">Busca cursos por la temática que más te interese</p>
                </div>
                <a href="#allCourses" class="btn-ghost text-sm">
                    Ir a cursos
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                @foreach ($temas as $category)
                    <a href="{{ route('marketplace.cursosPorCategoria', ['id' => $category->id]) }}"
                       class="group bg-white rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-all duration-300 text-center border border-surface-100 hover:border-primary-200 animate-slide-up"
                       style="animation-delay: {{ $loop->iteration * 0.05 }}s">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mx-auto mb-3">
                            @if ($category->getMedia('images_categories')->count() > 0)
                                <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                     src="{{ $category->getMedia('images_categories')->last()->getUrl() }}" 
                                     alt="{{ $category->name }}" loading="lazy">
                            @else
                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-sm font-semibold text-surface-800 group-hover:text-primary-700 transition-colors line-clamp-1">
                            {{ $category->name }}
                        </h3>
                        <p class="text-xs text-surface-400 mt-0.5">{{ $category->courses()->count() }} cursos</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
