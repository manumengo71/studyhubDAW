<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear curso') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full">
                <form action="{{ route('storeCourse') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                            Nombre del curso
                        </label>
                        <input type="text" name="name" id="name" placeholder="Curso numero #1"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="short_description" class="mb-3 block text-base font-medium text-[#07074D]">
                            Pequeña descripción
                        </label>
                        <input type="text" name="short_description" id="short_description"
                            placeholder="Curso de programación con laravel"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        @error('short_description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                            Descripción
                        </label>
                        <textarea rows="4" name="description" id="description"
                            placeholder="En este curso aprenderas a crear un CRUD con laravel y..."
                            class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <div class="md:flex md:space-x-4">
                            <!-- Desplegable de Idioma -->
                            <div class="md:w-1/3">
                                <label for="language" class="block text-sm font-medium text-gray-700 mb-1">
                                    Idioma
                                </label>
                                <select name="language" id="language"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    <option value="Español">Español</option>
                                    <option value="Inglés">Inglés</option>
                                    <option value="Francés">Francés</option>
                                    <option value="Alemán">Alemán</option>
                                    <option value="Italiano">Italiano</option>
                                    <option value="Portugués">Portugués</option>
                                    <option value="Español">Español</option>
                                    <option value="Chino (Mandarín)">Chino (Mandarín)</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Árabe">Árabe</option>
                                    <option value="Bengalí">Bengalí</option>
                                    <option value="Ruso">Ruso</option>
                                    <option value="Japonés">Japonés</option>
                                    <option value="Malayo">Malayo</option>
                                    <option value="Telugu">Telugu</option>
                                    <option value="Vietnamita">Vietnamita</option>
                                    <option value="Coreano">Coreano</option>
                                </select>
                                @error('language')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:w-1/3">
                                <label for="owner_username" class="block text-sm font-medium text-gray-700 mb-1">
                                    Creador
                                </label>
                                <input type="text" name="owner_username" id="owner_username"
                                    value="{{ $user->username }}" readonly
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 bg-gray-100 focus:outline-none">
                                <input type="hidden" name="owner_id" id="owner_id" value="{{ $user->id }}">
                                @error('owner_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Desplegable de Categoría -->
                            <div class="md:w-1/4">
                                <label for="courses_categories_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Categoría
                                </label>
                                <select name="courses_categories_id" id="courses_categories_id"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('courses_categories_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="">
                                <label for="imageCourse" class="block text-sm font-medium text-gray-700 mb-1">
                                    Imagen del curso
                                </label>
                                <input type="file" name="imageCourse" id="imageCourse"
                                    accept="image/png, image/jpeg, image/jpg" class="dropify" data-height="100"
                                    data-default-file="https://i.postimg.cc/HkL86Lc1/sinfoto.png" />
                                @error('imageCourse')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none">
                            Crear curso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

</x-app-layout>
