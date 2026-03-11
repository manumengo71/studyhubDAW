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
                            @if ($user->usersCourses()->where('users_id', $user->id)->where('courses_id', $course->id)->count() > 0)
                                <div class="flex items-center mt-6">
                                    <button
                                        class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Curso
                                        ya comprado</button>
                                </div>
                            @else
                                <div class="flex items-center mt-6">
                                    <button onclick="openModal()"
                                        class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Comprar
                                        ahora</button>
                                </div>
                            @endif

                            <!-- Modal -->
                            <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto hidden"
                                aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal">
                                <div
                                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                        aria-hidden="true"></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                        aria-hidden="true">&#8203;</span>
                                    <div
                                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                        id="modal-title">
                                                        Comprar Curso
                                                    </h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            ¿Estás seguro de que quieres comprar el curso
                                                            "{{ $course->name }}"?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <form action="{{ route('marketplace.comprarCurso', $course->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Confirmar
                                                </button>
                                            </form>

                                            <button onclick="cerrarModal()" type="button"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
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

        <script>
            function openModal() {
                document.getElementById('modal').classList.remove('hidden');
                document.getElementById('modal').classList.add('block');
            }

            function cerrarModal() {
                document.getElementById('modal').classList.remove('block');
                document.getElementById('modal').classList.add('hidden');
            }
        </script>
    </x-slot>
</x-app-layout>
