@extends('courses.buscadorMarketplace')

@section('content')
    <div class="animate-fade-in">

        {{-- Hero Section --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 rounded-2xl p-8 md:p-10 mb-10">
            <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/3 -translate-x-1/4"></div>
            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-display font-bold text-white mb-3">
                    Descubre los últimos cursos
                </h1>
                <p class="text-primary-200 text-lg max-w-2xl mb-5">
                    Explora nuestra colección de cursos y empieza a aprender hoy mismo.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="#cursos" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary-700 font-semibold text-sm rounded-xl hover:bg-primary-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        Ver cursos
                    </a>
                    <a href="#categorias" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/15 text-white font-semibold text-sm rounded-xl hover:bg-white/25 transition-all border border-white/20">
                        Categorías
                    </a>
                </div>
            </div>
        </div>

        {{-- Latest Courses Section --}}
        <div class="mb-12" id="cursos">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-display font-bold text-surface-900">Últimos cursos</h2>
                    <p class="text-sm text-surface-500 mt-1">Los cursos más recientes publicados en la plataforma</p>
                </div>
                <a href="{{ route('marketplace.allCoursesAndCategories') }}#allCourses"
                   class="btn-secondary text-sm hidden md:inline-flex">
                    Ver todos
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($temas as $tema)
                    @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                        {{-- Modern Course Card --}}
                        <div class="course-card-modern animate-slide-up" style="animation-delay: {{ $loop->parent->iteration * 0.05 + $loop->iteration * 0.05 }}s">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if ($course->getMedia('courses_images')->count() > 0)
                                    <img class="course-image"
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
                @endforeach

                {{-- See All Card --}}
                <a href="{{ route('marketplace.allCoursesAndCategories') }}#allCourses"
                   class="group bg-surface-100 hover:bg-surface-200 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col items-center justify-center min-h-[320px] border-2 border-dashed border-surface-300 hover:border-primary-400">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center mb-4 shadow-sm group-hover:shadow-md transition-shadow">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-surface-700 group-hover:text-primary-700 transition-colors">Ver todos los cursos</h3>
                    <p class="text-sm text-surface-500 mt-1">Explora nuestra colección completa</p>
                </a>
            </div>
        </div>

        {{-- Categories Section --}}
        <div class="mb-12" id="categorias">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-display font-bold text-surface-900">Categorías principales</h2>
                    <p class="text-sm text-surface-500 mt-1">Busca cursos por la temática que más te interese</p>
                </div>
                <a href="{{ route('marketplace.allCoursesAndCategories') }}#allCategories"
                   class="btn-secondary text-sm hidden md:inline-flex">
                    Todas las categorías
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                @foreach ($categoriasPopulares as $category)
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

                {{-- See all categories card --}}
                <a href="{{ route('marketplace.allCoursesAndCategories') }}#allCategories"
                   class="group bg-surface-100 hover:bg-surface-200 rounded-2xl p-5 transition-all duration-300 text-center border-2 border-dashed border-surface-300 hover:border-primary-400 flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center mx-auto mb-3 shadow-sm">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-surface-700 group-hover:text-primary-700 transition-colors">Ver todas</h3>
                </a>
            </div>
        </div>

        {{-- Mobile: View All link --}}
        <div class="md:hidden text-center mb-8">
            <a href="{{ route('marketplace.allCoursesAndCategories') }}" class="btn-primary">
                Ver todos los cursos y categorías
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
@endsection
