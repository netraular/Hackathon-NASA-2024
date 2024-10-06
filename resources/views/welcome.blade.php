@extends('layouts.app')

@section('subtitle', 'Welcome page')

@section('content_body')

<!-- Sección de fotos con fade en la parte superior con fondo negro espacial -->
<div class="container-fluid" style="background-color: #0d1b2a; padding: 20px; text-align: center;">
    <h4 class="text-white">✨ Examples of Skies Viewed from Planets:</h4>
    <div id="fade-images" style="position: relative; width: 80%; margin: 0 auto; height: 300px;">
        <img src="image1.jpg" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        <img src="image2.jpg" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        <img src="image3.jpg" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
    </div>
</div>

<!-- Separador -->
<hr class="my-4" style="border-top: 2px solid #1b263b;">

<!-- Contenido inferior: About a la izquierda y Votaciones a la derecha -->
<div class="container">
    <div class="row">
        <!-- Texto resaltado del proyecto a la izquierda -->
        <div class="col-md-6">
            <div class="card about-card" style="background-color: #1e3a5f; color: white; padding: 20px; border-radius: 8px; transition: transform 0.3s;">
                <h4 style="text-align: center; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 2em; color: #00d4ff; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">
                    🪅 About the Project:
                </h4>
                <p style="font-size: 1.1em;">
                    🌌 ExoSky! is a project that aims to show how the night sky would look from various exoplanets, 
                    using real astronomical data 🌌🔭 and transforming the coordinates of stars as seen from Earth. 
                    The goal is to inspire young minds and spark their interest in space exploration 🚀 through an 
                    interactive and educational visual experience. By offering accurate simulations, ExoSky will allow 
                    users to explore the universe from new perspectives 🌠, demonstrating how the sky changes depending 
                    on the observer's location, and conveying the excitement of scientific discovery. ✨
                </p>
            </div>
        </div>

        <!-- Sección de votación de constelaciones a la derecha -->
        <div class="col-md-6">
            <h4 style="color: #ff7e00; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 2em; text-align: center; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">🌠 Latest Constellations:</h4>
            <div class="row">
                @php
                    $constellations = [
                        ['name' => 'Traveling Star', 'user' => 'Galaxy01', 'image' => asset('storage/app/public/constellation1.PNG')],
                        ['name' => 'Night Hunter', 'user' => 'AstroHunter', 'image' => asset('storage/app/public/constellation2.png')],
                        ['name' => 'Mystical Nebula', 'user' => 'SpaceDreamer', 'image' => asset('storage/app/public/constellation3.png')],
                        ['name' => 'Wings of Pegasus', 'user' => 'CosmicFlyer', 'image' => asset('storage/app/public/constellation4.png')]
                    ];
                @endphp

                @foreach ($constellations as $index => $constellation)
                    <div class="col-6 mb-3">
                        <div class="card" style="background-color: #243b55; color: white; border: 1px solid #1b9aaa; padding: 10px; border-radius: 8px;">
                            <h5 style="font-family: 'Montserrat', sans-serif; font-weight: bold; text-align: center; color: #00d4ff;">
                                {{ $constellation['name'] }} - Created by: {{ $constellation['user'] }}
                            </h5>
                            <img src="{{ $constellation['image'] }}" alt="{{ $constellation['name'] }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; background-color: black;">
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
    </div>
</div>

@stop

@section('footer')
@stop

@push('css')
    <style>
        /* Efecto de fade para las imágenes */
        #fade-images img {
            animation: fadeEffect 9s infinite;
        }

        @keyframes fadeEffect {
            0% { opacity: 1; }
            33% { opacity: 0; }
            66% { opacity: 1; }
            100% { opacity: 0; }
        }

        /* Efecto hover sobre todo el recuadro de About */
        .about-card:hover {
            transform: scale(1.05);
        }

        /* Colores del espacio */
        body {
            background-color: #0d1b2a;
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
    </style>
@endpush

@push('js')
    <script>
        // Ejemplo de función para like y dislike
        function likeConstellation(id) {
            alert('You liked Constellation ' + id);
            // Aquí puedes añadir lógica para hacer la solicitud a tu servidor
        }

        function dislikeConstellation(id) {
            alert('You disliked Constellation ' + id);
            // Aquí puedes añadir lógica para hacer la solicitud a tu servidor
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

            // Hacer que cambien las imágenes cada 3 segundos
            setInterval(fadeImages, 3000);
        });
    </script>
@endpush

