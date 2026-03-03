<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>

    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4 ml-4">
        Añadir nuevo curso
    </button>

    <h2 class="text-left my-4 ml-4 font-bold">Temática 1</h2>

    <div id="animation-carousel-1" class="relative w-auto mx-4" data-carousel="static">
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/cHwRxVfC/logo.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/G2WRdK6p/cuatro.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                <img src="https://i.postimg.cc/Gh1RfMk7/dos.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/0QMvTFW3/tres.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/RhwBFfzL/uno.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>

        <!-- Controles del carrusel -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <!-- Icono para retroceder -->
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <!-- Icono para avanzar -->
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <h2 class="text-left my-4 ml-4 font-bold">Temática 2</h2>

    <div id="animation-carousel-2" class="relative w-auto mx-4" data-carousel="static">
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/cHwRxVfC/logo.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/G2WRdK6p/cuatro.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                <img src="https://i.postimg.cc/Gh1RfMk7/dos.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/0QMvTFW3/tres.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <img src="https://i.postimg.cc/RhwBFfzL/uno.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>

        <!-- Controles del carrusel -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <!-- Icono para retroceder -->
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <!-- Icono para avanzar -->
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
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

        // Inicializar carrusel 1
        createCarousel('animation-carousel-1');

        // Inicializar carrusel 2
        createCarousel('animation-carousel-2');
    </script>
</x-app-layout>
