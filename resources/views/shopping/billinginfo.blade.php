<x-app-layout>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div id="error-new-card"
                class="flex justify-center items-center m-4 font-medium py-1 px-2 bg-red rounded-md text-red-100 bg-red-700 border border-red-700 ">
                <div slot="avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-alert-octagon w-5 h-5 mx-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                        </polygon>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div class="text-xl font-normal  max-w-full flex-initial">
                    {{ $error }}</div>
                <div class="flex flex-auto flex-row-reverse">
                </div>
            </div>
        @endforeach
    @endif

    <div class="flex flex-col sm:flex-row">
        <div class="flex-col w-full m-8 sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4">
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="flex justify-end">
                            <img src={{ $imgUrl }} class="{{ $style }}" />
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

            <div class="justify-start flex m-4 mt-8">
                <button class="BtnEditar w-28" id="botonEditar">
                    @if (isset($creditCard))
                        <p>Editar</p>
                    @else
                        <p>Añadir</p>
                    @endif
                    <svg viewBox="0 0 512 512" class="svgEditar">
                        <path
                            d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                        </path>
                    </svg>
                </button>

                {{-- <p class="ms-5 text-center mt-2 font-bold text-gray-700">Edita o añade tu tarjeta.</p> --}}
            </div>

            <form id="newCardForm" method="POST" action="{{ route('storeCreditCard') }}" class="mt-8">
                @method('POST')
                @csrf

                <div class="w-full">
                    <input placeholder="Nombre del titular" name="name" id="name"
                        class="mb-2 w-full bg-[#292929] border-2 border-[#3e3e3e] rounded-lg text-white px-3 py-1 text-sm hover:border-[#fff] cursor-pointer transition"
                        type="text" value="{{ old('name') }}" required />
                </div>

                <div class="flex flex-col md:flex-row justify-center">
                    <input placeholder="Apellido del titular" name="surname" id="surname"
                        class="mb-2 md:mb-0 md:me-2 w-full bg-[#292929] border-2 border-[#3e3e3e] rounded-lg text-white px-3 py-1 text-sm hover:border-[#fff] cursor-pointer transition"
                        type="text" value="{{ old('surname') }}" required />
                    <input placeholder="2º Apellido del titular" name="second-surname" id="second_surname"
                        class="w-full bg-[#292929] border-2 border-[#3e3e3e] rounded-lg text-white px-3 py-1 text-sm hover:border-[#fff] cursor-pointer transition"
                        type="text" value="{{ old('second-surname') }}" required />
                </div>

                <div class="mt-4 flex items-center justify-center bg-gray-800 overflow-hidden p-1 border border-white border-opacity-30 rounded-lg shadow-md h-9"
                    id="editForm1">
                    <input
                        class="w-42 h-full border-none outline-none text-sm bg-gray-800 text-white font-semibold caret-orange-500 pl-2"
                        type="text" name="input-number-card" id="input-number-card"
                        placeholder="0000 0000 0000 0000" maxlength="16" value="{{ old('input-number-card') }}"
                        required />
                    <div
                        class="flex items-center justify-center relative w-10 h-6 bg-gray-200 border border-white border-opacity-20 rounded-md">
                        <svg viewBox="0 0 256 83" width="33" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient y2="100%" y1="-2.006%" x2="54.877%" x1="45.974%"
                                    id="logosVisa0">
                                    <stop stop-color="#222357" offset="0%"></stop>
                                    <stop stop-color="#254AA5" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <img id="card-image" src="https://i.postimg.cc/QMKhtNJW/visa.png" class="w-full" />
                        </svg>
                    </div>
                    <div>
                        <button class="flex justify-center ms-2" id="botonExpireDate" type="button">
                            <svg viewBox="0 0 24 24" class="w-6 h-6" fill="white">
                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-center bg-gray-800 overflow-hidden p-1 border border-white border-opacity-30 rounded-lg shadow-md h-9"
                    id="editForm2">

                    {{-- <div>
                        <button class="flex justify-center ms-2" id="" type="button">
                            <svg viewBox="0 0 24 24" class="w-6 h-6" fill="white">
                                <path d="M12 20l1.41-1.41L7.83 13H20v-2H7.83l5.58-5.59L12 4l-8 8z"></path>
                            </svg>
                        </button>
                    </div> --}}

                    <input
                        class="w-42 h-full border-none outline-none text-sm bg-gray-800 text-white font-semibold caret-orange-500 pl-2"
                        type="text" name="input-expire-date-card" id="input-expire-date-card" placeholder="00/00"
                        maxlength="5" value="{{ old('input-expire-date-card') }}" required />
                    <div
                        class="flex items-center justify-center relative w-10 h-6 bg-gray-200 border border-white border-opacity-20 rounded-md">
                        <strong>EXP</strong>
                    </div>
                    <div>
                        <button class="flex justify-center ms-2" type="button" id="buttonCvv">
                            <svg viewBox="0 0 24 24" class="w-6 h-6" fill="white">
                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
                            </svg>
                        </button>
                    </div>
                </div>


                <div class="mt-4 flex items-center justify-center bg-gray-800 overflow-hidden p-1 border border-white border-opacity-30 rounded-lg shadow-md h-9"
                    id="editForm3">

                    {{-- <div>
                        <button class="flex justify-center ms-2" id="" type="button">
                            <svg viewBox="0 0 24 24" class="w-6 h-6" fill="white">
                                <path d="M12 20l1.41-1.41L7.83 13H20v-2H7.83l5.58-5.59L12 4l-8 8z"></path>
                            </svg>
                        </button>
                    </div> --}}

                    <input
                        class="w-42 h-full border-none outline-none text-sm bg-gray-800 text-white font-semibold caret-orange-500 pl-2"
                        type="text" name="input-cvv-card" id="input-cvv-card" placeholder="123" maxlength="3"
                        value="{{ old('input-cvv-card') }}" required />
                    <div
                        class="flex items-center justify-center relative w-10 h-6 bg-gray-200 border border-white border-opacity-20 rounded-md">
                        <strong>CVV</strong>
                    </div>
                    <div>
                        <button class="flex justify-center ms-2" type="submit" id="buttonSubmit">
                            <img src="https://i.postimg.cc/85FHjRMR/icons8-upload-50.png" class="w-6 h-6">
                        </button>
                    </div>
                </div>
            </form>

        </div>


        <div class="w-full m-10 sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-3/4 ml-12">
            <p class="text-black bg-green-100 rounded-lg p-2">Listado de compras:</p>

            <div
                class="rounded-[10px] border-[1px] border-gray-200 p-4 bg-white bg-clip-border shadow-md shadow-[#F3F3F3] dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
                <div class="flex items-center justify-between rounded-t-3xl p-3 w-full">
                    <div class="text-lg font-bold text-navy-700 dark:text-black">
                        Historial de compras:
                    </div>
                </div>
                @if (isset($coursesHistory))
                    @foreach ($coursesHistory as $courseHistory)
                        <div
                            class="flex flex-col md:flex-row h-full w-full items-start justify-between rounded-md border-[1px] border-[transparent] dark:hover:border-white/20 bg-white px-3 py-[20px] transition-all duration-150 hover:border-gray-200 dark:!bg-navy-800 dark:hover:!bg-navy-700">
                            <div class="flex items-center gap-3">
                                <div class="flex h-16 w-16 items-center justify-center">
                                    @if ($courseHistory->course->getMedia('courses_images')->count() > 0)
                                        <img class="h-full w-full rounded-xl"
                                            src="{{ $courseHistory->course->getMedia('courses_images')->last()->getUrl() }}"
                                            alt="" />
                                    @else
                                        <img class="h-full w-full rounded-xl"
                                            src="https://i.postimg.cc/HkL86Lc1/sinfoto.png" alt="" />
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <h5 class="text-base font-bold text-navy-700 dark:text-black">
                                        {{ $courseHistory->course->name }}
                                    </h5>
                                    <p class="mt-1 text-sm font-normal text-gray-600">
                                        Creado por: <span
                                            class="font-bold">{{ $courseHistory->course->owner->username }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-1 flex items-center justify-center text-navy-700 text-gray-600">
                                {{-- <div>
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512"
                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z">
                                </path>
                            </svg>
                        </div> --}}
                                <div
                                    class="ml-1 hidden lg:flex items-center text-sm font-bold text-navy-700 text-gray-600">
                                    <p>| PRECIO: </p>
                                    <p class="ml-1"> GRATIS |</p>
                                </div>
                                <div class="ml-2 hidden lg:flex items-center text-sm font-normal text-gray-600">
                                    <p>Fecha de compra: </p>
                                    <p class="ml-1">
                                        {{ \Carbon\Carbon::parse($courseHistory->created_at)->format('d/m/Y') }} | </p>
                                </div>
                                <div class="ml-2 flex items-center text-sm font-normal dark:text-black">
                                    <a href="{{ route('downloadPdf', ['id' => $courseHistory->id]) }}"><button
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            id="printButton">Descargar</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $coursesHistory->links() }}
                @else
                    <p class="text-black italic">No hay historial de compras.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        var form = document.getElementById('newCardForm');
        form.addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        var editform1 = document.getElementById('editForm1');
        editform1.style.display = 'none';
        var editform2 = document.getElementById('editForm2');
        editform2.style.display = 'none';
        var editform3 = document.getElementById('editForm3');
        editform3.style.display = 'none';

        var inputName = document.getElementById('name');
        inputName.style.display = 'none';
        var inputSurname = document.getElementById('surname');
        inputSurname.style.display = 'none';
        var inputSecondSurname = document.getElementById('second_surname');
        inputSecondSurname.style.display = 'none';

        document.getElementById('botonEditar').addEventListener('click', function() {
            if (editform1.style.display === 'none') {
                editform1.style.display = '';
                inputName.style.display = '';
                inputSurname.style.display = '';
                inputSecondSurname.style.display = '';
            } else {
                editform1.style.display = 'none';
                editform2.style.display = 'none';
                editform3.style.display = 'none';
            }
        });

        document.getElementById('botonExpireDate').addEventListener('click', function() {
            editform2.style.display = '';
        });

        document.getElementById('buttonCvv').addEventListener('click', function() {
            editform3.style.display = '';
        });

        document.getElementById('buttonSubmit').addEventListener('click', function() {
            var form = document.getElementById('newCardForm');
            if (form.checkValidity()) {
                form.submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor, rellena todos los campos requeridos.',
                })
            }
        });
    </script>


    <script>
        var input = document.getElementById('input-number-card');
        var image = document.getElementById('card-image');

        input.addEventListener('input', function() {
            var firstNumber = input.value[0];

            switch (firstNumber) {
                case '4':
                    image.src = 'https://i.postimg.cc/QMKhtNJW/visa.png';
                    break;
                case '3':
                    image.src = 'https://i.postimg.cc/4xSXsHVg/americanexpress.png';
                    break;
                case '5':
                    image.src = 'https://i.postimg.cc/7ZwdTH1W/mastercard.png';
                    break;
                default:
                    image.src = 'https://i.postimg.cc/XvNH59xr/otro.png';
            }
        });
    </script>

    <script>
        document.getElementById('close-button').addEventListener('click', function() {
            document.getElementById('error').style.display = 'none';
        });
    </script>


</x-app-layout>
