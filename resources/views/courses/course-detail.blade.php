<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del curso') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div class="bg-white">
            <main class="my-8">
                <div class="container mx-auto px-6">
                    <div class="md:flex md:items-center">
                        <div class="w-full h-64 md:w-1/2 lg:h-96">
                            @if ($course->getMedia('courses_images')->count() > 0)
                                <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"
                                    src="{{ $course->getMedia('courses_images')->last()->getUrl() }}">
                            @else
                                <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"
                                    src="https://i.postimg.cc/HkL86Lc1/sinfoto.png">
                            @endif
                        </div>
                        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                            <h3 class="text-gray-700 uppercase text-lg">{{ $course->name }}</h3>
                            <span class="text-gray-500 mt-3">PRECIO</span>
                            <hr class="my-3">
                            <div class="mt-2">
                                <label class="text-gray-700 text-sm" for="count">Información:</label>
                                <div class="flex items-center mt-1">
                                    <img class="w-6 h-6 mr-2"
                                        src="https://i.postimg.cc/cHpxRHGN/icons8-description-50.png" alt="Imagen">
                                    <p class="text-gray-600 text-lg font-bold mr-2 focus:outline-none">
                                        {{ $course->short_description }}</p>
                                </div>
                            </div>
                            <div class="mt-0">
                                <div class="flex items-center mt-1">
                                    <img class="w-6 h-6 mr-2" src="https://i.postimg.cc/XNPFPc4V/icons8-language-50.png"
                                        alt="Imagen">
                                    <p class="text-gray-600 text-lg font-bold mr-2 focus:outline-none">
                                        {{ $course->language }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="text-gray-700 text-sm" for="count">Descripción:</label>
                                <div class="flex items-center mt-1">
                                    <p class="text-gray-600 text-lg font-bold mr-2 focus:outline-none">
                                        {{ $course->description }}</p>
                                </div>
                            </div>
                            <div class="flex items-center mt-6">
                                <button
                                    class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Comprar
                                    ahora</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16">
                        <h3 class="text-gray-600 text-2xl font-medium">Mas cursos: </h3>
                        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                            @foreach ($courses as $course)
                                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                                    <div class="flex items-end justify-end h-56 w-full bg-cover"
                                        style="background-image:  @if ($course->getMedia('courses_images')->count() > 0) url('{{ $course->getMedia('courses_images')->last()->getUrl() }}')
                                    @else
                                        url('https://i.postimg.cc/HkL86Lc1/sinfoto.png') @endif">
                                        <a href="{{ route('mycourses.createDetail', $course->id) }}">
                                            <button
                                                class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="px-5 py-3">
                                        <h3 class="text-gray-700 uppercase">{{ $course->name }}</h3>
                                        <span class="text-gray-500 mt-2">{{ $course->short_description }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
        </main>
        </div>
    </x-slot>
</x-app-layout>
