<!-- /var/www/html/hacknasa24/resources/views/skyview/exoskyV3.blade.php -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
<script>
    // Escena, cámara y renderizador
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);

    // Asegúrate de que el canvas se renderice dentro del contenedor adecuado
    const container = document.getElementById('threejs-container');
    container.appendChild(renderer.domElement);

    // Crear un planeta (simulado con una esfera grande)
    const planetGeometry = new THREE.SphereGeometry(10, 32, 32);
    const planetMaterial = new THREE.MeshBasicMaterial({ color: 0x003366 });
    const planet = new THREE.Mesh(planetGeometry, planetMaterial);
    planet.position.set(0, -10, 0); // Colocar el planeta debajo del punto 0,0
    scene.add(planet);

    // Posiciona la cámara en el punto 0,0 y mira hacia abajo
    camera.position.set(0, 0, 50);
    camera.lookAt(new THREE.Vector3(0, -10, 0));

    // Controles de órbita para rotar y hacer zoom
    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true; // Para suavizar el movimiento
    controls.dampingFactor = 0.05;
    controls.enableZoom = true;
    controls.autoRotate = false;
    controls.enablePan = false;

    // Limitar la rotación para simular una vista de ojo de pez y evitar que la cámara gire hacia arriba indefinidamente
    controls.maxPolarAngle = Math.PI / 2; // Limita la rotación vertical hacia arriba
    controls.minPolarAngle = 0; // Permite la rotación vertical hacia abajo

    // Array para las estrellas
    const stars = [];

    // Función para generar estrellas aleatorias alrededor del planeta
    function createStarField() {
        const starGeometry = new THREE.SphereGeometry(1, 16, 16); // Aumenta el tamaño de las estrellas

        for (let i = 0; i < 100; i++) {
            const magnitude = Math.random() * 5 + 1; // Magnitud aleatoria
            const starMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff });

            const star = new THREE.Mesh(starGeometry, starMaterial);

            // Datos adicionales de la estrella
            star.userData = {
                name: `Estrella-${i + 1}`,  // Nombre simulado
                magnitude: magnitude.toFixed(2) // Magnitud simulada
            };

            // Colocación aleatoria de las estrellas
            const radius = Math.random() * 100 + 50; // Están lejos del planeta
            const theta = Math.random() * Math.PI * 2; // Ángulo horizontal
            const phi = Math.random() * Math.PI; // Ángulo vertical

            // Coordenadas esféricas a cartesianas
            star.position.x = radius * Math.sin(phi) * Math.cos(theta);
            star.position.y = radius * Math.cos(phi);
            star.position.z = radius * Math.sin(phi) * Math.sin(theta);

            scene.add(star);
            stars.push(star); // Añadir la estrella al array
        }
    }

    createStarField();

    // Raycaster para la detección de clics en las estrellas
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();

    // Evento de clic
    window.addEventListener('click', (event) => {
        // Obtener el contenedor del canvas
        const container = document.getElementById('threejs-container');

        // Calcular las coordenadas del mouse relativas al contenedor
        const rect = container.getBoundingClientRect();
        const offsetX = event.clientX - rect.left;
        const offsetY = event.clientY - rect.top;

        // Normalizar coordenadas del mouse
        mouse.x = (offsetX / container.clientWidth) * 2 - 1;
        mouse.y = -(offsetY / container.clientHeight) * 2 + 1;

        // Actualiza el raycaster con las coordenadas de la cámara y el ratón
        raycaster.setFromCamera(mouse, camera);

        // Intersecciones con los objetos en la escena
        const intersects = raycaster.intersectObjects([planet, ...stars]); // Incluye el planeta en la detección

        const starInfo = document.getElementById('star-info');
        if (intersects.length > 0) {
            const intersectedObject = intersects[0].object;
            if (intersectedObject === planet) {
                console.log('Has pulsado el planeta azul');
            } else {
                const star = intersectedObject;
                const { x, y, z } = star.position;
                const { name, magnitude } = star.userData;

                starInfo.innerText = `Nombre: ${name} | Magnitud: ${magnitude} | Coordenadas: X: ${x.toFixed(2)}, Y: ${y.toFixed(2)}, Z: ${z.toFixed(2)}`;
            }
        } else {
            const mouseCoords = `Coordenadas del mouse: X: ${event.clientX}, Y: ${event.clientY}`;
            starInfo.innerText = mouseCoords;
        }

        // Ajustar el posicionamiento del elemento #star-info
        starInfo.style.left = event.clientX + 'px';
        starInfo.style.top = event.clientY + 'px';
        starInfo.style.display = 'block';
    });



    // Ajustar el tamaño del renderizador al redimensionar la ventana
    window.addEventListener('resize', () => {
        const width = window.innerWidth;
        const height = window.innerHeight;
        renderer.setSize(width, height);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    });
</script>