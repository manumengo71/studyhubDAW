<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/mycourses.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cursos') }}
        </h2>
    </x-slot>

    <div class="p-8 rounded-md w-full">
        <div class="flex flex-col items-center justify-center pb-6 sm:flex-row sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-gray-600 font-semibold" id="titulo"></h2>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-8">
                {{-- <div class="flex items-center p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id=""
                        placeholder="Buscar...">
                </div> --}}
                <div class="mt-4 sm:mt-0 space-y-4 sm:space-y-0 sm:ml-10">
                    <button onclick="abrirComprados()"
                        class="button bg-indigo-500 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Cursos
                        comprados</button>
                    <button onclick="abrirCreados()"
                        class="button bg-indigo-500 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Cursos
                        creados</button>
                </div>
            </div>
        </div>
        <div id="cursos-creados">
            <div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pequeña descripción
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Descripción
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Idioma
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Fecha creación
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        OPCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    @if ($course->getMedia('courses_images')->count() > 0)
                                                        <img class="w-full h-full rounded-full"
                                                            src="{{ $course->getMedia('courses_images')->last()->getUrl() }}"
                                                            alt="" />
                                                    @else
                                                        <img class="w-full h-full rounded-full"
                                                            src="https://i.postimg.cc/HkL86Lc1/sinfoto.png"
                                                            alt="" />
                                                    @endif
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $course->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm overflow-ellipsis overflow-hidden">
                                            <p class="text-gray-900 whitespace-no-wrap ">
                                                {{ Str::limit($course->short_description, 50) }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm overflow-ellipsis overflow-hidden">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ Str::limit($course->description, 50) }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->language }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->price == 0 ? 'Gratis' : number_format($course->price, 2) . '€' }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->created_at }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if ($course->deleted_at == null)
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                    <span aria-hidden
                                                        class="absolute inset-0 bg-green-400 opacity-50 rounded-full"></span>
                                                    <span class="relative">ACTIVO</span>
                                                </span>
                                            @else
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                    <span aria-hidden
                                                        class="absolute inset-0 bg-red-400 opacity-50 rounded-full"></span>
                                                    <span class="relative">INACTIVO</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-0 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex">
                                                <div class="items-center">
                                                    <form action="{{ route('mycourses.editCourse', $course->id) }}"
                                                        method="GET" class="inline">
                                                        @csrf
                                                        @method('GET')
                                                        <button type="submit"
                                                            class="text-red-500 hover:text-red-700 flex items-center">
                                                            <img src="https://i.postimg.cc/d3nq626Q/edit.png"
                                                                class="w-8 h-8 mr-2" />
                                                        </button>
                                                    </form>
                                                </div>

                                                @if ($course->deleted_at == null)
                                                    <div class="flex items-center">
                                                        <form action="{{ route('mycourses.destroy', $course) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="page"
                                                                value="{{ request()->input('page') }}">
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/fRq1K2hg/cross.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="flex items-center">
                                                        <form action="{{ route('mycourses.activate', $course->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="page"
                                                                value="{{ request()->input('page') }}">
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/tg1wm3qR/check.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                {{ $courses->links() }}
            </div>
        </div>

        <div id="cursos-comprados" onclick="abrirComprados()">
            <div class="flex flex-wrap xl:ms-20 lg:ms-3 sm:ms-24" >
            @foreach ($usersCourses as $userCourse)
                @php
                    $courseUser = $coursesUsers->firstWhere('id', $userCourse->courses_id);
                    // $courseStatus = $status->where('id', $userCourse->users_courses_statuses_id)->first()->name;
                @endphp

                    @if ($courseUser)
                        <div class="course-card sm:w-44 md:w-56 lg:w-64 xl:w-72 2xl:w-96 sm:me-10 sm:mb-10 mx-auto sm:mx-0">
                            <div>
                                <p class="text head oculto mb-4">{{ $courseUser->name }}</p>
                            </div>

                            @if ($courseUser->getMedia('courses_images')->count() > 0)
                                <img class="w-44 h-44 rounded-full img mt-10"
                                    src="{{ $courseUser->getMedia('courses_images')->last()->getUrl() }}"
                                    alt="" />
                            @else
                                <img class="w-40 h-40 img" src="https://i.postimg.cc/HkL86Lc1/sinfoto.png"
                                    alt="" />
                            @endif

                            <div class="textBox">

                            {{-- <span>{{ $courseStatus }}</span> --}}
                            <span class="px-0 py-5 mb-16 text-sm">
                                <form action="{{ route('mycourses.createPlay', $courseUser->id) }}" method="GET">
                                    @csrf
                                    {{-- @if ($courseStatus == '¡Estréname!') --}}
                                        <button class="group relative h-8 w-32 overflow-hidden rounded-2xl bg-green-500 text-sm font-bold text-white" type="submit">
                                            EMPEZAR
                                            <div class="absolute inset-0 h-full w-full scale-0 rounded-2xl transition-all duration-300 group-hover:scale-100 group-hover:bg-white/30"></div>
                                        </button>
                                    {{-- @elseif ($courseStatus == 'En progreso')
                                        <button class="group relative h-8 w-32 overflow-hidden rounded-2xl bg-green-500 text-sm font-bold text-white" type="submit">
                                            CONTINUAR
                                            <div class="absolute inset-0 h-full w-full scale-0 rounded-2xl transition-all duration-300 group-hover:scale-100 group-hover:bg-white/30"></div>
                                        </button>
                                    @elseif ($courseStatus == 'Completado')
                                        <button class="group relative h-12 w-32 overflow-hidden rounded-2xl bg-green-500 text-sm font-bold text-white" type="submit">
                                            EMPEZAR DE NUEVO
                                            <div class="absolute inset-0 h-full w-full scale-0 rounded-2xl transition-all duration-300 group-hover:scale-100 group-hover:bg-white/30"></div>
                                        </button>
                                    @endif --}}
                                </form>
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
        </div>

    </div>

    <script>
        const cursosCreados = document.getElementById('cursos-creados');
        const cursosComprados = document.getElementById('cursos-comprados');
        const titulo = document.getElementById('titulo');

        cursosCreados.style.display = 'none';
        cursosComprados.style.display = 'none';

        function abrirCreados() {
            const cursosCreados = document.getElementById('cursos-creados');
            const cursosComprados = document.getElementById('cursos-comprados');
            const titulo = document.getElementById('titulo');

            cursosCreados.style.display = 'block';
            cursosComprados.style.display = 'none';
            titulo.innerHTML = 'CURSOS CREADOS';
        }

        function abrirComprados() {
            cursosCreados.style.display = 'none';
            cursosComprados.style.display = 'block';
            titulo.innerHTML = 'CURSOS COMPRADOS';
        }
    </script>

    <script>
        var abrir = @json(session('abrirCreados', false));
        var pageRecibido = @json(session('pageActual'));

        if (abrir === true) {
            if(pageRecibido !== null){
                window.location.href = window.location.href + '?page=' + pageRecibido;
            } else {
                abrirCreados();
            }
        } else if (window.location.href.includes('page')) {
            abrirCreados();
        }
    </script>
</x-app-layout>
