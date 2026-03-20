<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- Styles --}}
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    <link rel="stylesheet" href="{{ asset('css/credit-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my-courses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/course-detail.css') }}">

    {{-- DROPIFY --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack("scripts")

    @vite(['resources/js/alpine.js'])

</head>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        @include('layouts.navigation')

        {{-- <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>


<footer class="font-sans bg-indigo-500">
    <div class="container px-6 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">
            <div class="sm:col-span-2">
                <h1 class="max-w-lg text-xl font-semibold tracking-tight text-gray-800 xl:text-2xl dark:text-white">
                    Suscríbete a nuestro newsletter.</h1>

                <div class="flex flex-col mx-auto mt-6 space-y-3 md:space-y-0 md:flex-row">
                    <input id="email" type="text"
                        class="px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300"
                        placeholder="Dirección de email" />

                    <button
                        class="w-full px-6 py-2.5 text-sm font-medium tracking-wider text-white transition-colors duration-300 transform md:w-auto md:mx-4 focus:outline-none bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                        Subscribirme
                    </button>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Links rápidos</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="{{ route('dashboard') }}">
                        <p
                            class="text-gray-300 transition-colors duration-300 hover:text-white hover:underline hover:cursor-pointer">
                            Dashboard</p>
                    </a>

                    <a href="{{ route('marketplace') }}">
                        <p
                            class="text-gray-300 transition-colors duration-300 hover:text-white hover:underline hover:cursor-pointer">
                            Marketplace</p>
                    </a>

                    <a href="{{ route('mycourses') }}">
                        <p
                            class="text-gray-300 transition-colors duration-300 hover:text-white hover:underline hover:cursor-pointer">
                            Mis cursos</p>
                    </a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-white">Legal</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="{{ route('condiciones') }}" class="text-gray-300 transition-colors duration-300 hover:text-white hover:underline hover:cursor-pointer" target="_blank" rel="noopener noreferrer">
                        Condiciones
                    </a>
                    <a href="{{ route('privacidad') }}" class="text-gray-300 transition-colors duration-300 hover:text-white hover:underline hover:cursor-pointer" target="_blank" rel="noopener noreferrer">
                        Política de privacidad
                    </a>
                    <a href="{{ route('ayuda') }}" class="text-gray-300 transition-colors duration-300 hover:text-white hover:underline hover:cursor-pointer" target="_blank" rel="noopener noreferrer">
                        Ayuda y sistencia
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-200 md:my-8 h-2" />

        <div class="sm:flex sm:items-center sm:justify-between">

            <div class="flex gap-4 hover:cursor-pointer">
                <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30"
                    alt="fb" />
                <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30"
                    alt="tw" />
                <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30"
                    alt="inst" />
                <img src="https://www.svgrepo.com/show/94698/github.svg" class="" width="30" height="30"
                    alt="gt" />
                <img src="https://www.svgrepo.com/show/22037/path.svg" width="30" height="30" alt="pn" />
                <img src="https://www.svgrepo.com/show/28145/linkedin.svg" width="30" height="30"
                    alt="in" />
                <img src="https://www.svgrepo.com/show/22048/dribbble.svg" class="" width="30" height="30"
                    alt="db" />
            </div>
        </div>
        <p class="font-sans p-8 text-start md:text-center md:text-lg md:p-4 text-white">© 2024 StudyHub-App. Todos los derechos
            reservados.</p>
    </div>
</footer>

</body>
</html>
