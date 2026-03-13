<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información de Pago') }}
        </h2>
    </x-slot>

    <div class="flex flex-col md:flex-row">
        <div class="flex-col w-full m-8 md:w-1/4">
            <div class="card">
                <div class="card-inner">
                <div class="card-front">
                    <div class="flex justify-end">
                        <img src="https://i.postimg.cc/pVnKRTPJ/logo.jpg" class="w-16 h-16 rounded-full" />
                    </div>
                    <div class="flex">
                        <img src="https://i.postimg.cc/4NnLgpbL/chip.png" class="chip" />
                    </div>
                    <div class="flex mt-10">
                        <p class="text-sm">{{auth()->user()->profile->name . ' ' . auth()->user()->profile->surname . ' ' . auth()->user()->profile->second_surname }}</p>
                    </div>
                </div>
                <div class="card-back">
                    <div class="flex">
                        <div class="credit-card-band w-full h-12 mt-4"></div>
                    </div>
                    <div class="flex">
                        <p class="m-2">12345678910111213</p>
                    </div>
                    <div class="flex justify-end">
                        <div class="credit-card-band w-20 h-10 me-2">
                            <p class="text-right text-black">111</p>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="text-sm ms-2">CAD: 05/25</p>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="flex-col w-full m-8 md:w-3/4">
            <P>Listado de compras</p>
        </div>
    </div>


</x-app-layout>
