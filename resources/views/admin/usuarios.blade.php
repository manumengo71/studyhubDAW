@extends('admin.index')

@section('content')
    <div class="bg-white p-8 rounded-md w-full">

        <div>
            <h2 class="text-gray-600 font-semibold">LISTADO DE USUARIOS</h2>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center md:ms-10 md:me-10">
            <form action="{{ route('users.search') }}" class="flex-1 m-4">
                <div class="flex flex-col md:flex-row rounded borde bg-white" x-data="{ search: '{{ $input['search'] ?? '' }}' }">
                    <input type="search" name="search"
                        class="w-full rounded-md border border-gray-400 px-4 py-1 text-gray-900 focus:outline-none focus:border-indigo-500"
                        placeholder="🔎 | Buscar..." x-model="search" />

                    <button class="m-2 rounded px-4 py-2 ms-4 font-semibold text-gray-100 bg-indigo-500">Buscar</button>
                </div>
                <div class="flex flex-col md:flex-row flex-wrap mt-4">
                    <p class="text-gray-600 font-semibold mt-2 mr-2">Filtrar por:</p>
                    <x-checkbox-filter id="username" name="username" label="Username" :value="$input['username'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="email" name="email" label="Email" :value="$input['email'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="nombre" name="nombre" label="Nombre" :value="$input['nombre'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="apellido1" name="apellido1" label="Primer Apellido" :value="$input['apellido1'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="apellido2" name="apellido2" label="Segundo Apellido" :value="$input['apellido2'] ?? false ? 'checked' : ''" />

                    <label class="flex items-center ml-4">
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                            class="w-full rounded-md border border-gray-300 py-2 px-4 focus:outline-none focus:border-indigo-500"
                            value="{{ $input['fecha_nacimiento'] ?? '' }}">
                    </label>

                    <label class="flex items-center ml-4">
                        <select name="biological_gender"
                            class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
                            <option value="todos"
                                {{ isset($input['biological_gender']) && $input['biological_gender'] == 'todos' ? 'selected' : '' }}>
                                Todos</option>
                            <option value="masc"
                                {{ isset($input['biological_gender']) && $input['biological_gender'] == 'masc' ? 'selected' : '' }}>
                                Masculino</option>
                            <option value="fem"
                                {{ isset($input['biological_gender']) && $input['biological_gender'] == 'fem' ? 'selected' : '' }}>
                                Femenino</option>
                            <option value="otro"
                                {{ isset($input['biological_gender']) && $input['biological_gender'] == 'otro' ? 'selected' : '' }}>
                                Otro</option>
                        </select>
                    </label>

                    <label class="flex items-center ml-4">
                        <select name="role"
                            class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">

                            <option value="todos"
                                {{ isset($input['role']) && $input['role'] == 'todos' ? 'selected' : '' }}>Todos</option>

                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }} {{ isset($input['role']) && $input['role'] == $role->id ? 'selected' : '' }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="flex items-center ml-4">
                        <select name="status"
                            class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
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
                            class="w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">">
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

            <form action="{{ route('createUser') }}" class="mt-4 md:-mt-24" method="GET">
                <x-success-button class="">
                    {{ __('Nuevo Usuario') }}
                </x-success-button>
            </form>
        </div>

        <section>
            @yield('contentUsers') {{-- Contenido dinámico --}}
        </section>
    </div>
@endsection
