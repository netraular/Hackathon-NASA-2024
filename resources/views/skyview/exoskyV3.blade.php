<div id="threejs-container">
    <div id="info">
        <div id="text_tutorial">
            Haz clic en una estrella para ver sus coordenadas. Usa el mouse para rotar.
            <button class="btn btn-outline-dark btn-sm" style="color:white" id="hide-tutorial">X</button>
        </div>
    </div>
    <div id="star-info" style="position: absolute; color: white; font-family: Arial, sans-serif; z-index: 1;"></div>
    <div id="angle-display" style="position: absolute; top: 30px; right: 270px; color: white; z-index: 1;">Ángulo: 0°</div>
    <div id="popup-menu" style="position: absolute; top: 10px; right: 10px; width: 250px; background-color: rgba(0, 0, 0, 0.8); color: white; padding: 10px; border-radius: 5px; display: none;">
        <div id="popup-content"></div>
    </div>
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

        // Añadir un helper para visualizar los ejes en el centro
        const axesHelper = new THREE.AxesHelper(20); // Muestra los ejes de 20 unidades de longitud
        scene.add(axesHelper);

        // Crear estrellas en posiciones aleatorias alrededor del punto 0,0,0
        const stars = [];
        function createStars() {
            const starGeometry = new THREE.SphereGeometry(0.5, 24, 24);
            const starMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff });

            for (let i = 0; i < 1000; i++) {
                const star = new THREE.Mesh(starGeometry, starMaterial);
                const [x, y, z] = Array(3).fill().map(() => THREE.MathUtils.randFloatSpread(500));
                star.position.set(x, y, z);
                scene.add(star);
                stars.push(star);
            }
        }
        createStars();

        // Posicionar la cámara en el centro del espacio
        camera.position.set(0, 0, 10); // La cámara en el punto (0,0,10), mirando hacia el centro

        // Controles de la cámara con restricciones
        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.enableZoom = false;            // Desactivar zoom
        controls.enableRotate = true;           // Permitir rotar
        controls.maxPolarAngle = Math.PI / 2;   // Limitar rotación hacia arriba a 90 grados
        controls.minPolarAngle = -Math.PI;      // Limitar rotación hacia abajo a -180 grados
        controls.screenSpacePanning = false;    // Deshabilita el panning
        controls.target.set(0, 0, 0);           // La cámara mira hacia el centro (0, 0, 0)

        // Mostrar ángulo de rotación
        const angleDisplay = document.getElementById('angle-display');
        function updateAngleDisplay() {
            const phi = THREE.MathUtils.radToDeg(controls.getPolarAngle()); // Ángulo hacia arriba o abajo
            angleDisplay.innerText = `Ángulo: ${phi.toFixed(2)}°`;
        }

        // Raycaster para detectar clics en las estrellas
        const raycaster = new THREE.Raycaster();
        const mouse = new THREE.Vector2();

        // Función para generar un poema corto
        function generatePoem() {
            const poems = [
                "En el cielo nocturno, una estrella brilla,\nSu luz débil, pero su corazón ardiente,\nEn la vasta oscuridad, su esencia se revela,\nUna promesa de esperanza, un sueño que no se apaga.",
                "Como un diamante en la noche oscura,\nLa estrella alza su brillo, su luz pura,\nEn el vasto cielo, su voz se eleva,\nUn canto de esperanza, un sueño que no se desvanece.",
                "En la quietud del cielo, la estrella se posa,\nSu luz suave, su brillo que no se apaga,\nEn la vasta oscuridad, su esencia se revela,\nUna promesa de luz, un sueño que no se desvanece."
            ];
            return poems[Math.floor(Math.random() * poems.length)];
        }

        window.addEventListener('click', function(event) {
            const rect = container.getBoundingClientRect();
            const offsetX = event.clientX - rect.left;
            const offsetY = event.clientY - rect.top;

            mouse.x = (offsetX / container.clientWidth) * 2 - 1;
            mouse.y = -(offsetY / container.clientHeight) * 2 + 1;

            raycaster.setFromCamera(mouse, camera);
            const intersects = raycaster.intersectObjects(stars);

            const popupMenu = document.getElementById('popup-menu');
            const popupContent = document.getElementById('popup-content');

            if (intersects.length > 0) {
                const star = intersects[0].object;
                const { x, y, z } = star.position;
                const poem = generatePoem();
                popupContent.innerHTML = `
                    <p>Coordenadas de la estrella:</p>
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
            controls.update();
            updateAngleDisplay(); // Actualiza el ángulo en pantalla
            renderer.render(scene, camera);
        }
        animate();

        // Ajustar el tamaño del canvas al redimensionar la ventana
        window.addEventListener('resize', function() {
            const width = window.innerWidth;
            const height = window.innerHeight;
            renderer.setSize(width, height);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });
    });
</script>