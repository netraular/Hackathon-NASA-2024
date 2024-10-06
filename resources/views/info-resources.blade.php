@extends('layouts.app')

<!-- Incluye Particles.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<!-- Incluye Font Awesome CDN en la sección <head> de tu layout principal -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZkTyqL6W76f+2fJH+u5oJ+jB/ocEw7h4/YbQjCe1PPkRYbJ0vKlJmB8cF1kSga28iM6h5g1D59G+gKzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('subtitle', 'Welcome Page')

@section('content_body')
<!-- Contenedor de Particles.js -->
<div id="particles-js"></div>

<div class="container my-5 content-wrapper">
    <!-- Título Principal -->
    <div class="text-center mb-5 dynamic-title">
        <h1 class="display-1 fw-extrabold">Welcome to ChatGPT for Exoplanet Information 🌌</h1>
        <p class="lead">Explore the universe with us and discover fascinating data about exoplanets.</p>
    </div>

    <!-- Sección de Tutorial y Descargas -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card content-card shadow-lg h-100">
                <div class="card-body">
                    <h3 class="card-title">User Guide</h3>
                    <p class="card-text">Learn how to navigate our website and make the most of its features.</p>
                    <a href="#" class="btn btn-primary">View Guide</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="card content-card shadow-lg h-100">
                <div class="card-body">
                    <h3 class="card-title">Download Data</h3>
                    <p class="card-text">Obtain locally generated data in CSV or ZIP formats.</p>
                    <a href="#" class="btn btn-success">Download Now</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="space-divider">

    <!-- Sección de Características del Proyecto con Accordion Minimalista -->
    <div class="mb-5">
        <h2 class="mb-4 text-section">Project Features 🌟</h2>
        <div class="accordion space-accordion minimal-accordion" id="featuresAccordion">
            <div class="accordion-item space-accordion-item">
                <h2 class="accordion-header" id="headingConstellations">
                    <button class="accordion-button minimal-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConstellations" aria-expanded="true" aria-controls="collapseConstellations">
                        Custom Constellation Creation ✨
                    </button>
                </h2>
                <div id="collapseConstellations" class="accordion-collapse collapse show" aria-labelledby="headingConstellations" data-bs-parent="#featuresAccordion">
                    <div class="accordion-body">
                        <ul class="feature-list">
                            <li>Interactive constellation design.</li>
                            <li>Personalized observation experiences.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item space-accordion-item">
                <h2 class="accordion-header" id="headingObservation">
                    <button class="accordion-button collapsed minimal-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservation" aria-expanded="false" aria-controls="collapseObservation">
                        Sky Observation 🔭
                    </button>
                </h2>
                <div id="collapseObservation" class="accordion-collapse collapse" aria-labelledby="headingObservation" data-bs-parent="#featuresAccordion">
                    <div class="accordion-body">
                        <ul class="feature-list">
                            <li>Visualization from any location in space.</li>
                            <li>Immersive nocturnal sky experience.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Añade más elementos de accordion según sea necesario -->
        </div>
    </div>

    <hr class="space-divider">

    <!-- Sección de Definiciones con Tarjetas -->
    <div class="mb-5">
        <h2 class="mb-4 text-section">Definitions 🔭</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card content-card shadow-lg h-100">
                    <div class="card-body">
                        <h4 class="card-title">Exoplanet 🌍</h4>
                        <p class="card-text">An exoplanet is a planet that exists outside our solar system, orbiting a star other than the Sun. They vary in size, composition, and distance, ranging from rocky planets like Earth to gas giants like Jupiter 🪐.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card content-card shadow-lg h-100">
                    <div class="card-body">
                        <h4 class="card-title">Star 🌟</h4>
                        <p class="card-text">A star is a massive, luminous sphere of hot gas, primarily hydrogen and helium, held together by its own gravity. Nuclear fusion occurs in its core, releasing energy in the form of light and heat ☀️.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card content-card shadow-lg h-100">
                    <div class="card-body">
                        <h4 class="card-title">Reference System 📏</h4>
                        <p class="card-text">A reference system is a method of measuring and describing the position or movement of objects in space. It includes a set of points or axes that help understand the relationships between different elements 🌌.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- Puedes añadir contenido personalizado en el pie de página si lo deseas -->
@endsection

@push('css')
<style>
    /* Paleta de colores azul oscuro */
    :root {
        --space-bg: #0a1e3f; /* Azul muy oscuro para el fondo */
        --space-primary: #1c3d5a; /* Azul oscuro */
        --space-secondary: #2a6cb7; /* Azul medio */
        --space-accent: #ffffff; /* Blanco para el texto */
        --card-bg: rgba(255, 255, 255, 0.1); /* Fondo semi-transparente para las tarjetas */
        --text-dark-blue: #1c3d5a; /* Texto azul oscuro */
        --space-divider: #2a6cb7; /* Azul medio para divisores */
    }

    /* Reiniciar márgenes y paddings */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Fondo de Particles.js */
    #particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: var(--space-bg);
        background-size: cover;
        background-position: 50% 50%;
        z-index: -1;
        top: 0;
        left: 0;
    }

    body {
        background-color: var(--space-bg);
        color: var(--space-accent);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
    }

    /* Contenedor de contenido */
    .content-wrapper {
        position: relative;
        z-index: 1;
    }

    /* Títulos Dinámicos */
    .dynamic-title h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--space-accent);
        text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.7);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .dynamic-title p {
        font-size: 1.5rem;
        color: var(--space-accent);
    }

    .text-section {
        color: var(--space-secondary);
    }

    /* Divisores */
    .space-divider {
        border-top: 2px solid var(--space-divider);
        margin: 2rem 0;
    }

    /* Tarjetas */
    .content-card {
        background-color: var(--card-bg);
        border: none;
        border-radius: 15px;
        backdrop-filter: blur(10px); /* Efecto de desenfoque para las tarjetas */
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .content-card .card-body {
        color: var(--space-accent);
    }

    .content-card .card-title {
        color: var(--space-accent);
        font-weight: 700;
    }

    .content-card .card-text {
        color: var(--space-accent);
    }

    .content-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    /* Botones */
    .btn-primary {
        background-color: var(--space-secondary);
        border: none;
        color: #ffffff;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #1a5276;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        color: #ffffff;
        transition: background-color 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Accordion */
    .space-accordion .accordion-item {
        background-color: transparent;
        border: none;
    }

    .space-accordion .accordion-button {
        background-color: var(--card-bg);
        color: var(--space-accent);
        font-weight: 600;
        border-radius: 10px;
        padding: 1rem;
        transition: background-color 0.3s, color 0.3s;
    }

    .space-accordion .accordion-button:not(.collapsed) {
        background-color: var(--space-secondary);
        color: #ffffff;
    }

    .space-accordion .accordion-body {
        background-color: var(--card-bg);
        color: var(--space-accent);
        border-radius: 0 0 10px 10px;
        padding: 1rem;
    }

    /* Accordion Minimalista */
    .minimal-accordion .accordion-button {
        padding: 1rem;
        font-size: 1rem;
        border-radius: 10px;
    }

    .minimal-accordion .accordion-button:focus {
        box-shadow: none;
    }

    .minimal-accordion .accordion-body {
        padding: 1rem;
    }

    .feature-list {
        list-style-type: disc;
        padding-left: 1.5rem;
    }

    /* Animaciones */
    .dynamic-title.hidden {
        opacity: 0;
        transform: translateY(-50px);
    }

    .content-card.hidden {
        opacity: 0;
        transform: translateY(50px);
    }

    /* Ajustes Responsivos */
    @media (max-width: 768px) {
        .dynamic-title h1 {
            font-size: 2.5rem;
        }

        .dynamic-title p {
            font-size: 1.2rem;
        }

        .minimal-accordion .accordion-button {
            font-size: 0.95rem;
            padding: 0.75rem;
        }
    }
</style>
@endpush

@push('js')
<!-- Inicializar Particles.js -->
<script>
    /* Configuración de Particles.js */
    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 150,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                }
            },
            "opacity": {
                "value": 0.5,
                "random": true,
                "anim": {
                    "enable": false
                }
            },
            "size": {
                "value": 1.5,
                "random": true,
                "anim": {
                    "enable": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 0.5,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "grab"
                },
                "onclick": {
                    "enable": false
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 150,
                    "line_linked": {
                        "opacity": 0.5
                    }
                }
            }
        },
        "retina_detect": true
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Animación del Título Dinámico
        const title = document.querySelector('.dynamic-title');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                title.classList.add('hidden');
            } else {
                title.classList.remove('hidden');
            }
        });

        // Observador de Intersección para Tarjetas y Accordion
        const elements = document.querySelectorAll('.content-card, .accordion-item');
        const options = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('hidden');
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        elements.forEach(el => {
            el.classList.add('hidden');
            observer.observe(el);
        });
    });
</script>
@endpush