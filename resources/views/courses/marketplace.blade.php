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
        <form action="{{ route('createCourse') }}" method="GET">
            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded mr-4">
                Añadir nuevo curso
            </button>
        </form>
    </div>


    <div class="flex flex-wrap">
        @foreach ($temas as $tema)
            @if ($courses->where('courses_categories_id', $tema->id)->isNotEmpty())
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                    <h2 class="text-left my-4 ml-4 font-bold text-3xl text-indigo-600 ms-10">{{ $tema->name }}</h2>
                    <div id="animation-carousel-{{ $tema->id }}" class="relative w-auto mx-4 mt-5 mb-5"
                        data-carousel="static">
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                            @foreach ($courses->where('courses_categories_id', $tema->id) as $course)
                                <div class="hidden duration-200 ease-linear group" data-carousel-item
                                    data-tema-id="{{ $tema->id }}">
                                    @if ($course->getMedia('courses_images')->count() > 0)
                                        <div class="relative">
                                            <img src="{{ $course->getMedia('courses_images')->last()->getUrl() }}"
                                                class="block w-full object-cover h-full" alt="...">
                                            <div
                                                class="absolute block w-50 -translate-x-1/2 -translate-y-1/2 bottom-5 left-1/2 bg-black opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                                <h2 class="text-2xl font-bold text-white">{{ $course->name }}</h2>
                                            </div>
                                        </div>
                                    @else
                                        <div class="relative">
                                            <img src="https://i.postimg.cc/HkL86Lc1/sinfoto.png"
                                                class="block w-full object-cover h-full" alt="...">
                                            <div
                                                class="absolute block w-50 -translate-x-1/2 -translate-y-1/2 bottom-5 left-1/2 bg-black opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                                <h2 class="text-2xl font-bold text-white">{{ $course->name }}</h2>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Controles del carrusel -->
                        <!-- Icono para retroceder -->
                        <button type="button"
                            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-500/30 dark:bg-blue-800/30 group-hover:bg-blue-500/50 dark:group-hover:bg-blue-800/60 group-focus:ring-4 group-focus:ring-blue-500 dark:group-focus:ring-blue-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-blue-500 dark:text-blue-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>

                        <!-- Icono para avanzar -->
                        <button type="button"
                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-500/30 dark:bg-blue-800/30 group-hover:bg-blue-500/50 dark:group-hover:bg-blue-800/60 group-focus:ring-4 group-focus:ring-blue-500 dark:group-focus:ring-blue-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-blue-500 dark:text-blue-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <script>
        function createCarousel(carouselId) {
            const carouselElement = document.getElementById(carouselId);
            const carouselItems = carouselElement.querySelectorAll('[data-carousel-item]');
            const prevButton = carouselElement.querySelector('[data-carousel-prev]');
            const nextButton = carouselElement.querySelector('[data-carousel-next]');
            let currentIndex = 0;

            const showItem = (index) => {
                carouselItems.forEach((item, i) => {
                    item.classList.toggle('hidden', i !== index);
                });
            };

            const showNextItem = () => {
                currentIndex = (currentIndex + 1) % carouselItems.length;
                showItem(currentIndex);
            };

            const showPrevItem = () => {
                currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                showItem(currentIndex);
            };

            prevButton.addEventListener('click', showPrevItem);
            nextButton.addEventListener('click', showNextItem);

            showItem(currentIndex);
        }

        // Inicializar carruseles para cada tema
        @foreach ($temas as $tema)
            createCarousel('animation-carousel-' + {{ $tema->id }});
        @endforeach
    </script>
</x-app-layout>
