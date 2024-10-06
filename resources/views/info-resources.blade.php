@extends('layouts.app')

@section('subtitle', 'Welcome Page')

@section('content_body')
<div class="container-fluid my-5 text-center position-relative cosmic-container">
    <!-- Main Title -->
    <div class="mb-5">
        <h1 class="display-4 fw-bold cosmic-title">Welcome to ChatGPT for Exoplanet Information 🌌</h1>
        <p class="lead cosmic-text">Explore the universe with us and discover fascinating facts about exoplanets.</p>
    </div>

    <!-- Tutorial and Downloads Section -->
    <div class="row mb-5 justify-content-center">
        <div class="col-md-6">
            <div class="card h-100 rounded-3 bg-transparent text-light border-0 cosmic-card">
                <div class="card-body">
                    <h3 class="card-title cosmic-text">Operation Tutorial</h3>
                    <p class="card-text cosmic-text">Learn how to navigate our website and make the most of its features.</p>
                    <a href="#" class="btn btn-primary">View Tutorial</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="card h-100 rounded-3 bg-transparent text-light border-0 cosmic-card">
                <div class="card-body">
                    <h3 class="card-title cosmic-text">Download Data</h3>
                    <p class="card-text cosmic-text">Get the generated data in your local formats, CSV or ZIP.</p>
                    <a href="#" class="btn btn-success">Download Now</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-light">

    <!-- Project Features with Cards -->
    <div class="mb-5">
        <h2 class="mb-4 cosmic-text">Project Features 🌟</h2>
        <div class="row g-4 justify-content-center">
            <!-- Feature 1: Mapa Interactivo -->
            <div class="col-md-4">
                <a href="https://nasa24.netshiba.com/exploreV1">
                    <div class="feature-card">
                        <i class="fas fa-map-marked-alt fa-3x mb-3 feature-icon"></i>
                        <h4 class="cosmic-text">Mapa Interactivo del Cielo Nocturno</h4>
                        <p class="cosmic-text">Explora el cielo nocturno de los diferentes exoplanetas en nuestra base de datos con un mapa interactivo.</p>
                    </div>
                </a>
            </div>
            <!-- Feature 2: Creación de Constelaciones -->
            <div class="col-md-4">
                <a href="https://nasa24.netshiba.com/exploreV2">
                    <div class="feature-card">
                        <i class="fas fa-drafting-compass fa-3x mb-3 feature-icon"></i>
                        <h4 class="cosmic-text">Creación de Constelaciones Personalizada</h4>
                        <p class="cosmic-text">Diseña tus propias constelaciones y personaliza tu experiencia de observación.</p>
                    </div>
                </a>
            </div>
            <!-- Feature 3: Votación de Constelaciones -->
            <div class="col-md-4">
                <a href="https://nasa24.netshiba.com/">
                    <div class="feature-card">
                        <i class="fas fa-vote-yea fa-3x mb-3 feature-icon"></i>
                        <h4 class="cosmic-text">Votación de Constelaciones</h4>
                        <p class="cosmic-text">Participa y vota por tus constelaciones favoritas creadas por la comunidad.</p>
                    </div>
                </a>
            </div>
            <!-- Feature 4: Carga de Datos -->
            <div class="col-md-4">
                <a href="https://nasa24.netshiba.com/stardata/uploadstars">
                    <div class="feature-card">
                        <i class="fas fa-upload fa-3x mb-3 feature-icon"></i>
                        <h4 class="cosmic-text">Carga de Datos</h4>
                        <p class="cosmic-text">Sube tus propios datos de planetas y estrellas para enriquecer nuestra base de datos.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <hr class="border-light">

    <!-- Definitions with Cards -->
    <div class="mb-5">
        <h2 class="mb-4 cosmic-text">Definitions 🔭</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card">
                    <div class="card-body">
                        <h4 class="card-title cosmic-text">Exoplanet 🌍</h4>
                        <p class="card-text cosmic-text">An exoplanet is a planet that exists outside our solar system, orbiting a star other than the Sun. They vary in size, composition, and distance, from rocky ones like Earth to gas giants like Jupiter 🪐.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card">
                    <div class="card-body">
                        <h4 class="card-title cosmic-text">Star 🌟</h4>
                        <p class="card-text cosmic-text">A star is a massive and luminous sphere of hot gas, primarily hydrogen and helium, held together by its own gravity. Nuclear fusion occurs in its core, releasing energy in the form of light and heat ☀️.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card">
                    <div class="card-body">
                        <h4 class="card-title cosmic-text">Reference Frame 📏</h4>
                        <p class="card-text cosmic-text">A reference frame is a way to measure and describe the position or movement of objects in space. It includes a set of points or axes that help understand the relationships between different elements 🌌.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="stars"></div> <!-- Div for animated stars -->
<div class="particle-background"></div> <!-- Div for particle stars -->
@endsection

@section('footer')
<!-- Puedes agregar contenido personalizado al pie de página si lo deseas -->
@endsection

@push('css')
<style>
    /* Estilos personalizados */
    .cosmic-container {
        background: transparent; /* Fondo transparente para el contenedor principal */
    }

    /* Estilos del fondo */
    .stars {
        background: black url('/path/to/stars-image.png') repeat; /* Fondo negro con puntos blancos que simulan estrellas */
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        opacity: 0.9;
    }

    /* Estilos para las tarjetas */
    .feature-card {
        width: 300px;
        height: 250px;
        background: rgba(25, 25, 112, 0.7); /* Midnight blue */
        padding: 20px;
        border-radius: 15px;
        transition: transform 0.3s ease, background 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        margin: 0 auto;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        background: rgba(72, 61, 139, 0.8); /* Cambia de color al hacer hover */
    }

    .feature-icon, .cosmic-text {
        color: white;
    }

    .cosmic-title {
        color: white;
        text-shadow: 0 0 10px #fff;
    }

    /* Añadir margen entre los recuadros */
    .row.g-4 > .col-md-4 {
        margin-bottom: 20px;
    }

    /* Efecto de estrellas en el fondo */
    .particle-background {
        background-image: url('/path/to/particles-background.png');
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -2;
        opacity: 0.7;
    }
</style>
@endpush
