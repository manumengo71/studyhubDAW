@extends('admin.index')

@section('content')
    {{-- @dd($input) --}}
    <div class="bg-white p-8 rounded-md w-full">

        <div>
            <h2 class="text-gray-600 font-semibold">LISTADO DE ROLES</h2>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center md:ms-10 md:me-10">
            <form action="{{ route('roles.search') }}" class="flex-1 m-4">
                <div class="flex flex-col md:flex-row rounded borde bg-white" x-data="{ search: '{{ $input['search'] ?? '' }}' }">
                    <input type="search" name="search"
                        class="w-full rounded-md border border-gray-400 px-4 py-1 text-gray-900 focus:outline-none focus:border-indigo-500"
                        placeholder="🔎 | Buscar..." x-model="search" />

                    <button class="m-2 rounded px-4 py-2 ms-4 font-semibold text-gray-100 bg-indigo-500">Buscar</button>
                </div>
                <div class="flex flex-col md:flex-row flex-wrap mt-4">
                    <p class="text-gray-600 font-semibold mt-2 mr-2">Filtrar por: </p>
                    <x-checkbox-filter id="nombre" name="nombre" label="Nombre" :value="$input['nombre'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="guard_name" name="guard_name" label="Guard Name" :value="$input['guard_name'] ?? false ? 'checked' : ''" />
                    <label class="flex items-center ml-4">
                        <select name="status"
                            class="w-full rounded-md border border-gray-300 py-2 ps-4 pr-7 focus:outline-none focus:border-indigo-500">">
                            <option value="todos"
                                {{ isset($input['status']) && $input['status'] == 'todos' ? 'selected' : '' }}>Todos
                            </option>
                            <option value="activo"
                                {{ isset($input['status']) && $input['status'] == 'activo' ? 'selected' : '' }}>Activo
                            </option>
                            <option value="inactivo"
                                {{ isset($input['status']) && $input['status'] == 'inactivo' ? 'selected' : '' }}>Inactivo
                            </option>
                        </select>
                    </label>
                    <label class="flex items-center ml-4">
                        <select name="orden"
                            class="w-full rounded-md border border-gray-300 py-2 ps-4 pr-7 focus:outline-none focus:border-indigo-500">">
                            <option value="asc"
                                {{ isset($input['orden']) && $input['orden'] == 'asc' ? 'selected' : '' }}>Ascendente
                            </option>
                            <option value="desc"
                                {{ isset($input['orden']) && $input['orden'] == 'desc' ? 'selected' : '' }}>Descendente
                            </option>
                        </select>
                    </label>
                </div>
            </form>

            <form action="{{ route('createRole') }}" class="mt-4 md:-mt-16" method="GET">
                <x-success-button class="">
                    {{ __('Nuevo Rol') }}
                </x-success-button>
            </form>
        </div>

        <script>
            abrirRoles();
        </script>

        <section>
            @yield('contentRoles') {{-- Contenido dinámico --}}
        </section>
    </div>
@endsection
