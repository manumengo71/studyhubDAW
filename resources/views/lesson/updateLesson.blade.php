<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lecciones') }}
        </h2>
    </x-slot>

    <x-slot name="slot">

        @push('scripts')
            @vite(['resources/js/editor.js'])
        @endpush

        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full">
                @if ($lessonType->id === 5)
                    <form action="{{ route('updateLesson', $lesson->id) }}" method="POST" @submit.prevent="beforeSend"
                        enctype="multipart/form-data" x-data="editor({{ $data }})" id="post-form">
                    @else
                        <form action="{{ route('updateLesson', $lesson->id) }}" method="POST"
                            enctype="multipart/form-data">
                @endif
                @csrf
                @method('PATCH')
                <input type="hidden" id="courseId" value="{{ $lesson->courses_id }}">
                <input type="hidden" id="lessonId" value="{{ $lesson->id }}">
                {{-- 1 --}}
                <div class="mb-5">
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="title" class="mb-3 block text-base font-medium text-[#07074D]">
                                Título de la lección
                            </label>
                            <input type="text" name="title" id="title" value="{{ $lesson->title }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            @error('title')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="subtitle" class="mb-3 block text-base font-medium text-[#07074D]">
                                Subtítulo
                            </label>
                            <input type="text" name="subtitle" id="subtitle" value="{{ $lesson->subtitle }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            @error('subtitle')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 2 --}}
                <div class="mb-5">
                    <div class="flex space-x-4">
                        <div class="w-1/3">
                            <label for="content_type" class="mb-3 block text-base font-medium text-[#07074D]">
                                Tipo de contenido
                            </label>
                            <input type="hidden" name="content_type" value="{{ $lessonType->id }}">
                            <select name="content_type" disabled
                                class="ps-6 w-full rounded-md border border-gray-300 py-2 pr-7 focus:outline-none focus:border-indigo-500">
                                <option value="{{ $lessonType->id }}">{{ $lessonType->name }}</option>
                            </select>

                            @error('content_type')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        @if ($lessonType->id == 5)
                            <input type="hidden" name="content" id="content" value="">
                            <div id="editor"></div>
                        @else
                            <div class="w-2/3">
                                <x-input-label for="imageCourse" :value="__('Contenido de la lección')" />
                                @if ($lesson->getMedia('lesson_content')->count() > 0)
                                    <input type="file" name="media" class="dropify"
                                        data-default-file="{{ $lesson->getMedia('lesson_content')->last()->getUrl() }}" />
                                @else
                                    <input type="file" name="meida" class="dropify" />
                                @endif
                                <input type="hidden" id="imageCourse-remove" name="imageCourse-remove" value="0">
                            </div>
                        @endif

                    </div>
                </div>

                {{-- 3 --}}
                <div class="flex justify-center">
                    <button type="submit"
                        class="hover:shadow-form rounded-md bg-indigo-500 py-3 px-8 text-base font-semibold text-white outline-none">
                        Editar
                    </button>
                </div>
                </form>
            </div>
        </div>
    </x-slot>

</x-app-layout>
