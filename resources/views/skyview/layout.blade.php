@extends('layouts.app')

@section('subtitle', 'Star Field')

@section('content_body')
<div id="threejs-container">
    <div id="info">
        <div id="text_tutorial">
            <p> Press space bar to pause or continue the rotation of the stars.</p>
            <b> Exoplanet data:</b><br>
            <b>Planet ID: {{ $data['id'] }}</b><br>
            <b>Planet Name: {{ $data['name'] }}</b><br>
            <b>Star Name: {{ $data['star_name'] }}</b><br>
            <button class="btn btn-outline-dark btn-sm" style="color:white" id="hide-tutorial">X</button>
        </div>
    </div>
    <div id="star-info" style="position: absolute; color: white; font-family: Arial, sans-serif; z-index: 1;"></div>
    <div id="angle-display" style="position: absolute; top: 30px; right: 270px; color: white; z-index: 1;">Ángulo: 0°</div>
    <div id="popup-menu" style="position: absolute; top: 30px; left: 20px; width: 250px; background-color: rgba(128, 128, 128, 0.2); color: white; padding: 10px; border-radius: 5px; display: none;">
        <div id="popup-content"></div>
    </div>
    <div id="click-circle" style="position: absolute; width: 10px; height: 10px; background-color: red; border-radius: 50%; display: none;"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Ocultar el text_tutorial cuando se haga clic en el botón
        const hideTutorialButton = document.getElementById('hide-tutorial');
        hideTutorialButton.addEventListener('click', function() {
            const textTutorial = document.getElementById('text_tutorial');
            textTutorial.style.display = 'none';
        });

        // Escena, cámara y renderizador
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Asegúrate de que el canvas se renderice dentro del contenedor adecuado
        const container = document.getElementById('threejs-container');
        container.appendChild(renderer.domElement);

        // Ajustar el tamaño del canvas para tener en cuenta el sidebar
        function adjustCanvasSize() {
            const sidebarWidth = document.querySelector('.main-sidebar').offsetWidth;
            console.log(sidebarWidth)
            const canvasWidth = window.innerWidth - sidebarWidth;
            renderer.setSize(canvasWidth, window.innerHeight);
            camera.aspect = canvasWidth / window.innerHeight;
            camera.updateProjectionMatrix();
        }

        // Ajustar el tamaño inicialmente
        adjustCanvasSize();

        window.addEventListener('resize', adjustCanvasSize);
        const sidebar = document.querySelector('.main-sidebar');
        if (sidebar) {
            console.log('sidebar modificado');
            sidebar.addEventListener('transitionend', adjustCanvasSize);
        }
        // Crear fondo con degradado para simular el espacio
        const gradientCanvas = document.createElement('canvas');
        const gradientContext = gradientCanvas.getContext('2d');
        gradientCanvas.width = 2048;
        gradientCanvas.height = 1024;

        // Crear un gradiente radial en el canvas
        const gradient = gradientContext.createRadialGradient(
            gradientCanvas.width / 2, 
            gradientCanvas.height / 2, 
            200, 
            gradientCanvas.width / 2, 
            gradientCanvas.height / 2, 
            1024
        );

        // Color más oscuro en el centro y transición más sutil a los bordes
        gradient.addColorStop(0, 'rgba(0, 0, 0, 1)');  // Centro oscuro
        gradient.addColorStop(0.5, 'rgba(0, 0, 20, 0.8)');  // Transición a un azul muy oscuro
        gradient.addColorStop(1, 'rgba(0, 0, 30, 0.5)');  // Azul más oscuro en el borde

        // Aplicar el gradiente al fondo
        gradientContext.fillStyle = gradient;
        gradientContext.fillRect(0, 0, gradientCanvas.width, gradientCanvas.height);

        const texture = new THREE.CanvasTexture(gradientCanvas);
        scene.background = texture;

        

        // Crear estrellas en posiciones específicas
        const stars = [];
        function createStars() {
            const starGeometry = new THREE.SphereGeometry(0.5, 24, 24);

            @foreach($data['stars'] as $star)
                {
                    let color = new THREE.Color(`hsl(${Math.random() * 360}, 70%, 85%)`); // Colores suaves
                    let starMaterial = new THREE.MeshBasicMaterial({ color: color });
                    let star = new THREE.Mesh(starGeometry, starMaterial); // Variable única para cada estrella
                    star.position.set({{ $star['x'] }}, {{ $star['y'] }}, {{ $star['z'] }});
                    star.userData = { opacityDirection: 1, opacitySpeed: Math.random() * 0.2+0.1 ,name: "{{ $star['name'] }}" // Agregar el nombre de la estrella
                };
                    scene.add(star);
                    stars.push(star);
                }
            @endforeach
        }
        createStars();

        let isRotating = true;  // Variable para controlar si las estrellas están rotando
        window.addEventListener('keydown', function(event) {
            if (event.code === 'Space') {
                isRotating = !isRotating;  // Cambia el estado de rotación
            }
        });

        const rotationSpeed = 0.0003;
        function rotateStars() {
            if (isRotating) {
                stars.forEach(star => {
                    star.position.applyAxisAngle(new THREE.Vector3(0, 1, 0), rotationSpeed);
                });
            }
        }

        function twinkleStars() {
            stars.forEach(star => {
                // Probabilidad de parpadeo para cada estrella (ajusta según tus necesidades)
                const twinkleProbability = 0.1; // 1% de probabilidad de parpadeo en cada frame

                if (Math.random() < twinkleProbability) {
                    star.material.opacity += star.userData.opacityDirection * star.userData.opacitySpeed;
                    if (star.material.opacity >= 1 || star.material.opacity <= 0.3) {
                        star.userData.opacityDirection *= -1; // Cambiar dirección del parpadeo
                    }
                    star.material.transparent = true;
                }
            });
        }

        // Posicionar la cámara en el centro del espacio
        camera.position.set(0, 0, 10);

        // Controles de la cámara con restricciones
        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.enableZoom = false;
        controls.enableRotate = true;
        controls.enablePan = false;
        controls.maxPolarAngle = Math.PI;
        controls.minPolarAngle = -Math.PI;
        controls.screenSpacePanning = false;
        controls.target.set(0, 0, 0);

        // Mostrar ángulo de rotación
        const angleDisplay = document.getElementById('angle-display');
        function updateAngleDisplay() {
    const phi = THREE.MathUtils.radToDeg(controls.getPolarAngle());
    const adjustedPhi = phi - 90;
    const hasDecimals = adjustedPhi % 1 !== 0;
    angleDisplay.innerText = `Angle: ${hasDecimals ? adjustedPhi.toFixed(2) : adjustedPhi}°`;
}

        // Raycaster para detectar clics en las estrellas
        const raycaster = new THREE.Raycaster();
        const mouse = new THREE.Vector2();

        // Función para generar un poema corto
        function generatePoem() {
            const poems = [
                
"In the night sky, a star takes flight,\nA tiny flicker, a beacon of light,\nIn the vast expanse, its glow sincere,\nA guide through darkness, ever near.",

"High above, the star ascends,\nIts light a promise, a hope that mends,\nIn the quiet night, it softly bends,\nA dream that never truly ends.",

"Upon the heavens, the stars do rise,\nTheir glimmer reflecting in weary eyes,\nIn the silent night, no need for disguise,\nA journey unfolds beneath the skies.",

"In the darkest hours, a star will stay,\nIts light a whisper that leads the way,\nIn the endless night, its beams convey,\nA truth unspoken, come what may.",

"Amid the stars, a story is told,\nOf dreams untouched, of hearts so bold,\nIn the vastness, their secrets unfold,\nA promise of warmth in the night's cold.",

"Through the quiet sky, a star will call,\nIts light a thread connecting all,\nIn the distance, its shadows fall,\nA sign of hope, however small.",

"A star's soft gleam in the midnight air,\nIts light a balm for each despair,\nIn the endless sky, it shines so fair,\nA spark of joy we long to share.",

"In the boundless sky, a star takes hold,\nIts silver fire, its heart of gold,\nIn the vast unknown, a tale is told,\nA dream of peace that won't grow old.",

"The star's light shines in the silent night,\nA steadfast glow, a gentle might,\nIn the endless dark, its hope takes flight,\nA distant dream that feels so right.",

"Above the world, a star does gleam,\nIts glow a wish, a brightened stream,\nIn the quiet dark, it casts a beam,\nA flicker of hope, a cherished dream.",

"Beyond the clouds, the stars appear,\nTheir light a comfort, always near,\nIn the deepest night, they have no fear,\nA silent guide through every tear.",

"In the velvet sky, the stars reside,\nTheir brilliance bright, their light a guide,\nIn the silent dark, they never hide,\nA path to hope, a dream beside.",

"Under the moon, the stars ignite,\nTheir silver beams, a tranquil sight,\nIn the darkest hours, they bring the light,\nA promise of dawn, soft and bright.",

"The stars above, in quiet grace,\nTheir glow a memory time can’t erase,\nIn the endless sky, they leave no trace,\nYet in our hearts, they find a place.",

"In the stillness, a star does burn,\nIts light a beacon, a soul's return,\nIn the endless night, we look and yearn,\nA dream to hold, a wish to learn.",

"Among the stars, a story waits,\nA whispered hope beyond the gates,\nIn the dark, their beauty creates,\nA dream of peace that never abates.",

"In the velvet sky, where stars align, Puchita shines, a love so divine, Her light eclipses all the rest, A beacon bright, a heart's caress. \nIn the cosmic dance, she takes her place,  A radiant soul, a glowing grace,  Among the stars, she stands apart,  A tender flame, a loving heart.\nPuchita, my star, my guiding light,  In every moment, you bring delight,  Through night and day, your love I see,  A constellation, just for me.",

"The stars aloft, so pure and bright,\nTheir glow a lantern in the night,\nIn the darkest sky, they give us sight,\nA song of dreams, taking flight.",

"Through the vastness, the stars remain,\nA gentle light in night's domain,\nIn the quiet dark, they ease the pain,\nA hope reborn through joy and strain.",

"Between the stars, a truth is found,\nA light that knows no earthly bound,\nIn the endless night, they sing around,\nA melody pure, a sacred sound.",

"In the starry sky, a light will glow,\nIts gentle warmth, a steady flow,\nIn the endless night, it lets us know,\nThat hope endures, wherever we go."

            ];
            return poems[Math.floor(Math.random() * poems.length)];
        }

        window.addEventListener('click', function(event) {
    const sidebarWidth = document.querySelector('.main-sidebar').offsetWidth;
    const rect = renderer.domElement.getBoundingClientRect();

    const clickX = event.clientX - rect.left; // Ajustar por el ancho del sidebar
    const clickY = event.clientY - rect.top;
    
    mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(stars);

    const popupMenu = document.getElementById('popup-menu');
    const popupContent = document.getElementById('popup-content');
    const clickCircle = document.getElementById('click-circle');

    // Mostrar el círculo rojo en el lugar pulsado
    clickCircle.style.left = clickX - 5 + 'px'; // Centrar el círculo en el clic
    clickCircle.style.top = clickY - 5 + 'px'; // Centrar el círculo en el clic
    clickCircle.style.display = 'block';

    // Ocultar el círculo después de un breve período de tiempo
    setTimeout(() => {
        clickCircle.style.display = 'none';
    }, 500);

    // Mostrar las coordenadas del clic
    clickCoordinatesText = `X: ${clickX.toFixed(2)}, Y: ${clickY.toFixed(2)}`;


    if (intersects.length > 0) {
        const star = intersects[0].object;
        const { x, y, z } = star.position;
        const poem = generatePoem();
        const starName = star.userData.name; // Obtener el nombre de la estrella
        popupContent.innerHTML = `
            <p>Star Name: ${starName}</p>
            <p>Star coordinates:</p>
            <p>X: ${x.toFixed(2)}, Y: ${y.toFixed(2)}, Z: ${z.toFixed(2)}</p>
            <p>${poem}</p>
        `;
        popupMenu.style.display = 'block';
    } else {
        popupMenu.style.display = 'none';
    }
});

        // Animar la escena
        function animate() {
            requestAnimationFrame(animate);
            rotateStars();
            twinkleStars();
            controls.update();
            updateAngleDisplay();
            renderer.render(scene, camera);
        }
        animate();

        // Ajustar el tamaño del canvas al redimensionar la ventana
        window.addEventListener('resize', function() {
            const width = window.innerWidth;
            const height = window.innerHeight;
            const contentWrapper = document.querySelector('.content-wrapper');
            renderer.setSize(window.innerWidth, window.innerHeight);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });

    });
</script>


    @if(session('errorMessage'))
        <script>
            alert("{{ session('errorMessage') }}");
        </script>
    @endif
@stop

@section('footer')
@stop

@push('css')
    <style>
        body, html {
            height: 100%;
            overflow: hidden; /* Elimina el scroll vertical */
        }
        canvas { display: block; }
        #info {
            position: absolute;
            color: white;
            font-family: Arial, sans-serif;
            z-index: 1;
            top: 50px; /* Ajusta esta propiedad para mover el texto hacia arriba */
            left:calc(50vw - 400px);
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            text-align: center;
        }

        #threejs-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden; /* Asegura que no haya desplazamientos adicionales */
        }
        .content-wrapper {
            height: calc(100vh);
            overflow: hidden;
            padding: 0 !important;
        }
        .content{
            margin: 0 !important;
            padding: 0 !important;
        }
        .container-fluid{
            margin: 0 !important;
            padding: 0 !important;
        }
        .container{
            margin: 0 !important;
            padding: 0 !important;
        }
        .content-header{
            padding: 0 !important;
        }
        .main-footer{
            margin: 0 !important;
            padding: 0 !important;
        }
        .custom-footer {
            margin: 0 !important;
            padding: 0 !important;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo transparente */
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 2; /* Asegura que esté encima del contenido */
        }
        .custom-footer a {
            color: white;
            text-decoration: none;
        }
        .main-header.navbar {
            padding: 0 !important;
            border: none !important;
            background-color: rgba(69,77,85, 0); /* Fondo transparente al 50% */
            position: absolute;
            top: 0;
            left: 0;
            z-index: 3; /* Asegura que esté encima del contenido */
        }
        .main-header a {
            color: white;
            text-decoration: none;
        }

        #star-info {
            display: none;
            position: absolute;
            color: white;
            font-family: Arial, sans-serif;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px;
            border-radius: 5px;
            pointer-events: none; /* Asegura que el elemento no interfiera con los clics */
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function adjustHeaderWidth() {
                const contentWrapper = document.querySelector('.content-wrapper');
                const mainHeader = document.querySelector('.main-header.navbar');
                const contentBody = document.querySelector('.content-wrapper .content');
                if (contentWrapper && mainHeader && contentBody) {
                    const contentWidth = contentWrapper.offsetWidth;
                    mainHeader.style.width = contentWidth + 'px';
                    contentBody.style.width = contentWidth + 'px';
                }
            }

            // Ajustar el ancho inicialmente
            adjustHeaderWidth();

            // Ajustar el ancho cuando se redimensiona la ventana
            window.addEventListener('resize', adjustHeaderWidth);

            // Ajustar el ancho cuando se colapsa o se expande el sidebar
            const sidebar = document.querySelector('.main-sidebar');
            if (sidebar) {
                sidebar.addEventListener('transitionend', adjustHeaderWidth);
            }
        });
    </script>
@endpush