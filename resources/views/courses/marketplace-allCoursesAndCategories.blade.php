@extends('courses.marketplace')
@section('content')
    <!-- Estilos -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Cursos por tema -->
    <h1 class="text-3xl font-bold text-gray-800 m-10" id="allCourses">| Todos los cursos |</h1>
    <div class="flex flex-wrap">
        @foreach ($temas as $tema)
            @if ($courses->where('courses_categories_id', $tema->id)->isNotEmpty())
                <h2 class="w-full text-2xl font-bold text-gray-800 m-10">Tema: {{ $tema->name }}</h2>
                @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                    <div class="max-w-sm w-96 bg-white px-6 pt-6 pb-4 rounded-xl shadow-2xl transform hover:scale-105 transition duration-500 m-4 md:ms-20"
                        style="box-shadow: 7px 20px 15px -3px rgba(0, 0, 0, 0.1), 4px 0 6px -2px rgba(0, 0, 0, 0.05);">
                        <div class="relative">
                            @if ($course->getMedia('courses_images')->count() > 0)
                                <img class="w-full h-64 object-contain rounded-xl"
                                    src="{{ $course->getMedia('courses_images')->last()->getUrl() }}">
                            @else
                                <img class="w-full h-56 object-contain rounded-xl"
                                    src="https://i.postimg.cc/HkL86Lc1/sinfoto.png">
                            @endif
                            <p
                                class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                                PRECIO</p>
                        </div>
                        <h1
                            class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer whitespace-nowrap overflow-ellipsis">
                            {{ $course->name }}</h1>
                        <div class="my-4">
                            <div class="flex items-center">
                                <img class="w-6 h-6 mr-2" src="https://i.postimg.cc/cHpxRHGN/icons8-description-50.png"
                                    alt="Imagen">
                                <p class="text-gray-600 overflow-hidden whitespace-nowrap overflow-ellipsis">
                                    {{ $course->short_description }}</p>
                            </div>
                            <div class="flex items-center">
                                <img class="w-6 h-6 mr-2" src="https://i.postimg.cc/XNPFPc4V/icons8-language-50.png"
                                    alt="Imagen">
                                <p class="text-gray-600">{{ $course->language }}</p>
                            </div>
                            <a href="{{ route('mycourses.createDetail', $course->id) }}">
                                <button class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg">Mas
                                    detalles</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>

    <h1 class="text-3xl font-bold text-gray-800 m-10" id="allCategories">| Todas las categorías |</h1>
    <div class="flex flex-wrap justify-center mb-4">
        @foreach ($temas as $category)
            <div
                class="mr-12 max-w-sm w-64 bg-slate-300 px-6 pt-6 pb-4 rounded-xl shadow-lg transform m-4 hover:scale-105 transition duration-500">
                <a href="#">
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
