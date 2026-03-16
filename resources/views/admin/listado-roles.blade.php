@extends('admin.roles')

@section('contentRoles')

    <div id="listadoRoles" class="">
        <div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    @if($roles->isNotEmpty())

                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre del rol
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        guard_name
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
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $role->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $role->guard_name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if ($role->deleted_at == null)
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
                                                    <form action="{{ route('roles.editView', $role) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('GET')
                                                        <button type="submit"
                                                            class="text-blue-500 hover:text-blue-700 flex items-center">
                                                            <img src="https://i.postimg.cc/d3nq626Q/edit.png"
                                                                class="w-8 h-8 mr-2" />
                                                        </button>
                                                    </form>
                                                </div>

                                                @if (!$role->deleted_at == null)
                                                    <div class="flex items-center">
                                                        <form action="{{ route('roles.activate', $role->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/tg1wm3qR/check.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="flex items-center">
                                                        <form action="{{ route('roles.disable', $role->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/fRq1K2hg/cross.png"
                                                                    class="w-8 h-8 mr-2" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif

                                                <div class="flex items-center">
                                                    <form id="deleteForm"
                                                        action="{{ route('roles.forceDestroy', ['id' => $role->id, 'guard_name' => $role->guard_name]) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div x-data="{ open: false }">
                                                            <button type="button" @click="open = true"
                                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                                <img src="https://i.postimg.cc/s2tqFMxY/trash.png"
                                                                    class="w-6 h-8 mr-2" />
                                                            </button>

                                                            <div x-show="open"
                                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-25">
                                                                <div class="bg-white p-6 rounded shadow-md">
                                                                    <p class="mb-4">¿Estás seguro de que deseas eliminar
                                                                        este ROLE?</p>
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
                        @else
                        <div class="flex flex-col items-center justify-center m-10">
                            <img class="w-64 h-64 mb-8" src="https://i.postimg.cc/sfq3rQXM/trsite-removebg-preview.png" alt="No results">
                            <h2 class="text-gray-600 text-2xl font-semibold">Ningún resultado</h2>
                            <p class="text-gray-500">No pudimos encontrar ningún resultado que coincida con tu búsqueda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
