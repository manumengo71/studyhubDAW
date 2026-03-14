<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información de Pago') }}
        </h2>
    </x-slot>

    @if (session('errorCreditCard'))
        <div id="error"
            class="flex justify-center items-center m-4 font-medium py-1 px-2 bg-red rounded-md text-red-100 bg-red-700 border border-red-700 ">
            <div slot="avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-alert-octagon w-5 h-5 mx-2">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                    </polygon>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="text-xl font-normal  max-w-full flex-initial">
                {{ session('errorCreditCard') }}</div>
            <div class="flex flex-auto flex-row-reverse">
                <div>
                    <svg id="close-button" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-x cursor-pointer hover:text-red-400 rounded-full w-5 h-5 ml-2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row">
        <div class="flex-col w-full m-8 sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4">
            <div class="card">
                <div class="card-inner">
                <div class="card-front">
                    <div class="flex justify-end">
                        <img src={{ $imgUrl  }} class="{{ $style }}" />
                    </div>
                    <div class="flex">
                        <img src="https://i.postimg.cc/4NnLgpbL/chip.png" class="chip" />
                    </div>
                    <div class="flex mt-10">
                        <p class="text-sm">
                            @isset($creditCard)
                                {{ $creditCard->owner_name . ' ' . $creditCard->owner_surname . ' ' . $creditCard->owner_second_surname }}
                            @else
                                Nombre Primer Apellido Segundo Apellido
                            @endisset
                        </p>
                    </div>
                </div>
                <div class="card-back">
                    <div class="flex">
                        <div class="credit-card-band w-full h-12 mt-4"></div>
                    </div>
                    <div class="flex">
                        <p class="m-2">
                            @isset($creditCard)
                                {{ $creditCard->credit_card_number }}
                            @else
                                Nº de Tarjeta
                            @endisset
                        </p>
                    </div>
                    <div class="flex justify-end">
                        <div class="credit-card-band w-20 h-10 me-2">
                            <p class="text-right text-black">
                                @isset($creditCard)
                                    {{ $creditCard->cvv }}
                                @else
                                    CVV
                                @endisset
                            </p>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="text-sm ms-2">
                            CAD:
                            @isset($creditCard)
                                {{ $creditCard->expiration_date }}
                            @else
                                Fecha Expiración
                            @endisset
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="flex-col w-full m-8 sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-3/4">
            <P>Listado de compras</p>
        </div>
    </div>

    <script>
        document.getElementById('close-button').addEventListener('click', function() {
            document.getElementById('error').style.display = 'none';
        });
    </script>

</x-app-layout>
