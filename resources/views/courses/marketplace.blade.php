<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>

    <div class="flex justify-between items-center">
        <form class="flex-1 m-4">
            <label for="default-search" class="sr-only">Buscar</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Buscar cursos..." required>
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
            </div>
        </form>
        <form action="{{ route('mycourses.createCourse') }}" method="GET">
            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded mr-4">
                Añadir nuevo curso
            </button>
        </form>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 m-10">Últimos 12 cursos:</h1>
    <div class="flex flex-wrap">
        @foreach ($temas as $tema)
            @if ($courses->where('courses_categories_id', $tema->id)->isNotEmpty())
                @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                    <div
                        class="max-w-sm w-96 bg-white px-6 pt-6 pb-4 rounded-xl shadow-lg transform hover:scale-105 transition duration-500 m-4 md:ms-20">
                        <h3 class="mb-3 text-xl font-bold text-indigo-600">Tema: {{ $tema->name }}</h3>
                        <div class="relative">
                            @if ($course->getMedia('courses_images')->count() > 0)
                                <img class="w-full h-64 object-contain rounded-xl"
                                    src="{{ $course->getMedia('courses_images')->last()->getUrl() }}"
                                    alt="{{ $course->name }}">
                            @else
                                <img class="w-full h-56 object-contain rounded-xl"
                                    src="https://i.postimg.cc/HkL86Lc1/sinfoto.png">
                            @endif
                            <p
                                class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                                PRECIO</p>
                        </div>
                        <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">{{ $course->name }}</h1>
                        <div class="my-4">
                            <div class="flex items-center">
                                <img class="w-6 h-6 mr-2" src="https://i.postimg.cc/cHpxRHGN/icons8-description-50.png"
                                    alt="Imagen">
                                <p class="text-gray-600">{{ $course->short_description }}</p>
                            </div>
                            <div class="flex items-center">
                                <img class="w-6 h-6 mr-2" src="https://i.postimg.cc/XNPFPc4V/icons8-language-50.png"
                                    alt="Imagen">
                                <p class="text-gray-600">{{ $course->language }}</p>
                            </div>
                            <button
                                class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg">Comprar
                                curso</button>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>

    <h1 class="text-3xl font-bold text-gray-800 m-10">Categorías principales:</h1>
    <div class="flex flex-wrap justify-center mb-4">
        @foreach ($categoriasPopulares as $category)
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
    </div>
</x-app-layout>
