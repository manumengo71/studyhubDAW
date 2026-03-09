@extends('admin.index')

@section('content')
    <div class="bg-white p-8 rounded-md w-full">

        <div>
            <h2 class="text-gray-600 font-semibold">LISTADO DE CURSOS</h2>
        </div>

        <div class="flex justify-between items-center md:ms-10 md:me-10">
            <form class="flex-1 m-4">
                <div class="flex rounded borde bg-white" x-data="{ search: '' }">
                    <input type="search" name="search"
                        class="w-full rounded-md border border-gray-400 px-4 py-1 text-gray-900 focus:outline-none focus:border-indigo-500"
                        placeholder="🔎 | Buscar..." x-model="search" />

                    <button class="m-2 rounded px-4 py-2 ms-4 font-semibold text-gray-100"
                        :class="(search) ? 'bg-blue-500' : 'bg-gray-500 cursor-not-allowed'"
                        :disabled="!search">Buscar</button>
                </div>
                <div class="flex flex-wrap mt-4">
                    <p class="text-gray-600 font-semibold mt-2">Filtrar por:</p>
                    <x-checkbox-filter id="nombre" label="Nombre" />
                    <x-checkbox-filter id="breve_descripcion" label="Breve Descripción" />
                    <x-checkbox-filter id="descripcion" label="Descripción" />
                    <x-checkbox-filter id="status" label="Status" />
                    <label class="flex items-center ml-4">
                        <select name="orden" class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
                        </select>
                    </label>
                    <label class="flex items-center ml-4">
                        <select name="orden" class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
                            @foreach ($languages as $language)

                                <option value="{{ $language }}">{{ $language }}</option>

                            @endforeach
                        </select>
                    </label>
                </div>
            </form>

            <form action="{{ route('admin.createCourse') }}" class="-mt-16" method="GET">
                <x-success-button class="">
                    {{ __('Nuevo Curso') }}
                </x-success-button>
            </form>
        </div>

        <div id="cursos-creados" class="">
            <div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre del curso
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Breve descripción
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
                                        Status
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->short_description }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->description }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $course->language }}
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
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex">
                                                <div class="flex items-center">
                                                    <a href=""
                                                        class="text-blue-500 hover:text-blue-700 flex items-center">
                                                        <img src="https://i.postimg.cc/1zjSN2zD/editar-Image.png"
                                                            class="w-8 h-8 mr-2" />
                                                    </a>
                                                </div>
                                                @if ($course->deleted_at == null)
                                                    <div class="flex items-center">
                                                        <form action="{{ route('courses.disable', $course) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/dVc5QDHc/desactivar.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @else
                                                    <div class="flex items-center">
                                                        <form action="{{ route('courses.activate', $course->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/y8F3B855/done.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                                <div class="flex items-center">
                                                    <form id="deleteForm"
                                                        action="{{ route('courses.delete', $course->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div x-data="{ open: false }">
                                                            <button type="button" @click="open = true"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/gjvrsmwC/delete-Image.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>

                                                            <div x-show="open"
                                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-25">
                                                                <div class="bg-white p-6 rounded shadow-md">
                                                                    <p class="mb-4">¿Estás seguro de que deseas eliminar
                                                                        esta categoría?</p>
                                                                    <div class="flex justify-end">
                                                                        <button type="button" @click="open = false"
                                                                            class="px-4 py-2 text-gray-600">Cancelar</button>
                                                                        <button type="submit"
                                                                            class="px-4 py-2 ml-2 bg-red-500 text-white">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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
    </div>
@endsection
