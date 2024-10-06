<div id="threejs-container">
    <div id="info">
        <div id="text_tutorial">
            Haz clic en una estrella para ver sus coordenadas. Usa el mouse para rotar y el scroll para hacer zoom.
            <button class="btn btn-outline-dark btn-sm" style="color:white" onclick="document.getElementById('text_tutorial').style.display = 'none';">X</button>
        </div>
    </div>
    <div id="star-info" style="position: absolute; color: white; font-family: Arial, sans-serif; z-index: 1;"></div>
</div>

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

    // Posicionar la cámara sobre el origen (0, 0, 50), mirando hacia abajo al centro (0, 0, 0)
    camera.position.set(0, 30, 0); // Cámara encima del origen
    camera.lookAt(0, 0, 0); // Apunta al centro del planeta

    // Crear un planeta justo debajo de la cámara
    const planetGeometry = new THREE.SphereGeometry(10, 32, 32);
    const planetMaterial = new THREE.MeshBasicMaterial({ color: 0x2a9d8f });
    const planet = new THREE.Mesh(planetGeometry, planetMaterial);
    planet.position.set(0, -10, 0);  // Coloca el planeta debajo de la cámara
    scene.add(planet);

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

    // Controles de la cámara con restricciones
    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.enableZoom = true;             // Permitir zoom
    controls.enableRotate = true;           // Permitir rotar
    controls.maxPolarAngle = Math.PI / 2;   // Limitar rotación hacia arriba a 90 grados
    controls.minPolarAngle = 0;             // Limitar rotación hacia abajo a 0 grados
    controls.screenSpacePanning = false;    // Deshabilita el panning
    controls.maxDistance = 100;             // Limitar zoom máximo
    controls.minDistance = 20;              // Limitar zoom mínimo

    // Raycaster para detectar clics en las estrellas
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();

    window.addEventListener('click', function(event) {
        const rect = container.getBoundingClientRect();
        const offsetX = event.clientX - rect.left;
        const offsetY = event.clientY - rect.top;

        mouse.x = (offsetX / container.clientWidth) * 2 - 1;
        mouse.y = -(offsetY / container.clientHeight) * 2 + 1;

        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObjects([planet, ...stars]);

        const starInfo = document.getElementById('star-info');
        if (intersects.length > 0) {
            const object = intersects[0].object;
            if (object === planet) {
                console.log('Has pulsado el planeta.');
            } else {
                const star = object;
                const { x, y, z } = star.position;
                starInfo.innerText = `Coordenadas de la estrella: X: ${x.toFixed(2)}, Y: ${y.toFixed(2)}, Z: ${z.toFixed(2)}`;
            }
            starInfo.style.left = event.clientX + 'px';
            starInfo.style.top = event.clientY + 'px';
            starInfo.style.display = 'block';
            setTimeout(() => { starInfo.style.display = 'none'; }, 3000);  // Ocultar después de 3 segundos
        }
    });

    // Animar la escena
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
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
</script>

