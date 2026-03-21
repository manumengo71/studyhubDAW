<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/indexAdmin.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap justify-center">
        <a href="/admin/users" class="m-2 mt-6 md:m-10 md:ms-16">
            <button id="btnUsuarios" class="button bg-white hover:bg-indigo-600 text-black font-bold py-2 px-4 rounded w-36 md:w-56">
                Listado de Usuarios
            </button>
        </a>

        <a href="/admin/courses" class="m-2 mt-6 md:m-10 md:ms-16">
            <button id="btnCursos" class="button bg-white hover:bg-indigo-600 text-black font-bold py-2 px-4 rounded w-36 md:w-56">
                Listado de Cursos
            </button>
        </a>

        <a href="/admin/categories" class="m-2 mt-6 md:m-10 md:ms-16">
            <button id="btnCategorias"
                class="button bg-white hover:bg-indigo-600 text-black font-bold py-2 px-4 rounded w-36 md:w-56">
                Listado de Categorías
            </button>
        </a>

        <a href="/admin/roles" class="m-2 mt-6 md:m-10 md:ms-16">
            <button id="btnRoles" class="button bg-white hover:bg-indigo-600 text-black font-bold py-2 px-4 rounded w-36 md:w-56">
                Listado de Roles
            </button>
        </a>
    </div>

    <script>
        let btnUsuarios = document.getElementById('btnUsuarios');
        let btnCursos = document.getElementById('btnCursos');
        let btnCategorias = document.getElementById('btnCategorias');
        let btnRoles = document.getElementById('btnRoles');

        function abrirUsuarios() {
            btnUsuarios.classList.remove('bg-white', 'text-black');
            btnUsuarios.classList.add('bg-indigo-500', 'text-white');
        }

        function abrirCursos() {
            btnCursos.classList.remove('bg-white', 'text-black');
            btnCursos.classList.add('bg-indigo-500', 'text-white');

        }

        function abrirCategorias() {
            btnCategorias.classList.remove('bg-white', 'text-black');
            btnCategorias.classList.add('bg-indigo-500', 'text-white');
        }

        function abrirRoles() {
            btnRoles.classList.remove('bg-white', 'text-black');
            btnRoles.classList.add('bg-indigo-500', 'text-white');
        }
    </script>

    <section>
        @yield('content') {{-- Contenido dinámico --}}
    </section>

</x-app-layout>
