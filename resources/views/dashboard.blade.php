<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 sm:max-w-xl md:w-4xl lg:w-7xl xl:max-w-7xl">
            @if (auth()->user()->hasRole('admin'))
                <div
                    class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 xl:gap-x-8">
                @else
                    <div
                        class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            @endif

            <a href="/courses" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/0ydJmGTT/my-courses.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/02b0QTdQ/creative-icon-set-titles-mobile-1.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Mis Cursos</p>
            </a>
            <a href="/marketplace" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/mrmzpL2V/marketplace.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/kGJSnftm/carrito-removebg-preview.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Marketplace</p>
            </a>
            <a href="/billinginfo" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/HLY8tcHV/billing-info.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/sXSTfCVZ/tarjeta-credito-final.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Información de Pago
                </p>
            </a>
            <a href="/profile" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/HxjJfqrm/my-profile.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/SxzGWdfk/5979215.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Mi Perfil</p>
            </a>
            @can('admin')
                <a href="/admin" class="group">
                    <div
                        class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                        <img src="https://i.postimg.cc/k4ZV9TSb/acceso-admin.png"
                            class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                    </div>
                    {{-- https://i.postimg.cc/76rfmmHk/891256-removebg-preview.png --}}
                    <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Acceso Admin</p>
                </a>
            @endcan
        </div>
    </div>

    @if (isset($mostrarTarjeta))
        {{-- Continuar donde lo dejaste Card --}}
        <div class="flex flex-wrap -mx-24 mb-5 hidden md:block">
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 mx-auto">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-indigo-500 border-0 bg-clip-border rounded-2xl mb-5 draggable">
                    <div
                        class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                        <div
                            class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/normal text-dark">
                            <span
                                class="text-white text-5xl/none font-semibold mr-2 tracking-[-0.115rem]">{{ $userNumeroCursosFinalizados }}</span>
                            <span class="pt-1 font-medium text-white/80 text-lg/normal">Cursos completados</span>
                        </div>
                    </div>
                    @if (isset($ultimoCursoEmpezado))
                        <div class="flex items-end flex-auto py-8 pt-0 px-9 ">
                            <a href="#"><img src="https://i.postimg.cc/ht4XRQtY/icons8-play-50-1.png"
                                    alt="play-icon" class="w-10 h-10 me-4"></a>
                            <div class="flex flex-col items-center w-full mt-3">
                                <div
                                    class="flex justify-between w-full mt-auto mb-2 font-semibold text-white/80 text-lg/normal">
                                    <span class="mr-4">Continúa donde lo dejaste...</span>
                                    <span>[{{ strlen($ultimoCursoEmpezado->name) > 20 ? substr($ultimoCursoEmpezado->name, 0, 20) . '...' : $ultimoCursoEmpezado->name }}]
                                        - {{ round($porcentajeCurso) }}%</span>
                                </div>

                                <div class="mx-3 rounded-2xl h-[8px] w-full bg-white/20">
                                    <div class="rounded-2xl bg-white w-[{{ $porcentajeCurso }}%] h-[8px]"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($mostrarPasosPorHacer))
                        @if ($userActual->billingInformation()->get()->isEmpty())
                            <div class="flex items-end flex-auto py-8 pt-0 px-9 ">
                                <div
                                    class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-md text-yellow-700 bg-yellow-100 border border-yellow-300 w-full">
                                    <div slot="avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-info w-5 h-5 mx-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12">
                                            </line>
                                            <line x1="12" y1="8" x2="12.01" y2="8">
                                            </line>
                                        </svg>
                                    </div>
                                    <div class="text-xl font-normal  max-w-full flex-initial">
                                        <div class="py-2"> Agrega una información de pago para comenzar. </div>
                                    </div>
                                    <div class="flex flex-auto flex-row-reverse me-2">
                                        <a href="{{ route('billinginfo') }}" class="text-blue-800 underline">Agregar</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="flex items-end flex-auto py-8 pt-0 px-9 -mb-6">
                                    <div
                                        class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-md text-green-100 bg-green-500 border border-green-700 w-full">
                                        <div slot="avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-check-circle w-5 h-5 mx-2">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </div>
                                        <div class="text-xl font-normal  max-w-full flex-initial">
                                            <div class="py-2">Se ha agregado una información de pago con éxito.</div>
                                        </div>
                                        <div class="flex flex-auto flex-row-reverse">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-end flex-auto py-8 pt-0 px-9 ">
                                    <div
                                        class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-md text-yellow-700 bg-yellow-100 border border-yellow-300 w-full">
                                        <div slot="avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-info w-5 h-5 mx-2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12">
                                                </line>
                                                <line x1="12" y1="8" x2="12.01" y2="8">
                                                </line>
                                            </svg>
                                        </div>
                                        <div class="text-xl font-normal  max-w-full flex-initial">
                                            <div class="py-2"> Compra un curso para empezar la experiencia
                                                StudyHub-App. </div>
                                        </div>
                                        <div class="flex flex-auto flex-row-reverse me-2">
                                            <a href="{{ route('marketplace') }}" class="text-blue-800 underline">Ver
                                                cursos</a>
                                        </div>
                                    </div>
                                </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif


</x-app-layout>
