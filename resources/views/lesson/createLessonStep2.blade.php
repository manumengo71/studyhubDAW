<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <x-slot name="slot">

        @push('scripts')
            @vite(['resources/js/editor.js'])
        @endpush

        @if ($errors->any())
                    <div id="error"
                        class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-red-700 rounded-md text-white bg-red-100 border border-red-300 ">
                        <div slot="avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-alert-octagon w-5 h-5 mx-2">
                                <polygon
                                    points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                        <div class="text-xl font-normal  max-w-full flex-initial">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                        <div class="flex flex-auto flex-row-reverse">
                            <div>
                                <svg id="close-button" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-x cursor-pointer hover:text-red-400 rounded-full w-5 h-5 ml-2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

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

        <script>
            document.getElementById('close-button').addEventListener('click', function() {
                document.getElementById('error').style.display = 'none';
            });
        </script>

    </x-slot>

</x-app-layout>
