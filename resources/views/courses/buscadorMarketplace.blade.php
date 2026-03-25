<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">{{ __('Marketplace') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Search Bar --}}
        <div class="bg-white rounded-2xl shadow-card p-6 mb-8 animate-fade-in">
            <form action="{{ route('marketplace.search') }}" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="search" name="search"
                            class="form-input-modern !pl-12"
                            placeholder="Buscar cursos, categorías..."
                            value="{{ $input['search'] ?? '' }}" />
                    </div>
                    <button type="submit" class="btn-primary">
                        Buscar
                    </button>
                </div>

                {{-- Filters --}}
                <div class="flex flex-wrap items-center gap-3 pt-3 border-t border-surface-100">
                    <span class="text-sm font-medium text-surface-600">Filtrar:</span>
                    
                    <x-checkbox-filter id="solocursos" name="solocursos" label="Solo Cursos" :value="$input['solocursos'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="solocategorias" name="solocategorias" label="Solo Categorías" :value="$input['solocategorias'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="nombre" name="nombre" label="Nombre" :value="$input['nombre'] ?? false ? 'checked' : ''" />
                    <x-checkbox-filter id="descripcion" name="descripcion" label="Descripción" :value="$input['descripcion'] ?? false ? 'checked' : ''" />

                    <div class="flex flex-wrap gap-2 ml-auto">
                        <select name="idioma" class="form-input-modern !py-2 !text-xs !rounded-lg min-w-[130px]">
                            <option value="0">Cualquier idioma</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language }}"
                                    {{ isset($input['idioma']) && $input['idioma'] == $language ? 'selected' : '' }}>
                                    {{ $language }}
                                </option>
                            @endforeach
                        </select>

                        <select name="categoria" class="form-input-modern !py-2 !text-xs !rounded-lg min-w-[140px]">
                            <option value="0">Cualquier categoría</option>
                            @foreach ($temas as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($input['categoria']) && $input['categoria'] == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="orden" class="form-input-modern !py-2 !text-xs !rounded-lg min-w-[120px]">
                            <option value="asc" {{ isset($input['orden']) && $input['orden'] == 'asc' ? 'selected' : '' }}>Ascendente</option>
                            <option value="desc" {{ isset($input['orden']) && $input['orden'] == 'desc' ? 'selected' : '' }}>Descendente</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        {{-- New Course Button --}}
        <div class="flex justify-end mb-6">
            <a href="{{ route('mycourses.createCourse') }}" class="btn-accent">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Curso
            </a>
        </div>

        {{-- Content Section --}}
        <section>
            @yield('content')
        </section>
    </div>

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
                    enableAll();
                } else {
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
                    categoriaSelect.disabled = true;
                    ordenSelect.disabled = true;
                    descripcionCheckbox.disabled = true;
                    nombreCheckbox.disabled = false;
                } else {
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

            function enableAll() {
                nombreCheckbox.disabled = false;
                descripcionCheckbox.disabled = false;
                idiomaSelect.disabled = false;
                categoriaSelect.disabled = false;
                ordenSelect.disabled = false;
            }

            if (!soloCursosCheckbox.checked && !soloCategoriasCheckbox.checked) {
                disableAll();
            }
        });
    </script>
</x-app-layout>
