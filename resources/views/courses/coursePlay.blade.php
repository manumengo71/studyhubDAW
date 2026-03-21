<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            <div id="reproductor" class="md:w-3/4 w-full bg-gray-800 text-white p-6 min-h-screen">
                <div class="md:flex justify-end p-2 h-12 hidden">
                    <button id="toggleSidebar" type="button"
                        class="p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#sidebar-mini" aria-controls="sidebar-mini" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle Navigation</span>
                        <svg class="flex-shrink-0 size-4" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>
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
                    <form id="leccionFormMovil" action="{{ route('mycourses.createPlay', $course->id) }}"
                        method="GET">
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

            <div id="sidebar" class="flex-1 p-8 overflow-hidden hidden md:block">
                <div class="flex-1 p-8 overflow-hidden">
                    <div class="flex mb-4">
                        <div class="w-full pr-4">
                            <form id="leccionForm" action="{{ route('mycourses.createPlay', $course->id) }}"
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
