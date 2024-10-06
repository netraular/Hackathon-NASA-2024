@extends('layouts.app')

@section('subtitle', 'Welcome Page')

@section('content_body')

<!-- Background of the container -->
<div class="cosmic-background"
    style="min-height: 100vh; background-image: url('{{ asset('images/background_space.png') }}'); background-size: cover; background-position: center; color: white;">
    <!-- <div class="cosmic-backround"> -->
    <!-- Section for fading images at the top -->
    <div class="container-fluid"
        style="padding: 20px; text-align: center; position: relative; overflow: hidden; margin: 0;">
        <!-- No margins or paddings -->
        <div id="fade-images" class="d-flex justify-content-center"
            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0;">
            <img src="{{ asset('images/1.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
            <img src="{{ asset('images/2.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
            <img src="{{ asset('images/3.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
            <img src="{{ asset('images/4.png') }}" style="width: 100%; height: 100%; position: absolute; opacity: 0;">
        </div>
        <h4 class="text-center"
            style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 3em; position: relative; z-index: 1; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);">
            👓 Information and resources:
        </h4>

    </div>
    <!-- Separator -->
    <hr class="my-4" style="border-top: 2px solid #1b263b;">

    <!-- Content: Welcome -->
    <div class="container-fluid mt-5 pb-2 mb-0 text-center position-relative cosmic-container ">

        <!-- Tutorial and downloads -->
        <div class="row mb-5 justify-content-center">
            <div class="col-md-12">
                <div class="card h-100 rounded-3 bg-dark text-light border-0 cosmic-card"> <!-- Dark background -->
                    <div class="card-body cosmic-interactive-card"> <!-- Interactive card -->
                        <h3 class="card-title cosmic-text">Operation Tutorial</h3>
                        <p class="card-text cosmic-text">Learn how to navigate our website and make the most of its
                            features.</p>
                        <a href="#" class="btn btn-primary">View Tutorial</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-light">

        <!-- Project Features Section -->
        <div class="mb-5">
            <h2 class="mb-4 cosmic-text">Project Features 🌟</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/exploreV1">
                        <div class="feature-card">
                            <i class="fas fa-map-marked-alt fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Interactive Night Sky Map</h4>
                            <p class="cosmic-text">Explore the night sky of different exoplanets in our
                                database with an interactive map.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/exploreV2">
                        <div class="feature-card">
                            <i class="fas fa-drafting-compass fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Custom Constellation Creation</h4>
                            <p class="cosmic-text">Design your own constellations and personalize your
                                observation experience.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/">
                        <div class="feature-card">
                            <i class="fas fa-vote-yea fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Constellation Voting</h4>
                            <p class="cosmic-text">Participate and vote for your favorite constellations created by the
                                community.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="">
                        <div class="feature-card">
                            <i class="fas fa-download fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Download Data</h4>
                            <p class="cosmic-text">You can download the data of exoplanets and stars in
                                CSV format.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://nasa24.netshiba.com/stardata/uploadstars">
                        <div class="feature-card">
                            <i class="fas fa-upload fa-3x mb-3 feature-icon"></i>
                            <h4 class="cosmic-text">Data Upload</h4>
                            <p class="cosmic-text">Upload your own planet and star data to enrich
                                our database.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-light">

        <!-- Definitions Section -->
        <div class="mb-5">
            <h2 class="mb-4 cosmic-text">Definitions 🔭</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="https://es.wikipedia.org/wiki/Exoplaneta" target="_blank">
                        <div
                            class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card interactive-card">
                            <div class="card-body">
                                <h4 class="card-title cosmic-text">Exoplanet 🌍</h4>
                                <p class="card-text cosmic-text">An exoplanet is a planet that exists outside our solar
                                    system, orbiting a star other than the Sun. They vary in size, composition, and
                                    distance, from rocky ones like Earth to gas giants like Jupiter 🪐.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://es.wikipedia.org/wiki/Estrella" target="_blank">
                        <div
                            class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card interactive-card">
                            <div class="card-body">
                                <h4 class="card-title cosmic-text">Star 🌟</h4>
                                <p class="card-text cosmic-text">A star is a massive and luminous sphere of hot gas,
                                    primarily hydrogen and helium, held together by its own gravity. Nuclear fusion
                                    occurs
                                    in its core, releasing energy in the form of light and heat ☀️.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://es.wikipedia.org/wiki/Constelaci%C3%B3n" target="_blank">
                        <div
                            class="card h-100 shadow-sm rounded-3 bg-transparent text-light border-0 cosmic-card interactive-card">
                            <div class="card-body">
                                <h4 class="card-title cosmic-text">Constellation ⭐</h4>
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

        <!-- Bibliography Section -->
        <div class="bibliography-section">
            <h2 class="mb-4 cosmic-text">Bibliography 📚</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <a href="https://www.cosmos.esa.int/web/gaia" target="_blank">
                        <div class="feature-card bg-transparent text-light border border-white rounded-3">
                            <h4 class="cosmic-text">Gaia Mission</h4>
                            <p class="cosmic-text">Learn more about the Gaia mission to map the Milky Way.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="https://exoplanets.nasa.gov/what-is-an-exoplanet/overview/" target="_blank">
                        <div class="feature-card bg-transparent text-light border border-white rounded-3">
                            <h4 class="cosmic-text">NASA's Exoplanet Exploration</h4>
                            <p class="cosmic-text">Explore NASA's efforts in discovering and studying exoplanets.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Fade-in effect for images
        let images = $("#fade-images img");
        let currentIndex = 0;

        function fadeImages() {
            images.eq(currentIndex).css("opacity", 0).animate({ opacity: 1 }, 3000, function() {
                setTimeout(function() {
                    images.eq(currentIndex).animate({ opacity: 0 }, 3000, function() {
                        currentIndex = (currentIndex + 1) % images.length; // Move to next image
                        fadeImages(); // Recursive call for the next image
                    });
                }, 2000); // Delay before fading out
            });
        }

        fadeImages(); // Start the fading effect
    });
</script>
@endsection
