<!-- Navegación -->

<div class="h-12 flex items-center px-4 space-x-4 fixed-top !bg-customGold !text-white">
    <p class="font-bold">Centro Educativo en San Jeronimo de Tunan</p>
</div>

<nav class="fixed-nav bg-white shadow-md w-full">
    <div class="flex items-center justify-between px-4 py-2">
        <!-- Logo y título -->
        <div class="flex items-center">
            <a href="" class="p-2">
                <img class="h-12 md:h-16" src="{{ asset('img/logo.png') }}" alt="Logo" />
            </a>
            <div class="ml-2 mb-1">
                <h1 class="font-bold text-xl md:text-2xl text-black">ESTEBAN</h1>
                <h1 class="font-bold text-xl md:text-2xl text-black">SANABRIA MARAVI</h1>
            </div>
        </div>

        <!-- Botón hamburguesa para móvil -->
        <button id="menu-toggle" class="md:hidden flex items-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Menú de navegación para desktop -->
        <div class="hidden md:flex items-center">
            <a href="{{ url('/') }}" class="flex items-center px-5 text-black hover:text-customGold transition duration-500 ease select-none">
                <img src="{{ asset('icons/inicio.svg') }}" alt="Inicio" class="w-5">
                <p class="ml-2">Inicio</p>
            </a>
            <a href="{{ url('/elecciones') }}" class="flex items-center px-5 text-black hover:text-customGold transition duration-500 ease select-none">
                <img src="{{ asset('icons/nosotros.svg') }}" alt="Nosotros" class="w-5">
                <p class="ml-2">Elecciones</p>
            </a>
            <a href="{{ url('/admin') }}">
                <button class="bg-customGold text-white flex items-center px-4 py-2 ml-4 transition duration-500 ease select-none hover:bg-blue-950">
                    <img src="{{ asset('icons/intranet.svg') }}" alt="Intranet" class="w-5">
                    <span class="ml-2">Dashboard</span>
                </button>
            </a>
        </div>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="hidden md:hidden bg-white pb-4 px-4">
        <a href="#inicio" class="flex items-center py-3 text-black hover:text-customGold transition duration-500 ease select-none">
            <img src="{{ asset('icons/inicio.svg') }}" alt="Inicio" class="w-5">
            <p class="ml-2">Inicio</p>
        </a>
        <a href="{{ url('/elecciones') }}" class="flex items-center px-5 text-black hover:text-customGold transition duration-500 ease select-none">
                <img src="{{ asset('icons/nosotros.svg') }}" alt="Nosotros" class="w-5">
                <p class="ml-2">Elecciones</p>
            </a>
        <a href="{{ url('/admin') }}" class="flex items-center py-3">
            <button class="bg-customGold text-white flex items-center px-4 py-2 transition duration-500 ease select-none hover:bg-blue-950 w-full">
                <img src="{{ asset('icons/intranet.svg') }}" alt="Intranet" class="w-5">
                <span class="ml-2">Dashboard</span>
            </button>
        </a>
    </div>
</nav>

<!-- Script para el menú hamburguesa -->
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Cerrar el menú al hacer click en un enlace
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });

    // Cerrar el menú al hacer scroll
    window.addEventListener('scroll', () => {
        document.getElementById('mobile-menu').classList.add('hidden');
    });
</script>