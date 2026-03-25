<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="StudyHub - Tu plataforma de cursos online 100% gratuita. Compra, crea y realiza cursos de diferentes temáticas.">

    <title>StudyHub — Tu plataforma de cursos online</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 25%, #4338ca 50%, #6366f1 75%, #818cf8 100%);
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.3;
            animation: blob-move 8s ease-in-out infinite;
        }
        @keyframes blob-move {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-surface-950 text-white overflow-x-hidden">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-surface-950/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <x-application-logo class="w-10 h-10 rounded-xl" />
                <span class="text-xl font-display font-bold text-white">StudyHub</span>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-5 py-2.5 text-sm font-medium text-white/80 hover:text-white transition-colors">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-500 rounded-xl transition-all shadow-lg shadow-primary-600/25 hover:shadow-primary-500/40">
                    Registrarse gratis
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center hero-gradient overflow-hidden">
        {{-- Decorative Blobs --}}
        <div class="blob w-96 h-96 bg-primary-400 top-20 -left-20"></div>
        <div class="blob w-80 h-80 bg-accent-400 bottom-20 right-10" style="animation-delay: 2s;"></div>
        <div class="blob w-64 h-64 bg-primary-300 top-1/2 left-1/2" style="animation-delay: 4s;"></div>

        {{-- Grid Pattern --}}
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.03%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E')] opacity-50"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/10 mb-8 animate-fade-in">
                <span class="w-2 h-2 bg-accent-400 rounded-full animate-pulse"></span>
                <span class="text-sm font-medium text-white/80">100% Gratuito — Open Source</span>
            </div>

            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-display font-extrabold leading-tight mb-6 animate-slide-up">
                Aprende sin límites con
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-300 via-accent-300 to-primary-400">
                    StudyHub
                </span>
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg md:text-xl text-white/60 max-w-2xl mx-auto mb-10 animate-slide-up" style="animation-delay: 0.1s">
                Tu plataforma de cursos online donde puedes comprar, crear y gestionar cursos de cualquier temática. 
                Empieza hoy y lleva tu aprendizaje al siguiente nivel.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-slide-up" style="animation-delay: 0.2s">
                <a href="{{ route('register') }}"
                   class="w-full sm:w-auto px-8 py-4 text-base font-bold text-primary-900 bg-white hover:bg-primary-50 rounded-2xl transition-all shadow-xl shadow-white/10 hover:shadow-white/20 hover:-translate-y-0.5 text-center">
                    Comenzar gratis →
                </a>
                <a href="{{ route('login') }}"
                   class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-white/90 bg-white/10 hover:bg-white/15 border border-white/15 rounded-2xl transition-all backdrop-blur-sm text-center">
                    Ya tengo cuenta
                </a>
            </div>

            {{-- Stats --}}
            <div class="mt-16 grid grid-cols-3 gap-8 max-w-md mx-auto animate-slide-up" style="animation-delay: 0.3s">
                <div>
                    <div class="text-2xl md:text-3xl font-bold text-white">100%</div>
                    <div class="text-xs text-white/50 mt-1">Gratuito</div>
                </div>
                <div>
                    <div class="text-2xl md:text-3xl font-bold text-white">∞</div>
                    <div class="text-xs text-white/50 mt-1">Cursos</div>
                </div>
                <div>
                    <div class="text-2xl md:text-3xl font-bold text-white">24/7</div>
                    <div class="text-xs text-white/50 mt-1">Acceso</div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-24 bg-surface-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">Todo lo que necesitas</h2>
                <p class="text-white/50 max-w-xl mx-auto">Una plataforma completa para aprender y enseñar.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/8 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-primary-500/20 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Explora el Marketplace</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Descubre cursos de todas las temáticas, filtrados por idioma, categoría y precio.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/8 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-accent-500/20 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Crea tus propios cursos</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Comparte tus conocimientos creando lecciones con texto, vídeo e imágenes.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/8 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-warning-500/20 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Sigue tu progreso</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Continúa donde lo dejaste, con un dashboard que muestra tu avance en cada curso.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-br from-primary-900 to-surface-950 border-t border-white/5">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">¿Listo para empezar?</h2>
            <p class="text-white/50 mb-8">Crea tu cuenta gratuita y comienza a aprender hoy mismo.</p>
            <a href="{{ route('register') }}"
               class="inline-flex items-center gap-2 px-8 py-4 text-base font-bold text-primary-900 bg-white hover:bg-primary-50 rounded-2xl transition-all shadow-xl shadow-white/10 hover:shadow-white/20 hover:-translate-y-0.5">
                Crear cuenta gratuita
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-surface-950 py-8 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-surface-500 text-sm">© {{ date('Y') }} StudyHub-App. Todos los derechos reservados.</p>
            <div class="flex items-center gap-6">
                <a href="{{ route('ayuda') }}" class="text-surface-500 hover:text-white transition-colors text-sm" target="_blank">Ayuda</a>
                <a href="{{ route('condiciones') }}" class="text-surface-500 hover:text-white transition-colors text-sm" target="_blank">Condiciones</a>
                <a href="{{ route('privacidad') }}" class="text-surface-500 hover:text-white transition-colors text-sm" target="_blank">Privacidad</a>
                <a href="https://github.com/manumengo71/StudyHub-App" target="_blank" class="text-surface-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
