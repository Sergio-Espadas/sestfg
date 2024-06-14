<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Signika+Negative:wght@300..700&display=swap"
        rel="stylesheet">

    <!-- Encabezado y enlaces CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/formValidation.css') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <!-- Barra de navegación -->
        <!-- Tu barra de navegación aquí -->
    </header>

    <main>
        <!-- Contenido principal -->
        @yield('content')
    </main>

    <footer>
        <!-- Pie de página -->
        <!-- Tu pie de página aquí -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/formValidation.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    @if(session('success') && session('claseReservada'))
    document.addEventListener('DOMContentLoaded', function() {
        var reservaModal = new bootstrap.Modal(document.getElementById('reservaModal'));
        reservaModal.show();
    });
    @endif
    </script>
    <script>
    $(document).ready(function() {
        $('#btnClasesDisponibles').click(function() {
            $('#clasesDisponibles').show();
            $('#misClases').hide();
            $('#btnClasesDisponibles').addClass('active');
            $('#btnMisClases').removeClass('active');
        });

        $('#btnMisClases').click(function() {
            $('#misClases').show();
            $('#clasesDisponibles').hide();
            $('#btnMisClases').addClass('active');
            $('#btnClasesDisponibles').removeClass('active');
        });
    });
    </script>

    <script>
    // Activa el carrusel automático
    $(document).ready(function() {
        $('#carouselExample').carousel({
            interval: 5000 // Cambia el intervalo en milisegundos (5 segundos en este caso)
        });
    });
    </script>

    <!-- Script para convertir en carrusel en pantallas pequeñas -->
    <script>
    $(document).ready(function() {
        // Verifica el tamaño de la pantalla y convierte en carrusel si es necesario
        function checkCarousel() {
            if ($(window).width() < 576) {
                $('.row-cols-md-3').addClass('carousel slide');
                $('.row-cols-md-3').attr('data-bs-ride', 'carousel');
                $('.row-cols-md-3').children('.col').addClass('carousel-item');
                $('.row-cols-md-3').children('.col').removeClass('col');
                $('.row-cols-md-3 .carousel-item:first-of-type').addClass('active');
            } else {
                $('.row-cols-md-3').removeClass('carousel slide');
                $('.row-cols-md-3').removeAttr('data-bs-ride');
                $('.row-cols-md-3 .carousel-item').addClass('col');
                $('.row-cols-md-3 .carousel-item').removeClass('carousel-item');
                $('.row-cols-md-3 .active').removeClass('active');
            }
        }

        // Ejecuta la verificación al cargar y redimensionar la ventana
        checkCarousel();
        $(window).resize(checkCarousel);
    });
    </script>

</body>

</html>