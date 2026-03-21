<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full">
                <form action="{{ route('category.edit', $category->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mb-5">
                        <div class="md:flex md:space-x-4">
                            <div class="md:flex-col md:w-2/3">
                                <div class="w-full mb-4">
                                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Nombre
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ $category->name }}"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    @error('name')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Descripción
                                    </label>
                                    <input type="text" name="description" id="description"
                                        value="{{ $category->description }}"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    @error('description')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:flex-col md:w-1/3">
                                <div class="w-full mt-4 md:mt-0">
                                    <label for="imageCategory" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Imagen de la categoría
                                    </label>
                                    @if ($category->getMedia('images_categories')->count() > 0)
                                        <input type="file" name="imageCategory" class="dropify"
                                            data-default-file="{{ $category->getMedia('images_categories')->last()->getUrl() }}" />
                                    @else
                                        <input type="file" name="imageCategory" class="dropify"
                                            data-default-file="https://i.postimg.cc/HkL86Lc1/sinfoto.png" />
                                    @endif
                                    <input type="hidden" id="imageCategory-remove" name="imageCategory-remove"
                                        value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="button" onclick="history.back()"
                            class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Volver atrás
                        </button>
                        <button type="submit"
                            class="ms-4 hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Editar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

</x-app-layout>
