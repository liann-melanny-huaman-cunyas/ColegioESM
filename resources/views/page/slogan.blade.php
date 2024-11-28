<!-- Slogan -->
<div class="header flex items-center justify-center px-4 min-h-[300px] md:min-h-[400px] lg:min-h-[500px]">
    <div class="fade-in-slogan absolute flex flex-col w-full md:w-3/4 lg:w-1/2 px-4">
        <h1 class="mb-8 md:mb-12 lg:mb-56 font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl text-center text-white">
        </h1>
    </div>
</div>

<style>
    .header {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Asegúrate de que tienes un overlay oscuro para mejor legibilidad */
        background-color: rgba(0, 0, 0, 0.4); /* Overlay opcional para mejor contraste */
    }

    /* Animación fade-in */
    .fade-in-slogan {
        animation: fadeIn 2s ease-in;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Media queries adicionales si necesitas ajustes más específicos */
    @media (max-width: 640px) {
        .header {
            min-height: 250px;
        }
    }
</style>