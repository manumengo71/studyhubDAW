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
                <form action="{{ route('admin.storeCourse') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf


                    {{-- 1 --}}
                    <div class="mb-5">
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Nombre del curso
                                </label>
                                <input type="text" name="name" id="name" placeholder="Curso numero #1"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/2">
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
                        </div>
                    </div>

                    {{-- 2 --}}
                    <div class="mb-5">
                        <div class="flex space-x-4">
                            <div class="w-full">
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
                        </div>
                    </div>

                    {{-- 3 --}}
                    <div class="mb-5">
                        <div class="md:flex md:space-x-4">
                            <div class="md:w-1/5">
                                <label for="language" class="block text-sm font-medium text-gray-700 mb-1">
                                    Idioma
                                </label>
                                <select name="language" id="language"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    <option value="Alemán">Alemán</option>
                                    <option value="Árabe">Árabe</option>
                                    <option value="Bengalí">Bengalí</option>
                                    <option value="Chino (Mandarín)">Chino (Mandarín)</option>
                                    <option value="Coreano">Coreano</option>
                                    <option value="Español">Español</option>
                                    <option value="Francés">Francés</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Inglés">Inglés</option>
                                    <option value="Italiano">Italiano</option>
                                    <option value="Japonés">Japonés</option>
                                    <option value="Malayo">Malayo</option>
                                    <option value="Portugués">Portugués</option>
                                    <option value="Ruso">Ruso</option>
                                    <option value="Telugu">Telugu</option>
                                    <option value="Vietnamita">Vietnamita</option>
                                </select>
                                @error('language')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/5">
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Precio
                                </label>
                                <input type="number" name="price" id="price"
                                    value=0
                                    min="0"
                                    max="999"
                                    step="0.01"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none">
                            </div>
                            <div class="md:w-1/5">
                                <label for="owner_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Creador
                                </label>
                                <select name="owner_id" id="owner_id"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    @foreach ($users->sortBy('username') as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                                @error('owner_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/5">
                                <label for="courses_categories_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Categoría
                                </label>
                                <select name="courses_categories_id" id="courses_categories_id"
                                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    @foreach ($categories->sortBy('name') as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('courses_categories_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/5">
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
                            class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Crear curso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

</x-app-layout>
