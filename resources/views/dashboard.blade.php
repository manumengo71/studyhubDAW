<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        @if (auth()->user()->hasRole('admin'))
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 xl:gap-x-8">
            @else
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        @endif

                <a href="/courses" class="group">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white xl:aspect-h-8 xl:aspect-w-7">
                        <img src="https://i.postimg.cc/Gh1RfMk7/dos.png" class="h-full w-full object-cover object-center group-hover:opacity-50">
                    </div>
                    <p class="mt-1 text-lg font-medium text-gray-900">Mis Cursos</p>
                </a>
                <a href="/marketplace" class="group">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white xl:aspect-h-8 xl:aspect-w-7">
                        <img src="https://i.postimg.cc/0QMvTFW3/tres.png" class="h-full w-full object-cover object-center group-hover:opacity-50">
                    </div>
                    <p class="mt-1 text-lg font-medium text-gray-900">Marketplace</p>
                </a>
                <a href="/billinginfo" class="group">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white xl:aspect-h-8 xl:aspect-w-7">
                        <img src="https://i.postimg.cc/RhwBFfzL/uno.png" class="h-full w-full object-cover object-center group-hover:opacity-50">
                    </div>
                    <p class="mt-1 text-lg font-medium text-gray-900">Información de Pago</p>
                </a>
                <a href="/profile" class="group">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white xl:aspect-h-8 xl:aspect-w-7">
                        <img src="https://i.postimg.cc/G2WRdK6p/cuatro.png" class="h-full w-full object-cover object-center group-hover:opacity-50">
                    </div>
                    <p class="mt-1 text-lg font-medium text-gray-900">Mi Perfil</p>
                </a>
                @can('admin')
                    <a href="/admin" class="group">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://i.postimg.cc/mkHb1Jmt/admin.png" class="h-full w-full object-cover object-center group-hover:opacity-50">
                        </div>
                        <p class="mt-1 text-lg font-medium text-gray-900">Acceso Admin</p>
                    </a>
                @endcan

            </div>
        </div>
    </div>
</x-app-layout>
