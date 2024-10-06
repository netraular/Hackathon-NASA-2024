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
            <div class="card h-100 rounded-3 bg-transparent text-light border-0 animate-card cosmic-card">
                <div class="card-body">
                    <h3 class="card-title cosmic-text">Operation Tutorial</h3>
                    <p class="card-text cosmic-text">Learn how to navigate our website and make the most of its features.</p>
                    <a href="#" class="btn btn-primary">View Tutorial</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="card h-100 rounded-3 bg-transparent text-light border-0 animate-card cosmic-card">
                <div class="card-body">
                    <h3 class="card-title cosmic-text">Download Data</h3>
                    <p class="card-text cosmic-text">Get the generated data in your local formats, CSV or ZIP.</p>
                    <a href="#" class="btn btn-success">Download Now</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-light">

    <!-- Project Features with Accordion -->
    <div class="mb-5">
        <h2 class="mb-4 cosmic-text">Project Features 🌟</h2>
        <div class="accordion text-light" id="featuresAccordion">
            <div class="accordion-item bg-transparent border-light">
                <h2 class="accordion-header" id="headingConstellations">
                    <button class="accordion-button text-light cosmic-text" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConstellations" aria-expanded="true" aria-controls="collapseConstellations">
                        Creation of Custom Constellations ✨
                    </button>
                </h2>
                <div id="collapseConstellations" class="accordion-collapse collapse show" aria-labelledby="headingConstellations" data-bs-parent="#featuresAccordion">
                    <div class="accordion-body cosmic-text">
                        <ul>
                            <li>Interactive design of constellations.</li>
                            <li>Customization of the observation experience.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item bg-transparent border-light">
                <h2 class="accordion-header" id="headingObservation">
                    <button class="accordion-button collapsed text-light cosmic-text" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservation" aria-expanded="false" aria-controls="collapseObservation">
                        Sky Observation 🔭
                    </button>
                </h2>
                <div id="collapseObservation" class="accordion-collapse collapse" aria-labelledby="headingObservation" data-bs-parent="#featuresAccordion">
                    <div class="accordion-body cosmic-text">
                        <ul>
                            <li>Viewing from any corner of space.</li>
                            <li>Immersive experience of the night sky.</li>
                        </ul>
                    </div>
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
                <div class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 animate-card cosmic-card">
                    <div class="card-body">
                        <h4 class="card-title cosmic-text">Exoplanet 🌍</h4>
                        <p class="card-text cosmic-text">An exoplanet is a planet that exists outside our solar system, orbiting a star other than the Sun. They vary in size, composition, and distance, from rocky ones like Earth to gas giants like Jupiter 🪐.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 animate-card cosmic-card">
                    <div class="card-body">
                        <h4 class="card-title cosmic-text">Star 🌟</h4>
                        <p class="card-text cosmic-text">A star is a massive and luminous sphere of hot gas, primarily hydrogen and helium, held together by its own gravity. Nuclear fusion occurs in its core, releasing energy in the form of light and heat ☀️.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 animate-card cosmic-card">
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
@endsection

@section('footer')
<!-- You can add custom footer content if desired -->
@endsection

@push('css')
<style>
    /* Custom styles for a cosmic appearance */
    body {
        background-color: #000022; /* Dark blue background */
        color: #ffffff; /* White text color */
        overflow-x: hidden; /* Prevent horizontal scroll */
        background-attachment: fixed; /* Keep background fixed */
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
        animation: starAnimation 20s linear infinite;
    }

    @keyframes starAnimation {
        0% { background-position: 0 0; }
        100% { background-position: 1000px 1000px; }
    }

    .cosmic-title {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.8), 0 0 20px rgba(255, 255, 255, 0.6); /* Glow effect for title */
        animation: fadeIn 1.5s; /* Animation for title */
        margin-bottom: 50px; /* Space below title */
    }

    .cosmic-text {
        color: rgba(255, 255, 255, 0.9); /* Slightly transparent white text */
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.5); /* Shadow for better integration */
    }

    .cosmic-card {
        backdrop-filter: blur(10px); /* Blur effect for cards */
        background-color: rgba(0, 0, 0, 0.5); /* Dark background with transparency */
        border-radius: 15px; /* Rounded corners */
        transition: transform 0.3s ease; /* Smooth hover effect */
    }

    .cosmic-card:hover {
        transform: scale(1.05); /* Slightly enlarge on hover */
    }

    .accordion-button {
        font-size: 1.25rem;
    }
    
    .card-title {
        font-weight: bold;
    }

    .card-text {
        font-size: 1.1rem;
    }

    .animate-card {
        animation: fadeIn 1.5s; /* Animation for cards */
        opacity: 0; /* Start invisible */
        transform: translateY(20px); /* Slide up effect */
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

    .container-fluid {
        max-width: 1200px; /* Optional: Limit container width */
        margin: 0 auto; /* Center the container */
    }

    hr {
        border: 1px solid rgba(255, 255, 255, 0.3); /* Light colored horizontal rules */
    }
</style>
@endpush

@push('js')
<script>
    // Add dynamic scroll animations
    document.addEventListener('scroll', () => {
        const cards = document.querySelectorAll('.animate-card');
        const triggerBottom = window.innerHeight / 5 * 4;

        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            if (cardTop < triggerBottom) {
                card.style.opacity = 1; // Fade in
                card.style.transform = 'translateY(0)'; // Slide up
            } else {
                card.style.opacity = 0; // Fade out
                card.style.transform = 'translateY(20px)'; // Slide down
            }
        });
    });
</script>
@endpush
