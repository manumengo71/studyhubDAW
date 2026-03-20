<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <x-slot name="slot">

        @push('scripts')
            @vite(['resources/js/editor.js'])
        @endpush

        <div class="flex flex-col items-center justify-center p-12">
            <div class="mx-auto w-full">
                <form action="{{ route('storeLessonStep2', $curso->id) }}" method="post" @submit.prevent="beforeSend"
                    enctype="multipart/form-data" x-data="editor" id="post-form">
                    @csrf
                    @method('POST')

                    {{-- 2 --}}
                    <div class="mb-5">
                        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                            <div class="w-full md:w-1/4">
                                <label for="content_type" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Tipo de contenido
                                </label>
                                <select name="content_type"
                                    class="w-full rounded-md border border-gray-300 py-2 ps-4 pr-7 focus:outline-none focus:border-indigo-500">
                                    <option value="2">PDF</option>
                                    <option value="3">Video</option>
                                    <option value="4">Imagen</option>
                                    <option value="5">Personalizado</option>
                                </select>

                                @error('content_type')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- MEDIA --}}
                            <div class="w-full md:w-3/4" id="inputMedia">
                                <label for="content" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Contenido de la lección
                                </label>
                                <input type="file" name="media" class="dropify rounded-md" />
                                @error('content')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EDITOR.JS --}}
                            <div class="w-full md:w-3/4 hidden" id="inputEditor">

                                <label for="content" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Contenido de la lección
                                </label>

                                <input type="hidden" name="lessonId" id="lessonId" value="{{ $lessonId }}">
                                <input type="hidden" name="courseId" id="courseId" value="{{ $curso->id }}">
                                <input type="hidden" name="content" id="content" value="">
                                <div id="editor" class="rounded-md border border-gray-300"></div>

                            </div>
                        </div>
                    </div>

                    {{-- 3 --}}
                    <div class="flex justify-center">
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Crear Lección
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <script>
            let inputMedia = document.getElementById('inputMedia');
            let inputEditor = document.getElementById('inputEditor');

            let select = document.querySelector('select[name="content_type"]');
            select.addEventListener('change', function() {
                if (this.value == 5) {
                    inputMedia.classList.add('hidden');
                    inputEditor.classList.remove('hidden');
                } else {
                    inputMedia.classList.remove('hidden');
                    inputEditor.classList.add('hidden');
                }
            });
        </script>
    </x-slot>

</x-app-layout>
