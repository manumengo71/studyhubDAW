<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>

    <div class="flex flex-col md:flex-row justify-between items-center md:ms-10 md:me-10">
        <form action="{{ route('marketplace.search') }}" class="flex-1 m-4">
            <div class="flex flex-col md:flex-row rounded borde bg-white" x-data="{ search: '{{ $input['search'] ?? '' }}' }">
                <input type="search" name="search"
                    class="w-full rounded-md border border-gray-400 px-4 py-1 text-gray-900 focus:outline-none focus:border-indigo-500"
                    placeholder="🔎 | Buscar..." x-model="search" />

                <button class="m-2 rounded px-4 py-2 ms-4 font-semibold text-gray-100"
                    :class="(search) ? 'bg-indigo-500' : 'bg-indigo-500'">
                    Buscar</button>
            </div>
            <div class="flex flex-wrap mt-4">
                <p class="text-gray-600 font-semibold me-4 flex items-center">Filtrar por: </p>
                <x-checkbox-filter id="solocursos" name="solocursos" label="Solo Cursos" :value="$input['solocursos'] ?? false ? 'checked' : ''" />
                {{-- <label class="flex items-center mr-4">
                    <input type="checkbox" name="solocursos" class="form-checkbox"
                        {{ $input['solocursos'] ?? false ? 'checked' : '' }}>
                    <span class="ml-2">Solo cursos</span>
                </label> --}}
                <x-checkbox-filter id="solocategorias" name="solocategorias" label="Solo Categorias"
                    :value="$input['solocategorias'] ?? false ? 'checked' : ''" />
                <x-checkbox-filter id="nombre" name="nombre" label="Nombre" :value="$input['nombre'] ?? false ? 'checked' : ''" />
                <x-checkbox-filter id="descripcion" name="descripcion" label="Descripción" :value="$input['descripcion'] ?? false ? 'checked' : ''" />

                <div class="flex flex-wrap md:flex-nowrap">
                    <label class="flex items-center mr-4">
                        <select name="idioma"
                            class="form-select block w-full mt-1 rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">
                            <option value="0">Ninguna idioma</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language }}"
                                    {{ isset($input['idioma']) && $input['idioma'] == $language ? 'selected' : '' }}>
                                    {{ $language }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <label class="flex items-center mr-4">
                        <select name="categoria"
                            class="form-select block w-full mt-1 rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">
                            <option value="0">Ninguna categoría</option>
                            @foreach ($temas as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($input['categoria']) && $input['categoria'] == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <label class="flex items-center mr-4">
                        <select name="orden"
                            class="form-select block w-full mt-1 rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">
                            <option value="asc"
                                {{ isset($input['orden']) && $input['orden'] == 'asc' ? 'selected' : '' }}>Ascendente
                            </option>
                            <option value="desc"
                                {{ isset($input['orden']) && $input['orden'] == 'desc' ? 'selected' : '' }}>Descendente
                            </option>
                        </select>
                    </label>
                </div>
            </div>
        </form>
        <form action="{{ route('mycourses.createCourse') }}" class="-mt-14 ms-6 md:-mt-16 md:ms-0" method="GET">
            <x-success-button class="">
                {{ __('Nuevo Curso') }}
            </x-success-button>
        </form>
    </div>

    <section>
        @yield('content')
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const soloCursosCheckbox = document.querySelector('input[name="solocursos"]');
            const soloCategoriasCheckbox = document.querySelector('input[name="solocategorias"]');
            const nombreCheckbox = document.querySelector('input[name="nombre"]');
            const descripcionCheckbox = document.querySelector('input[name="descripcion"]');
            const idiomaSelect = document.querySelector('select[name="idioma"]');
            const categoriaSelect = document.querySelector('select[name="categoria"]');
            const ordenSelect = document.querySelector('select[name="orden"]');

            soloCursosCheckbox.addEventListener('change', function() {
                if (soloCursosCheckbox.checked) {
                    soloCategoriasCheckbox.checked = false;

                    nombreCheckbox.checked = false;
                    descripcionCheckbox.checked = false;
                    idiomaSelect.value = '0';
                    categoriaSelect.value = '0';
                    ordenSelect.value = 'asc';

                    idiomaSelect.disabled = false;
                    idiomaSelect.classList.remove('disabled');

                    categoriaSelect.disabled = false;
                    categoriaSelect.classList.remove('disabled');

                    ordenSelect.disabled = false;
                    ordenSelect.classList.remove('disabled');

                    descripcionCheckbox.disabled = false;
                    descripcionCheckbox.classList.remove('disabled');

                    nombreCheckbox.disabled = false;
                    nombreCheckbox.classList.remove('disabled');
                }

                if (soloCursosCheckbox.checked == false) {
                    nombreCheckbox.checked = false;
                    descripcionCheckbox.checked = false;
                    idiomaSelect.value = '0';
                    categoriaSelect.value = '0';
                    ordenSelect.value = 'asc';
                    disableAll();
                }
            });

            soloCategoriasCheckbox.addEventListener('change', function() {
                if (soloCategoriasCheckbox.checked) {
                    soloCursosCheckbox.checked = false;

                    nombreCheckbox.checked = false;
                    descripcionCheckbox.checked = false;
                    idiomaSelect.value = '0';
                    categoriaSelect.value = '0';
                    ordenSelect.value = 'asc';

                    idiomaSelect.disabled = true;
                    idiomaSelect.classList.add('disabled');
                    idiomaSelect.value = '0';

                    categoriaSelect.disabled = true;
                    categoriaSelect.classList.add('disabled');
                    categoriaSelect.value = '0';

                    ordenSelect.disabled = true;
                    ordenSelect.classList.add('disabled');
                    ordenSelect.value = 'asc';

                    descripcionCheckbox.disabled = true;
                    descripcionCheckbox.classList.add('disabled');
                    descripcionCheckbox.checked = false;

                    nombreCheckbox.disabled = false;
                    nombreCheckbox.classList.remove('disabled');
                }

                if (soloCategoriasCheckbox.checked == false) {
                    nombreCheckbox.checked = false;
                    disableAll();
                }
            });

            function disableAll() {
                nombreCheckbox.disabled = true;
                descripcionCheckbox.disabled = true;
                idiomaSelect.disabled = true;
                categoriaSelect.disabled = true;
                ordenSelect.disabled = true;
            }

            if (!soloCursosCheckbox.checked && !soloCategoriasCheckbox.checked) {
                disableAll();
            }
        });
    </script>

</x-app-layout>
