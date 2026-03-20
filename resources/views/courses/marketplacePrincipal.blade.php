@extends('courses.buscadorMarketplace')

@section('content')
    <!-- Estilos -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Últimos 12 cursos -->
    <div class="flex items-center">
        <h1 class="text-3xl font-bold text-gray-800 m-10" id="cursos">| Últimos cursos |</h1>
        <a href="#categorias" class="hover:text-cyan-700 -ms-6">Ir a categorías</a>
    </div>

    <div class="flex flex-wrap">
        @foreach ($temas as $tema)
            @if ($courses->where('courses_categories_id', $tema->id)->isNotEmpty())
                @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                    <div class="max-w-sm w-96 bg-slate-300 px-6 pt-6 pb-4 rounded-xl shadow-2xl transform hover:scale-105 transition duration-500 m-4 2xl:w-96 mx-auto"
                        style="box-shadow: 7px 20px 15px -3px rgba(0, 0, 0, 0.1), 4px 0 6px -2px rgba(0, 0, 0, 0.05);">
                        <h3 class="mb-3 text-xl font-bold text-indigo-600">Tema: {{ $tema->name }}</h3>
                        <div class="relative">
                            <div class="w-full h-64 overflow-hidden rounded-xl">
                                @if ($course->getMedia('courses_images')->count() > 0)
                                    <img class="w-full h-full object-cover"
                                        src="{{ $course->getMedia('courses_images')->last()->getUrl() }}"
                                        alt="{{ $course->title }}">
                                @else
                                    <img class="w-full h-full object-cover" src="https://i.postimg.cc/HkL86Lc1/sinfoto.png"
                                        alt="Imagen por defecto">
                                @endif
                            </div>
                            <div class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                                {{ $course->price == 0 ? 'Gratis' :  number_format($course->price, 2) . '€' }}
                            </div>
                        </div>
                        <h1
                            class="mt-4 text-gray-800 text-2xl font-bold overflow-hidden whitespace-nowrap overflow-ellipsis">
                            {{ $course->name }}</h1>
                        <div class="my-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 mr-2" src="https://i.postimg.cc/sX7HBJtw/title.png"
                                    alt="Imagen">
                                <p class="text-gray-600 overflow-hidden whitespace-nowrap overflow-ellipsis">
                                    {{ $course->short_description }}</p>
                            </div>
                            <div class="flex items-center">
                                <img class="w-10 h-10 mr-2" src="https://i.postimg.cc/WbHXzH9m/language.png"
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

        <!-- Todos los cursos -->
        <div class="max-w-sm w-96 bg-slate-300 px-6 pt-6 pb-4 rounded-xl shadow-2xl transform hover:scale-105 transition duration-500 m-4 2xl:w-96 mx-auto text-center flex flex-col justify-center"
            style="box-shadow: 7px 20px 15px -3px rgba(0, 0, 0, 0.1), 4px 0 6px -2px rgba(0, 0, 0, 0.05);">
            <h3 class="mb-3 text-xl font-bold text-indigo-600">Tema: <a href="#">Todos los temas</a></h3>
            <div class="relative mt-12">
                <img class="w-full h-56 object-contain rounded-xl" src="https://i.postimg.cc/ykqn1D08/allcourses-Nueva.png">
            </div>
            <h1 class="mt-4 text-gray-800 text-2xl font-bold whitespace-nowrap overflow-ellipsis">
                Todos los cursos</h1>
            <div class="my-4">
                </br></br>
                <a href="{{ route('marketplace.allCoursesAndCategories') }}#allCourses"><button
                        class="text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg">Click para
                        ver</button></a>
            </div>
        </div>
    </div>


    <div class="flex items-center">
        <h1 class="text-3xl font-bold text-gray-800 m-10" id="categorias">| Categorías principales |</h1>
        <a href="#cursos" class="hover:text-cyan-700 -ms-6">Ir a cursos</a>
    </div>

    <div class="flex flex-wrap justify-center mb-4">
        @foreach ($categoriasPopulares as $category)
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

        <!-- Todas las categorías -->
        <div
            class="mr-12 max-w-sm w-64 bg-slate-300 px-6 pt-6 pb-4 rounded-xl shadow-lg transform m-4 hover:scale-105 transition duration-500">
            <a href="{{ route('marketplace.allCoursesAndCategories') }}#allCategories">
                <div class="relative">
                    <img class="w-full h-full rounded-full" src="https://i.postimg.cc/4NqZr0b1/allcategories.jpg"
                        alt="" />
                </div>
                <div class="text-center mt-2">
                    Todas las categorías
                </div>
            </a>
        </div>
    </div>
@endsection
