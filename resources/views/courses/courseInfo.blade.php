<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <x-slot name="slot">

        <div class="bg-white">
            <main class="m-8">
                <div class="min-w-screen min-h-screen flex items-center p-5 lg:p-10 overflow-hidden relative">
                    <div
                        class="w-full max-w-6xl rounded bg-gray-300 shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
                        <div class="md:flex items-center -mx-10">
                            <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                                <div class="relative">
                                    <img src="{{ $courseImage }}" class="w-full relative z-10" alt="">
                                    <div
                                        class="border-4 border-yellow-200 absolute top-10 bottom-10 left-10 right-10 z-0">
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-10">
                                <div class="mb-10">
                                    <h1 class="font-bold uppercase text-2xl mb-3">Información relativa al curso:</h1>
                                    <h2 class="font-bold uppercase text-xl mb-5">{{ $course->name }}</h2>
                                    <p class="text-sm mb-2"><span class="text-black font-bold">Descripción corta:
                                        </span>{{ $course->short_description }}</p>
                                    <p class="text-sm mb-2"><span class="text-black font-bold">Descripción:
                                        </span>{{ $course->description }}</p>
                                    <p class="text-sm mb-2"><span class="text-black font-bold">Idioma:
                                        </span>Español</p>
                                    <p class="text-sm mb-2"><span class="text-black font-bold">Nº Lecciones:
                                        </span>2</p>
                                </div>
                                <div>
                                    {{-- <div class="inline-block align-bottom mr-5">
                                        <span class="text-2xl leading-none align-baseline">$</span>
                                        <span class="font-bold text-5xl leading-none align-baseline">59</span>
                                        <span class="text-2xl leading-none align-baseline">.99</span>
                                    </div> --}}
                                    <div class="inline-block align-bottom">
                                        <button
                                            class="bg-blue-600 hover:opacity-75 text-black hover:text-gray-900 rounded-full px-10 py-2 font-semibold"><i
                                                class="mdi mdi-cart -ml-2 mr-2"></i> EMPEZAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </x-slot>
</x-app-layout>
