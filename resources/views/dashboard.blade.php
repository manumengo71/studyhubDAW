<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
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
                    <img src="https://i.postimg.cc/6qHZ6dh7/open-book-diary-white-paper-600nw-2133316243-removebg-preview.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/02b0QTdQ/creative-icon-set-titles-mobile-1.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Mis Cursos</p>
            </a>
            <a href="/marketplace" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/yxbMVprg/tablet-screen-online-shop-shopping-600nw-2122527749-removebg-preview.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/kGJSnftm/carrito-removebg-preview.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Marketplace</p>
            </a>
            <a href="/billinginfo" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/BZV95RYd/3d-credit-card-money-financial-600nw-2106982007-removebg-preview.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/sXSTfCVZ/tarjeta-credito-final.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Información de Pago
                </p>
            </a>
            <a href="/profile" class="group">
                <div
                    class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                    <img src="https://i.postimg.cc/jqHvtFmG/3d-realistic-user-cartoon-vector-600nw-2217542595-removebg-preview.png"
                        class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                </div>
                {{-- https://i.postimg.cc/SxzGWdfk/5979215.png --}}
                <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Mi Perfil</p>
            </a>
            @can('admin')
                <a href="/admin" class="group">
                    <div
                        class="m-2 aspect-h-1 aspect-w-1 w-52 xs:w-full md:w-full lg:w-full xl:w-full overflow-hidden flex items-center justify-center xl:aspect-h-8 xl:aspect-w-7 opcionesDashboard mx-auto">
                        <img src="https://i.postimg.cc/Y2zVb0rG/cogwheel-gear-setting-symbol-repair-600nw-2124261797-removebg-preview.png"
                            class="h-48 w-48 p-2 md:w-full md:h-full object-cover object-center">
                    </div>
                    {{-- https://i.postimg.cc/76rfmmHk/891256-removebg-preview.png --}}
                    <p class="mt-1 text-lg font-medium text-gray-900 flex items-center justify-center">Acceso Admin</p>
                </a>
            @endcan
        </div>
    </div>
</x-app-layout>
