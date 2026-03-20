<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actualizar curso') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full">
                <form action="{{ route('admin.updateCourse', $courseInfo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- 1 --}}
                    <div class="mb-5">
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Nombre del curso
                                </label>
                                <input type="text" name="name" id="name" value="{{$courseInfo->name}}"
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
                                    value="{{$courseInfo->short_description}}"
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
                                    class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ $courseInfo->description }}</textarea>
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
                                <select name="language" id="language" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    <option value="Alemán" {{ $courseInfo->language == 'Alemán' ? 'selected' : '' }}>Alemán</option>
                                    <option value="Árabe" {{ $courseInfo->language == 'Árabe' ? 'selected' : '' }}>Árabe</option>
                                    <option value="Bengalí" {{ $courseInfo->language == 'Bengalí' ? 'selected' : '' }}>Bengalí</option>
                                    <option value="Chino (Mandarín)" {{ $courseInfo->language == 'Chino (Mandarín)' ? 'selected' : '' }}>Chino (Mandarín)</option>
                                    <option value="Coreano" {{ $courseInfo->language == 'Coreano' ? 'selected' : '' }}>Coreano</option>
                                    <option value="Español" {{ $courseInfo->language == 'Español' ? 'selected' : '' }}>Español</option>
                                    <option value="Francés" {{ $courseInfo->language == 'Francés' ? 'selected' : '' }}>Francés</option>
                                    <option value="Hindi" {{ $courseInfo->language == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                                    <option value="Inglés" {{ $courseInfo->language == 'Inglés' ? 'selected' : '' }}>Inglés</option>
                                    <option value="Italiano" {{ $courseInfo->language == 'Italiano' ? 'selected' : '' }}>Italiano</option>
                                    <option value="Japonés" {{ $courseInfo->language == 'Japonés' ? 'selected' : '' }}>Japonés</option>
                                    <option value="Malayo" {{ $courseInfo->language == 'Malayo' ? 'selected' : '' }}>Malayo</option>
                                    <option value="Portugués" {{ $courseInfo->language == 'Portugués' ? 'selected' : '' }}>Portugués</option>
                                    <option value="Ruso" {{ $courseInfo->language == 'Ruso' ? 'selected' : '' }}>Ruso</option>
                                    <option value="Telugu" {{ $courseInfo->language == 'Telugu' ? 'selected' : '' }}>Telugu</option>
                                    <option value="Vietnamita" {{ $courseInfo->language == 'Vietnamita' ? 'selected' : '' }}>Vietnamita</option>
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
                                    value="{{ number_format($courseInfo->price, 2) }}"
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
                                        <option value="{{ $user->id }}" {{ $courseInfo->owner_id == $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
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
                                <select name="courses_categories_id" id="courses_categories_id" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:border-indigo-500">
                                    @foreach ($categories->sortBy('name') as $category)
                                        <option value="{{ $category->id }}" {{ $courseInfo->courses_categories_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('courses_categories_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/5">
                                <x-input-label for="imageCourse" :value="__('Imagen del curso')" />
                                @if ($courseInfo->getMedia('courses_images')->count() > 0)
                                    <input type="file" name="imageCourse" class="dropify"
                                        data-default-file="{{ $courseInfo->getMedia('courses_images')->last()->getUrl() }}" />
                                @else
                                    <input type="file" name="imageCourse" class="dropify"
                                        data-default-file="https://i.postimg.cc/HkL86Lc1/sinfoto.png" />
                                @endif
                                <input type="hidden" id="imageCourse-remove" name="imageCourse-remove" value="0">
                            </div>

                        </div>
                    </div>



                    <div class="flex justify-center">
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Editar Curso
                        </button>
                    </div>
                </form>

                <div class="mb-5">
                    <div class="md:flex md:space-x-4">

                        <div x-data="accordion(1)" class="md:w-full mt-4 relative transition-all duration-700 border-2  rounded-xl hover:shadow-2xl">
                            <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                            <div class="flex items-center justify-between">
                                <span class="tracking-wide">Lecciones</span>
                                <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current ">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                                </span>
                            </div>
                            </div>

                            <div x-ref="tab" :style="handleToggle()" class="relative overflow-hidden transition-all duration-700 max-h-0">
                            <div class="px-6 pb-4 text-gray-600">
                                @foreach ($lessons as $lesson)
                                    <div class="flex items-center justify-between">
                                        <div class="font-bold">- {{ $lesson->title}} </div>

                                        <div class="flex items-center">
                                            <form action="{{ route('admin.editLesson', $lesson->id) }}" method="GET" class="inline">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="flex items-center">
                                                    <img src="https://i.postimg.cc/d3nq626Q/edit.png" class="w-8 h-8 mr-2" />
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-center mt-3">
                        <form action="{{route('admin.createLessonStep1', $courseInfo->id)}}" method="GET">
                            @csrf
                            @method('GET')
                            <button type="submit"
                                class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                                Crear Lección
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
        <script>
            document.addEventListener("alpine:init", () => {
            Alpine.store("accordion", {
                tab: 0
            });

            Alpine.data("accordion", (idx) => ({
                init() {
                this.idx = idx;
                },
                idx: -1,
                handleClick() {
                this.$store.accordion.tab =
                    this.$store.accordion.tab === this.idx ? 0 : this.idx;
                },
                handleRotate() {
                return this.$store.accordion.tab === this.idx ? "-rotate-180" : "";
                },
                handleToggle() {
                return this.$store.accordion.tab === this.idx
                    ? `max-height: ${this.$refs.tab.scrollHeight}px`
                    : "";
                }
            }));
            });

        </script>
    </x-slot>

</x-app-layout>
