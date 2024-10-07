@extends('layouts.app')

@section('subtitle', 'Welcome Page')

@section('content_body')

<!-- Fondo del contenedor -->
<div class="cosmic-background"
    style="min-height: 100vh; background-image: url('{{ asset('images/background_space.png') }}'); background-size: cover; background-position: center; color: white;">
    <!-- <div class="cosmic-backround"> -->
    <!-- Sección de fotos con fade en la parte superior -->
    <div class="container-fluid"
        style="padding: 20px; text-align: center; position: relative; overflow: hidden; margin: 0;">
        <!-- Sin márgenes ni paddings -->
        <div id="fade-images" class="d-flex justify-content-center"
            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0;">
            <img src="{{ asset('images/1.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
            <img src="{{ asset('images/2.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
            <img src="{{ asset('images/3.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
            <img src="{{ asset('images/4.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        </div>
        <h4 class="text-center"
            style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 3em; position: relative; z-index: 1; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);">
            👓 Informations and resources:
        </h4>

    </div>
    
    <!-- Separador -->
    <hr class="my-4" style="border-top: 2px solid #1b263b;">

    <!-- Contenido: Bienvenida -->
    <div class="container-fluid mt-5 pb-2 mb-0 text-center position-relative cosmic-container ">

    <!-- Tutorial y descargas -->
    <div class="row mb-5 justify-content-center">
        <div class="col-md-12">
            <div class="card h-100 rounded-3 text-light border border-white cosmic-card interactive-card"> <!-- Recuadro con bordes blancos y fondo gris oscuro -->
                <h3 class="card-title cosmic-text display-4" style="font-size: 2.5rem; margin-top: 20px;">Operation Tutorial 📖</h3> <!-- Título más grande con más margen superior -->
                <div class="card-body cosmic-interactive-card"> <!-- Tarjeta interactiva -->
                    <p class="card-text cosmic-text" style="font-size: 1.5rem;">Learn how to navigate our website and make the most of its features.</p>
                    <a href="https://youtu.be/vZP7UXet8Ko" class="btn btn-primary btn-lg" style="padding: 12px 24px; font-size: 1.2rem;">View Tutorial</a> <!-- Botón más grande y relleno en azul -->
                </div>
            </div>
        </div>
    </div>




        <hr class="border-light">

        <!-- Sección de características del proyecto -->
        <div class="mb-5">
            <h2 class="mb-4 cosmic-text">Project Features 🌟</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/skyview/exoplanet/1">
                        <div class="feature-card">
                            <i class="fas fa-map-marked-alt fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Interactive Night Sky Map</h4>
                            <p class="cosmic-text">Explore the night sky of different exoplanets in our database with an interactive map.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/exploreV2">
                        <div class="feature-card">
                            <i class="fas fa-drafting-compass fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Custom Constellation Creation</h4>
                            <p class="cosmic-text">Design your own constellations and customize your stargazing experience.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/">
                        <div class="feature-card">
                            <i class="fas fa-vote-yea fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Constellation Voting System</h4>
                            <p class="cosmic-text">Participate and vote for your favorite constellations created by the community.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/skyview/exoplanets">
                        <div class="feature-card">
                            <i class="fas fa-download fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Download Data</h4>
                            <p class="cosmic-text">You can download the data of exoplanets and stars in CSV format.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/stardata/uploadstars">
                        <div class="feature-card">
                            <i class="fas fa-upload fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Upliad new data</h4>
                            <p class="cosmic-text">Upload your own data of planets and stars to enrich our database.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-light">

        <!-- Sección de definiciones -->
        <div class="mb-5">
            <h2 class="mb-4 cosmic-text">Definitions 🔭</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="https://en.wikipedia.org/wiki/Exoplanet" target="_blank" >
                        <div
                            class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card interactive-card">
                            <h2 class="card-title cosmic-text" style="font-size: 1.5rem">Exoplanet 🌍</h2>
                            <div class="card-body" style="text-align: justify;">
                                <p class="card-text cosmic-text">An exoplanet is a planet that exists outside our solar
                                    system, orbiting a star other than the Sun. They vary in size, composition, and
                                    distance, from rocky ones like Earth to gas giants like Jupiter 🪐.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://en.wikipedia.org/wiki/Star" target="_blank">
                        <div
                            class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card interactive-card">
                            <h4 class="card-title cosmic-text" style="font-size: 1.5rem">Star 🌟</h4>
                            <div class="card-body" style="text-align: justify;">
                                <p class="card-text cosmic-text">A star is a massive and luminous sphere of hot gas,
                                    primarily hydrogen and helium, held together by its own gravity. Nuclear fusion
                                    occurs
                                    in its core, releasing energy in the form of light and heat ☀️.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://en.wikipedia.org/wiki/Constellation" target="_blank">
                        <div
                            class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card interactive-card">
                            <h4 class="card-title cosmic-text" style="font-size: 1.5rem">Constellation ⭐</h4>
                            <div class="card-body" style="text-align: justify;">
                                <p class="card-text cosmic-text">A constellation is a group of stars that form a
                                    recognizable pattern in the night sky. Historically, constellations have been used
                                    for
                                    navigation and storytelling 🌌.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-light">

        <!-- Sección de bibliografía -->
        <div class="bibliography-section">
    <h2 class="mb-4 cosmic-text">Bibliography 📚</h2>
    <p class="mb-4 cosmic-text">We have obtained the real data to create the 3D representation from the following resources:</p>
    <div class="row g-4 justify-content-center">
        <div class="col-md-6">
            <a href="https://gea.esac.esa.int/archive/" target="_blank">
                <div class="feature-card bg-transparent text-light border border-white rounded-3">
                    <h4 class="cosmic-text">Gaia Archive</h4>
                    <p class="cosmic-text">Learn more about the Gaia mission to map the Milky Way.</p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="https://exoplanetarchive.ipac.caltech.edu/docs/counts_detail.html" target="_blank">
                <div class="feature-card bg-transparent text-light border border-white rounded-3">
                    <h4 class="cosmic-text">NASA's Exoplanet Exploration</h4>
                    <p class="cosmic-text">Explore NASA's archive for all the information about the exoplanets discovered.
                    </p>
                </div>
            </a>
        </div>
    </div>
</div>

    </div>
</div>
<!-- Footer dinámico con más separación -->
@stop



@section('footer')
<div style="text-align: center; margin: 0;"> <!-- Centrado y sin margen -->
    <h5
        style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">
        🌌 Explore the Universe with Us!</h5>
    <p style="text-align: center;"> <!-- Centrando el texto del párrafo -->
        🚀 Join our mission to inspire future astronomers and space explorers!
    </p>
</div>


@stop

@push('css')
    <style>
        /* Efecto de fade para las imágenes */
        #fade-images img {
            animation: fadeEffect 12s infinite;
            /* Aumentar el tiempo para un efecto más suave */
        }

        @keyframes fadeEffect {
            0% {
                opacity: 1;
            }

            33% {
                opacity: 0;
            }

            66% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        /* Colores del espacio */
        body {
            background: linear-gradient(to bottom, #000000, #3f0051) !important;
            /* Degradado de negro a lila oscuro */
            margin: 0;
            /* Eliminando margen predeterminado del body */
            padding: 0;
            /* Eliminando padding predeterminado del body */
        }

        .container-fluid {
            padding: 0;
            /* Sin padding en el contenedor */
            margin: 0;
            /* Sin margen en el contenedor */
        }

        .bibliography-section {
            margin-bottom: 0 !important;
            /* Force the margin-bottom to be zero */
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
            margin: 0px !important;
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
            background: linear-gradient(to bottom, #000000, #3f0051) !important;
            /* Color de fondo oscuro */
            color: #ffffff;
            /* Color de texto para que sea legible */
        }

        .main-footer {
            background-color: #343a40;
            
            /* Color de fondo oscuro */
            color: #ffffff;
            /* Color de texto para que sea legible */
        }
    </style>
@endpush

@push('js')
    <script>
        // Lógica de imágenes con fade
        let currentImage = 0;
        const images = document.querySelectorAll('#fade-images img');

        function changeImage() {
            images[currentImage].style.opacity = 0; // Desvanecer la imagen actual
            currentImage = (currentImage + 1) % images.length; // Pasar a la siguiente imagen
            images[currentImage].style.opacity = 1; // Mostrar la siguiente imagen
        }

        // Iniciar el cambio de imagen cada 6 segundos
        setInterval(changeImage, 6000);
    </script>
@endpush