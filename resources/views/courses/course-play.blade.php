<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Realizar curso
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex h-screen">
            <div class="w-3/4 bg-gray-800 text-white p-6">
                @if ($lesson)
                    <h1 class="text-2xl font-semibold mb-4"> Curso: {{ $course->name }} | Lección: {{ $lesson->title }}
                    </h1>
                @else
                    <h1 class="text-2xl font-semibold mb-4"> Curso: {{ $course->name }}</h1>
                @endif
                <hr class="mb-4">
                @if ($lesson)
                    @if ($lesson->getMedia('lesson_content')->isNotEmpty())
                        <video id="lessonVideo" controls class="w-full">
                            <source src="{{ $lesson->getFirstMediaUrl('lesson_content') }}" type="video/mp4">
                            Tu navegador no soporta el tag de video.
                        </video>
                    @else
                        <p>No hay video disponible para esta lección.</p>
                    @endif
                @else
                    <p>Selecciona una lección para ver su contenido.</p>
                @endif
                <hr class="mb-4 mt-4">
            </div>

            <!-- Contenedor principal -->
            <div class="flex-1 p-8 overflow-hidden">

                <div class="flex mb-4">
                    <div class="w-full pr-4">
                        <form id="leccionForm" action="{{ route('mycourses.createPlay', $course->id) }}" method="GET">
                            @method('GET')
                            @csrf
                            <div class="mb-2">
                                <label for="leccion" class="block text-sm font-medium text-gray-600">Lecciones</label>
                                <select id="leccion" name="leccion"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                                    <option value="0">Seleciona una lección</option>
                                    @foreach ($lessons as $lesson)
                                        <option value="{{ $lesson->id }}"
                                            {{ session('leccion') == $lesson->id ? 'selected' : '' }}>
                                            {{ $lesson->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div>
                            <label for="archivos" class="block text-sm font-medium text-gray-600">Archivos</label>
                            <select id="archivos" name="archivos"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                                <option value="archivo1">Archivo 1</option>
                                <option value="archivo2">Archivo 2</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contenido principal (puedes agregar tu contenido aquí) -->
                <div class="flex-1 overflow-y-auto">
                    <!-- Contenido del curso -->
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('leccion').addEventListener('change', function() {
                    // Obtén el formulario y envíalo al cambiar la opción seleccionada
                    document.getElementById('leccionForm').submit();
                });
            });
        </script>
    </x-slot>
</x-app-layout>
