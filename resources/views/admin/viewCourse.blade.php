<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Realizar curso
        </h2>
    </x-slot>

    @push('scripts')
        @vite(['resources/js/editor.js'])
    @endpush

    <x-slot name="slot">
        <div class="flex">
            <div id="reproductor"
                class="md:w-3/4 w-full bg-gray-800 text-white p-6 min-h-screen transition-all duration-1000">
                <div class="md:flex justify-end p-2 h-12 hidden">

                    <div class="bg-gray-100 flex flex-col justify-center rounded-md">
                        <div class="relative py-3 sm:max-w-xl mx-auto">
                            <nav x-data="{ open: true }">
                                <button id="toggleSidebar" type="button"
                                    class="rounded-md text-gray-500 w-10 h-10 relative focus:outline-none bg-white"
                                    @click="open = !open">
                                    <span class="sr-only">Open main menu</span>
                                    <div
                                        class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                        <span aria-hidden="true"
                                            class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                            :class="{ 'rotate-45': open, ' -translate-y-1.5': !open }"></span>
                                        <span aria-hidden="true"
                                            class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                            :class="{ 'opacity-0': open }"></span>
                                        <span aria-hidden="true"
                                            class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                            :class="{ '-rotate-45': open, ' translate-y-1.5': !open }"></span>
                                    </div>
                                </button>
                            </nav>
                        </div>
                    </div>

                </div>
                @if ($lesson)
                    <h1 class="text-2xl font-semibold mb-4"> Curso: {{ ucfirst($course->name) }} | Lección:
                        {{ ucfirst($lesson->title) }}
                    </h1>
                @else
                    <h1 class="text-2xl font-semibold mb-4"> Curso: {{ $course->name }}</h1>
                @endif
                <hr class="mb-4">
                @if ($lesson)
                    {{-- VIDEO --}}
                    @if ($lesson->lessons_types_id === 3 && $lesson->getMedia('lesson_content')->isNotEmpty())
                        <video id="lessonVideo" controls class="w-full">
                            <source src="{{ $lesson->getFirstMediaUrl('lesson_content') }}" type="video/mp4">
                            Tu navegador no soporta el tag de video.
                        </video>
                        {{-- PDF --}}
                    @elseif ($lesson->lessons_types_id === 2 && $lesson->getMedia('lesson_content')->isNotEmpty())
                        <iframe src="{{ $lesson->getFirstMediaUrl('lesson_content') }}" type="application/pdf"
                            width="100%" height="850px"></iframe>
                        {{-- IMAGEN --}}
                    @elseif ($lesson->lessons_types_id === 4 && $lesson->getMedia('lesson_content')->isNotEmpty())
                        <img src="{{ $lesson->getFirstMediaUrl('lesson_content') }}" class="" />
                        {{-- PERSONALIZADO --}}
                    @elseif ($lesson->lessons_types_id === 5)
                        <form class="space-y-4 md:space-y-6" x-data="editor({{ $data }}, true)" id="post-form">

                            <input type="hidden" name="lessonId" id="lessonId" value="{{ $lesson->id }}">
                            <input type="hidden" name="courseId" id="courseId" value="{{ $course->id }}">

                            <div id="editor"></div>

                        </form>
                    @else
                        <p>No hay video disponible para esta lección.</p>
                    @endif
                @else
                    <p>Selecciona una lección para ver su contenido.</p>
                @endif
                <hr class="mb-4 mt-4">
                <div class="md:hidden block">
                    <form id="leccionFormMovil" action="{{ route('courses.viewCourse', $course->id) }}" method="GET">
                        @method('GET')
                        @csrf
                        <div class="mb-2">
                            <label for="leccionMovil" class="block text-md font-medium text-white">Seleccionar
                                lección: </label>
                            <select id="leccionMovil" name="leccion"
                                class="mt-4 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 text-black">
                                <option class="text-black" value="0">Seleciona una lección</option>
                                @foreach ($lessons as $lesson)
                                    <option class="text-black" value="{{ $lesson->id }}"
                                        {{ session('leccion') == $lesson->id ? 'selected' : '' }}>
                                        {{ ucfirst($lesson->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contenedor principal -->

            <div id="sidebar" class="flex-1 p-8 overflow-hidden hidden md:block transition-all duration-00">
                <div class="flex-1 p-8 overflow-hidden">
                    <div class="flex mb-4">
                        <div class="w-full pr-4">
                            <form id="leccionForm" action="{{ route('courses.viewCourse', $course->id) }}"
                                method="GET">
                                @method('GET')
                                @csrf
                                <div class="mb-2">
                                    <label for="leccion" class="block text-md font-medium text-gray-600">Seleccionar
                                        lección: </label>
                                    <select id="leccion" name="leccion"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                                        <option value="0">Seleciona una lección</option>
                                        @foreach ($lessons as $lesson)
                                            <option value="{{ $lesson->id }}"
                                                {{ session('leccion') == $lesson->id ? 'selected' : '' }}>
                                                {{ ucfirst($lesson->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <div>
                                <hr class="mb-4 mt-4 border border-gray-400">
                                <label for="archivos" class="block text-md font-medium text-gray-600">Información de la
                                    lección: </label>
                                <div class="flex flex-col mt-2">
                                    <p class="text-sm font-semibold text-gray-600"><span
                                            class="font-bold underline">Descripción:</span>
                                        {{ ucfirst($lesson->subtitle) }}</p>
                                    {{-- <p class="text-sm font-semibold text-gray-600">Nº de lección: {{ $lessons->pluck('id')->search($lesson->id) + 1 }} / {{ $lessons->count() }}</p> --}}
                                </div>
                                <hr class="mb-4 mt-4 border border-gray-400">
                                <label for="archivos" class="block text-md font-medium text-gray-600">Información del
                                    curso: </label>
                                <div class="flex flex-col mt-2">
                                    <p class="text-sm font-semibold text-gray-600"><span
                                            class="font-bold underline">Descripción:</span>
                                        {{ Str::limit(ucfirst($course->description), 250) }}</p>
                                    <p class="text-sm font-semibold text-gray-600 mt-2"><span
                                            class="font-bold underline">Breve descripción:</span>
                                        {{ ucfirst($course->short_description) }}</p>
                                    <p class="text-sm font-semibold text-gray-600 mt-2"><span
                                            class="font-bold underline">Idioma:</span> {{ ucfirst($course->language) }}
                                    </p>
                                </div>
                                <hr class="mb-4 mt-4 border border-gray-400">


                                <div class="flex justify-between">

                                    <div class="w-2/4 text-center">
                                        <form action="{{ route('listCourses') }}" method="GET"
                                            class="justify-center flex">
                                            @csrf
                                            <button type="submit"
                                                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-3 rounded">Salir
                                                del curso</button>
                                        </form>
                                    </div>

                                    <div class="w-2/4 text-right">
                                        <form action="{{ route('courses.activate', $course->id) }}" method="POST"
                                            class="justify-center flex">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-8 rounded">VALIDAR</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('toggleSidebar').addEventListener('click', function() {
                var sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('md:block');
                sidebar.classList.toggle('hiddenSidebar');
                let reproductor = document.getElementById('reproductor');
                reproductor.classList.toggle('md:w-full');
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('leccion').addEventListener('change', function() {
                    // Obtén el formulario y envíalo al cambiar la opción seleccionada
                    document.getElementById('leccionForm').submit();
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('leccionMovil').addEventListener('change', function() {
                    // Obtén el formulario y envíalo al cambiar la opción seleccionada
                    document.getElementById('leccionFormMovil').submit();
                });
            });
        </script>

    </x-slot>
    @section('footer')
    @endsection
</x-app-layout>
