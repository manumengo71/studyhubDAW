<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="StudyHub - Plataforma de cursos online. Compra, crea y realiza cursos de diferentes temáticas.">

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'StudyHub') }}</title>

    <!-- Fonts: Inter + Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Dropify (solo para formularios que lo necesitan) -->
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('scripts')

    @vite(['resources/js/alpine.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-surface-50 flex flex-col">

        {{-- Navigation --}}
        @section('navigation')
            @include('layouts.navigation')
        @show

        {{-- Page Content --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        @section('footer')
            <footer class="bg-surface-900 text-white mt-auto">
                <div class="max-w-7xl mx-auto px-6 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                        {{-- Brand --}}
                        <div class="md:col-span-2">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 mb-4">
                                <x-application-logo class="w-12 h-12 rounded-xl" />
                                <span class="text-xl font-display font-bold">StudyHub</span>
                            </a>
                            <p class="text-surface-400 text-sm leading-relaxed max-w-sm">
                                Tu plataforma de cursos online. Aprende, crea y comparte conocimiento sin límites.
                            </p>
                        </div>

                        {{-- Quick Links --}}
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wider text-surface-400 mb-4">Navegación</h4>
                            <ul class="space-y-3">
                                <li><a href="{{ route('dashboard') }}" class="text-surface-300 hover:text-white transition-colors text-sm">Dashboard</a></li>
                                <li><a href="{{ route('marketplace') }}" class="text-surface-300 hover:text-white transition-colors text-sm">Marketplace</a></li>
                                <li><a href="{{ route('mycourses') }}" class="text-surface-300 hover:text-white transition-colors text-sm">Mis cursos</a></li>
                                <li><a href="{{ route('billinginfo') }}" class="text-surface-300 hover:text-white transition-colors text-sm">Información de pago</a></li>
                            </ul>
                        </div>

                        {{-- Legal --}}
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wider text-surface-400 mb-4">Legal</h4>
                            <ul class="space-y-3">
                                <li><a href="{{ route('condiciones') }}" class="text-surface-300 hover:text-white transition-colors text-sm" target="_blank">Condiciones</a></li>
                                <li><a href="{{ route('privacidad') }}" class="text-surface-300 hover:text-white transition-colors text-sm" target="_blank">Política de privacidad</a></li>
                                <li><a href="{{ route('ayuda') }}" class="text-surface-300 hover:text-white transition-colors text-sm" target="_blank">Ayuda y asistencia</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="border-t border-surface-800 mt-10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                        <p class="text-surface-500 text-sm">© {{ date('Y') }} StudyHub-App. Todos los derechos reservados.</p>
                        <div class="flex items-center gap-4">
                            <a href="https://github.com/manumengo71/StudyHub-App" target="_blank" class="text-surface-500 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/in/manuelcandidomendozagonzalez" target="_blank" class="text-surface-500 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        @show
    </div>

    <!-- jQuery + Dropify (cargado al final para rendimiento) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('.dropify').length) {
                $('.dropify').dropify();
            }
        });
    </script>

    @stack('scripts-bottom')
</body>
</html>
