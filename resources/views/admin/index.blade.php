<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    {{-- Crear cinco botones --}}
    <div class="md:flex md:justify-center">
        <a href="/admin/users">
            <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
                Listado de Usuarios
            </button>
        </a>

        <a href="/admin/courses">
            <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
                Listado de Cursos
            </button>
        </a>

        <a href="/admin/categories">
            <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
                Listado de Categorías
            </button>
        </a>

        <a href="/admin/roles">
            <button class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold mx-8 my-8 py-2 px-4 rounded">
                Listado de Roles
            </button>
        </a>

    </div>

    <section>
        @yield('content') {{-- Contenido dinámico --}}
    </section>

</x-app-layout>
