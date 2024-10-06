@extends('layouts.app')

@section('subtitle', 'Welcome Page')

@section('content_body')
<div class="container-fluid my-5 text-center position-relative">
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
                <div class="feature-card">
                    <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                    <h4 class="cosmic-text">Mapa Interactivo del Cielo Nocturno</h4>
                    <p class="cosmic-text">Explora el cielo nocturno de los diferentes exoplanetas en nuestra base de datos con un mapa interactivo.</p>
                </div>
            </div>
            <!-- Feature 2: Creación de Constelaciones -->
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-drafting-compass fa-3x mb-3"></i>
                    <h4 class="cosmic-text">Creación de Constelaciones Personalizada</h4>
                    <p class="cosmic-text">Diseña tus propias constelaciones y personaliza tu experiencia de observación.</p>
                </div>
            </div>
            <!-- Feature 3: Votación de Constelaciones -->
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-vote-yea fa-3x mb-3"></i>
                    <h4 class="cosmic-text">Votación de Constelaciones</h4>
                    <p class="cosmic-text">Participa y vota por tus constelaciones favoritas creadas por la comunidad.</p>
                </div>
            </div>
            <!-- Feature 4: Descarga de Datos -->
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-download fa-3x mb-3"></i>
                    <h4 class="cosmic-text">Descarga de Datos</h4>
                    <p class="cosmic-text">Descarga información detallada de planetas y estrellas en formatos como CSV o ZIP.</p>
                </div>
            </div>
            <!-- Feature 5: Carga de Datos -->
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-upload fa-3x mb-3"></i>
                    <h4 class="cosmic-text">Carga de Datos</h4>
                    <p class="cosmic-text">Sube tus propios datos de planetas y estrellas para enriquecer nuestra base de datos.</p>
                </div>
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
    /* Custom styles for a cosmic appearance */
    body {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); /* Dark gradient background */
        color: #e0e0e0; /* Light grey text for better contrast */
        overflow-x: hidden; /* Prevent horizontal scroll */
        background-attachment: fixed; /* Keep background fixed */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Modern font */
    }

    /* Styles for the starry background */
    .stars {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('path_to_your_starry_background_image.jpg') center center / cover no-repeat; /* Replace with your starry background image */
        z-index: -1; /* Keep it behind content */
        opacity: 0.7; /* Slight transparency */
    }

    /* Styles for feature cards */
    .feature-card {
        background: rgba(25, 25, 112, 0.7); /* Midnight blue with transparency */
        padding: 20px;
        border-radius: 15px;
        transition: transform 0.3s ease, background 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        background: rgba(72, 61, 139, 0.8); /* Dark slate blue on hover */
    }

    .feature-card i {
        color: #00bfff; /* Deep sky blue for icons */
        transition: color 0.3s ease;
    }

    .feature-card:hover i {
        color: #1e90ff; /* Dodger blue on hover */
    }

    .feature-card h4 {
        margin-top: 15px;
        margin-bottom: 10px;
        color: #ffffff; /* White color for titles */
    }

    .feature-card p {
        color: #dcdcdc; /* Gainsboro for descriptions */
    }

    /* Cosmic Cards */
    .cosmic-card {
        backdrop-filter: blur(10px); /* Blur effect for cards */
        background-color: rgba(0, 0, 0, 0.5); /* Dark background with transparency */
        border-radius: 15px; /* Rounded corners */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effect */
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .cosmic-card:hover {
        transform: scale(1.05); /* Slightly enlarge on hover */
        box-shadow: 0 8px 60px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
    }

    /* Buttons */
    .btn-primary {
        background-color: #1e90ff; /* Dodger blue */
        border-color: #1e90ff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #63b3ed; /* Light sky blue on hover */
        border-color: #63b3ed;
    }

    .btn-success {
        background-color: #32cd32; /* Lime green */
        border-color: #32cd32;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #7cfc00; /* Lawn green on hover */
        border-color: #7cfc00;
    }

    /* Particles for moving stars */
    .particle-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        background: transparent;
        pointer-events: none; /* Allow interaction with elements behind */
    }

    /* Star animations */
    .particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: white;
        border-radius: 50%;
        opacity: 0.8;
        animation: twinkle 5s infinite;
    }

    @keyframes twinkle {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 0.2; }
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .cosmic-title {
            font-size: 2rem;
        }
        .feature-card h4 {
            font-size: 1.2rem;
        }
        .feature-card p {
            font-size: 0.9rem;
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

@push('scripts')
<script>
    // JavaScript to generate moving particles
    function createParticles() {
        const particleContainer = document.querySelector('.particle-background');
        for (let i = 0; i < 100; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDuration = `${Math.random() * 15 + 5}s`; // Random speed
            particle.style.opacity = `${Math.random()}`;
            particleContainer.appendChild(particle);
        }
    }

    // Call the function to create particles on page load
    document.addEventListener('DOMContentLoaded', createParticles);
</script>
@endpush
