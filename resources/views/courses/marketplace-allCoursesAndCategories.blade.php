@extends('courses.marketplace')
@section('content')
    <!-- Estilos -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Cursos por tema -->
    <div class="flex items-center">
        <h1 class="text-3xl font-bold text-gray-800 m-10" id="allCourses">| Todos los cursos |</h1>
        <a href="#allCategories" class="hover:text-cyan-700 -ms-6">Ir a categorías</a>
    </div>

    <div class="flex flex-wrap">
        @if ($courses->isNotEmpty())
            @foreach ($temas as $tema)
                @if ($courses->where('courses_categories_id', $tema->id)->isNotEmpty())
                    <h2 class="w-full text-2xl font-bold text-gray-800 m-10">Tema: {{ $tema->name }}</h2>
                    @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                        <div class="max-w-sm w-96 bg-slate-300 px-6 pt-6 pb-4 rounded-xl shadow-2xl transform hover:scale-105 transition duration-500 m-4 md:ms-20"
                            style="box-shadow: 7px 20px 15px -3px rgba(0, 0, 0, 0.1), 4px 0 6px -2px rgba(0, 0, 0, 0.05);">
                            <div class="relative">
                                <div class="w-full h-64 overflow-hidden rounded-xl">
                                    @if ($course->getMedia('courses_images')->count() > 0)
                                        <img class="w-full h-full object-cover"
                                            src="{{ $course->getMedia('courses_images')->last()->getUrl() }}"
                                            alt="{{ $course->title }}">
                                    @else
                                        <img class="w-full h-full object-cover"
                                            src="https://i.postimg.cc/HkL86Lc1/sinfoto.png" alt="Imagen por defecto">
                                    @endif
                                </div>
                                <div
                                    class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                                    {{ $course->price == 0 ? 'Gratis' :  number_format($course->price, 2) . '€' }}
                                </div>
                            </div>
                            <h1
                                class="mt-4 text-gray-800 text-2xl font-bold overflow-hidden whitespace-nowrap overflow-ellipsis">
                                {{ $course->name }}</h1>
                            <div class="my-4">
                                <div class="flex items-center">
                                    <img class="w-9 h-9 mr-2" src="https://i.postimg.cc/sX7HBJtw/title.png"
                                        alt="Imagen">
                                    <p class="text-gray-600 overflow-hidden whitespace-nowrap overflow-ellipsis">
                                        {{ $course->short_description }}</p>
                                </div>
                                <div class="flex items-center">
                                    <img class="w-9 h-9 mr-2" src="https://i.postimg.cc/WbHXzH9m/language.png"
                                        alt="Imagen">
                                    <p class="text-gray-600">{{ $course->language }}</p>
                                </div>
                                <a href="{{ route('mycourses.createDetail', $course->id) }}">
                                    <button
                                        class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg">Mas
                                        detalles</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @else
            <div class="flex flex-col mx-auto items-center justify-center m-10">
                <img class="w-64 h-64 mb-8" src="https://i.postimg.cc/sfq3rQXM/trsite-removebg-preview.png"
                    alt="No results">
                <h2 class="text-gray-600 text-2xl font-semibold">Ningún resultado</h2>
                <p class="text-gray-500">No pudimos encontrar ningún curso que coincida con tu búsqueda.</p>
            </div>
        @endif
    </div>

    <div class="flex items-center">
        <h1 class="text-3xl font-bold text-gray-800 m-10" id="allCategories">| Todas las categorías |</h1>
        <a href="#allCourses" class="hover:text-cyan-700 -ms-6">Ir a categorías</a>
    </div>
    <div class="flex flex-wrap justify-center mb-4">
        @foreach ($temas as $category)
            <div
                class="mr-12 max-w-sm w-64 bg-slate-300 px-6 pt-6 pb-4 rounded-xl shadow-lg transform m-4 hover:scale-105 transition duration-500">
                <a href="{{ route('marketplace.cursosPorCategoria', ['id' => $category->id]) }}">
                    <div class="relative">
                        @if ($category->getMedia('images_categories')->count() > 0)
                            <img class="w-full h-full rounded-full"
                                src="{{ $category->getMedia('images_categories')->last()->getUrl() }}" alt="" />
                        @else
                            <img class="w-full h-full rounded-full" src="https://i.postimg.cc/HkL86Lc1/sinfoto.png"
                                alt="" />
                        @endif
                    </div>
                    <div class="text-center mt-2">
                        {{ $category->name }}
                    </div>
                </a>
            </div>

            @if ($loop->iteration % 4 == 0)
                <div class="w-full"></div>
            @endif
        @endforeach
    @endsection
