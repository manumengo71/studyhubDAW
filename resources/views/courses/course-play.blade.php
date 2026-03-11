<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso: {{ $course->name }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex h-screen">
            <div class="w-3/4 bg-gray-800 text-white p-6">
                <h1 class="text-2xl font-semibold mb-4">{{ $course->name }}</h1>
                <hr class="mb-4">
                <video controls class="w-full">
                    <source src="#" type="video/mp4">
                </video>
                <hr class="mb-4 mt-4">
            </div>

            <!-- Contenedor principal -->
            <div class="flex-1 p-8 overflow-hidden">

                <div class="flex mb-4">
                    <div class="w-3/4 pr-4">
                        <div class="mb-2">
                            <label for="leccion" class="block text-sm font-medium text-gray-600">Lecciones</label>
                            <select id="leccion" name="leccion"
                                class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                                <option value="leccion1">Lección 1</option>
                                <option value="leccion2">Lección 2</option>
                            </select>
                        </div>

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
                    <!-- Contenido del curso -->sss
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
