@extends('admin.index')

@section('content')
    <div class="bg-white p-8 rounded-md w-full">

        <div>
            <h2 class="text-gray-600 font-semibold">LISTADO DE USUARIOS</h2>
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
                    <x-checkbox-filter id="username" label="Username" />
                    <x-checkbox-filter id="email" label="Email" />
                    <x-checkbox-filter id="nombre" label="Nombre" />
                    <x-checkbox-filter id="apellido1" label="Primer Apellido" />
                    <x-checkbox-filter id="apellido2" label="Segundo Apellido" />
                    <x-checkbox-filter id="status" label="Status" />
                    <label class="flex items-center ml-4">
                        <input type="date" name=fecha_nacimiento id="fecha_nacimiento"
                            class="w-full rounded-md border border-gray-300 py-2 px-4 focus:outline-none focus:border-indigo-500">
                    </label>
                    <label class="flex items-center ml-4">
                        <select name="biological_gender" class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
                            <option value="masc">Masculino</option>
                            <option value="fem">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </label>
                    <label class="flex items-center ml-4">
                        <select name="role" class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>

                            @endforeach
                        </select>
                    </label>
                    <label class="flex items-center ml-4">
                        <select name="orden" class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
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

        {{-- <div class="flex items-center justify-between">
            <div class="flex items-center p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>
                <input class="outline-none ml-1 block " type="text" name="" id=""
                    placeholder="Buscar...">
                <div class="lg:ml-40 ml-10 space-x-8">
                    <form action="{{ route('createUser') }}" method="GET">
                        <button
                            class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Nuevo
                            Usuario</button>
                    </form>
                </div>
            </div>
        </div> --}}

        <div id="cursos-creados" class="">
            <div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Primer apellido
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Segundo apellido
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Fecha de nacimiento
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Género biológico
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Rol
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->username }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->email }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->profile->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->profile->surname }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->profile->second_surname }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->profile->birthdate ? $user->profile->birthdate->format('d-m-Y') : '' }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->profile->biological_gender }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                @if ($user->roles->isEmpty())
                                                    Sin Rol
                                                @else
                                                    {{ $user->roles->first()->name }}
                                                @endif
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if ($user->deleted_at == null)
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
                                                    <a href="editUser/{{ $user->id }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                                                        <img src="https://i.postimg.cc/1zjSN2zD/editar-Image.png" class="w-8 h-8 mr-2" />
                                                    </a>
                                                </div>
                                                @if ($user->deleted_at == null)
                                                    <div class="flex items-center">
                                                        <form action="{{ route('users.disable', $user) }}"
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
                                                        <form action="{{ route('users.activate', $user->id) }}"
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
                                                        action="{{ route('users.delete', $user) }}"
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
                                                                        este usuario?</p>
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
