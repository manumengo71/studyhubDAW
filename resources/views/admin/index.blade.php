<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    {{-- Crear cinco botones --}}
    <div class="flex justify-center">
        <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
            <a href="/admin/users">Listado de Usuarios</a>
        </button>

        <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
            <a href="/admin/courses">Listado de Cursos</a>
        </button>

        <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
            <a href="/admin/categories">Categorías</a>
        </button>

        <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
            <a href="/admin/roles">Roles</a>
        </button>
    </div>

    <section>
        @yield('content') {{-- Contenido dinámico --}}
    </section>

</x-app-layout>
