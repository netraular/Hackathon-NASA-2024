<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Field</title>
    <style>
        body { margin: 0; }
        canvas { display: block; }
        #info {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            font-family: Arial, sans-serif;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div id="info">Haz clic en una estrella para ver sus coordenadas. Usa el mouse para rotar y el scroll para hacer zoom.</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script>
        // Escena, cámara y renderizador
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // Crear un planeta (simulado con una esfera grande)
        const planetGeometry = new THREE.SphereGeometry(10, 32, 32);
        const planetMaterial = new THREE.MeshBasicMaterial({ color: 0x003366 });
        const planet = new THREE.Mesh(planetGeometry, planetMaterial);
        scene.add(planet);

        // Posiciona la cámara en el planeta (ligeramente sobre la superficie)
        camera.position.set(0, 20, 50);
        camera.lookAt(planet.position);

        // Controles de órbita para rotar y hacer zoom
        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true; // Para suavizar el movimiento
        controls.dampingFactor = 0.05;
        controls.enableZoom = true;
        controls.autoRotate = false;
        controls.enablePan = false;

        // Array para las estrellas
        const stars = [];

        // Función para generar estrellas aleatorias alrededor del planeta
        function createStarField() {
            const starGeometry = new THREE.SphereGeometry(0.2, 16, 16);

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
            // Normalizar coordenadas del mouse
            mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

            // Actualiza el raycaster con las coordenadas de la cámara y el ratón
            raycaster.setFromCamera(mouse, camera);

            // Intersecciones con los objetos en la escena
            const intersects = raycaster.intersectObjects(stars);

            if (intersects.length > 0) {
                const star = intersects[0].object;
                const { x, y, z } = star.position;
                const { name, magnitude } = star.userData;

                console.log(`Coordenadas de la estrella: X: ${x}, Y: ${y}, Z: ${z}`);
                document.getElementById('info').innerText = `Nombre: ${name} | Magnitud: ${magnitude} | Coordenadas: X: ${x.toFixed(2)}, Y: ${y.toFixed(2)}, Z: ${z.toFixed(2)}`;
            }
        });

        // Animar las estrellas (parpadeo leve)
        function animateStars() {
            stars.forEach(star => {
                const scaleFactor = 0.1 * Math.sin(Date.now() * 0.001 + Math.random()) + 1;
                star.scale.set(scaleFactor, scaleFactor, scaleFactor);
            });
        }

        // Render loop
        function animate() {
            requestAnimationFrame(animate);
            controls.update(); // Actualizar los controles en cada cuadro
            animateStars(); // Animar las estrellas
            renderer.render(scene, camera);
        }

        animate();

        // Ajustar el tamaño del renderizador al redimensionar la ventana
        window.addEventListener('resize', () => {
            const width = window.innerWidth;
            const height = window.innerHeight;
            renderer.setSize(width, height);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });
    </script>
</body>
</html>
