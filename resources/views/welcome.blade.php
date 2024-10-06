@extends('layouts.app')

@section('subtitle', 'Welcome page')

@section('content_body')

<!-- Sección de fotos con fade en la parte superior con fondo negro espacial -->
<div class="container-fluid" style="background-color: #0d1b2a; padding: 20px; text-align: center; position: relative; overflow: hidden; margin: 0;"> <!-- Sin márgenes ni paddings -->
    <div id="fade-images" class="d-flex justify-content-center" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0;">
        <img src="{{ asset('images/1.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        <img src="{{ asset('images/2.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        <img src="{{ asset('images/3.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        <img src="{{ asset('images/4.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
    </div>
    <h4 class="text-center" style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 3em; position: relative; z-index: 1; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);">
        ✨ Stunning Views of Skies from Other Worlds:
    </h4>
</div>

<!-- Separador -->
<hr class="my-4" style="border-top: 2px solid #1b263b;">

<!-- Título ajustado para la vista del cielo -->
<h2 class="text-center" style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: normal; font-size: 3em;">
    🌌 A Breathtaking View of the Sky 🌌
</h2>

<!-- Contenido: Últimas constelaciones en horizontal -->
<div class="container-fluid" style="padding: 0; margin: 0 !important;"> <!-- Sin márgenes ni paddings -->
    <h4 style="color: #00d4ff; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 2.5em; text-align: center; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">🌠 Latest Constellations:</h4>
    <div class="row justify-content-center">
        @php
            $constellations = [
                ['name' => 'Traveling Star', 'user' => 'Galaxy01', 'image' => asset('images/constellation1.png')],
                ['name' => 'Night Hunter', 'user' => 'AstroHunter', 'image' => asset('images/constellation2.png')],
                ['name' => 'Mystical Nebula', 'user' => 'SpaceDreamer', 'image' => asset('images/constellation3.png')],
                ['name' => 'Wings of Pegasus', 'user' => 'CosmicFlyer', 'image' => asset('images/constellation4.png')]
            ];
        @endphp

        @foreach ($constellations as $index => $constellation)
            <div class="col-md-3">
                <div class="card" style="background-color: #243b55; color: white; border: 1px solid #1b9aaa; padding: 10px; border-radius: 8px;">
                    <h5 style="font-family: 'Poppins', sans-serif; font-weight: bold; text-align: center; color: #ff7e00;">
                        {{ $constellation['name'] }} - Created by: {{ $constellation['user'] }}
                    </h5>
                    <img src="{{ $constellation['image'] }}" alt="{{ $constellation['name'] }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;  background-color: black;">
                    <div class="vote-buttons" style="display: flex; justify-content: space-between; align-items: center;">
                        <button class="btn btn-success" onclick="likeConstellation({{ $index + 1 }})" style="font-size: 12px;">
                            👍 Like
                        </button>
                        <button class="btn btn-danger" onclick="dislikeConstellation({{ $index + 1 }})" style="font-size: 12px;">
                            👎 Dislike
                        </button>
                        <button class="btn btn-primary" onclick="viewConstellation({{ $index + 1 }})" style="font-size: 12px;">
                            🔭 View
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Texto dinámico y atractivo del proyecto debajo -->
<div class="container text-center mt-5" style="padding: 0;"> <!-- Sin paddings -->
    <h4 style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 2.5em; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">
        🪅 About the Project:
    </h4>
    <p class="dynamic-text pb-3" style="font-size: 1.5em; color: #e0e0e0; line-height: 1.6; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);">
        🌌 **ExoSky!** is a project that aims to show how the night sky would look from various exoplanets.<br>
        🔭 Using real astronomical data, we transform the coordinates of stars as seen from Earth.<br>
        🚀 Our goal is to inspire young minds and spark their interest in space exploration!<br>
        🌠 Explore the universe from new perspectives and feel the excitement of scientific discovery! ✨
    </p>
</div>

<!-- Footer dinámico con más separación -->
@stop

@section('footer')

<div style="text-align: center; margin: 0;"> <!-- Centrado y sin margen -->
    <h5 style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">🌌 Explore the Universe with Us!</h5>
    <p>🚀 Join our mission to inspire future astronomers and space explorers!</p>
</div>

@stop

@push('css')
<style>
    /* Efecto de fade para las imágenes */
    #fade-images img {
        animation: fadeEffect 12s infinite; /* Aumentar el tiempo para un efecto más suave */
    }

    @keyframes fadeEffect {
        0% { opacity: 1; }
        33% { opacity: 0; }
        66% { opacity: 1; }
        100% { opacity: 0; }
    }

    /* Colores del espacio */
    body {
        background-color: #0d1b2a;
        margin: 0; /* Eliminando margen predeterminado del body */
        padding: 0; /* Eliminando padding predeterminado del body */
    }

    .container-fluid {
        padding: 0; /* Sin padding en el contenedor */
        margin: 0; /* Sin margen en el contenedor */
    }

    .card {
        background-color: #1e3a5f;
    }

    .btn-outline-light {
        border-color: #1b9aaa;
        color: #1b9aaa;
    }

    .btn-outline-light:hover {
        background-color: #1b9aaa;
        color: white;
    }

    .dynamic-text {
        animation: fadeIn 3s forwards;
        margin:0px !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .content-wrapper {
        background-color: #121212; /* Color de fondo oscuro */
        color: #ffffff; /* Color de texto para que sea legible */
    }
    .main-footer {
        background-color: #343a40; /* Color de fondo oscuro */
        color: #ffffff; /* Color de texto para que sea legible */
    }
</style>
@endpush

@push('js')
<script>
    // Ejemplo de función para like y dislike
    function likeConstellation(id) {
        alert('You liked Constellation ' + id);
    }

    function dislikeConstellation(id) {
        alert('You disliked Constellation ' + id);
    }

    function viewConstellation(id) {
        alert('Viewing details of Constellation ' + id);
        // Aquí puedes redirigir o mostrar un modal con la constelación
    }

    $(document).ready(function() {
        let currentIndex = 0;
        const images = $('#fade-images img');
        const imageCount = images.length;

        // Función para hacer el fade entre imágenes
        function fadeImages() {
            images.eq(currentIndex).css('opacity', '0');
            currentIndex = (currentIndex + 1) % imageCount;
            images.eq(currentIndex).css('opacity', '1');
        }

        // Iniciar el efecto de fade
        fadeImages();
        setInterval(fadeImages, 3000); // Cambiar cada 3 segundos
    });
</script>
@endpush
