<div id="threejs-container">
    <div id="info">
        <div id="text_tutorial">
            Hover over a planet to see its name and distance from Earth. Use the mouse to rotate and the scroll to zoom.
            <button class="btn btn-outline-dark btn-sm" style="color:white"
                onclick="document.getElementById('text_tutorial').style.display = 'none';">X</button>
        </div>
    </div>
    <div id="planet-info" style="position: absolute; color: white; font-family: Arial, sans-serif; z-index: 1;"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
<script>
    // Scene, camera, and renderer
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);

    // Enable color management
    renderer.outputEncoding = THREE.sRGBEncoding;
    renderer.gammaFactor = 2.2;

    // Ensure canvas is rendered inside the appropriate container
    const container = document.getElementById('threejs-container');
    container.appendChild(renderer.domElement);

    // Texture loader
    const textureLoader = new THREE.TextureLoader();
    const earthTexture = textureLoader.load('https://threejs.org/examples/textures/planets/earth_atmos_2048.jpg');

    // Create Earth (central sphere)
    const earthGeometry = new THREE.SphereGeometry(10, 32, 32);
    const earthMaterial = new THREE.MeshPhongMaterial({
        map: earthTexture,
        bumpMap: earthTexture,
        bumpScale: 0.05,
    });
    const earth = new THREE.Mesh(earthGeometry, earthMaterial);
    scene.add(earth);

    // Position the camera
    camera.position.set(0, 20, 50);
    camera.lookAt(earth.position);

    // Lighting setup
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4); // Adjust intensity
    scene.add(ambientLight);

    const sunLight = new THREE.DirectionalLight(0xffffff, 0.05); // Adjust intensity
    sunLight.position.set(50, 30, 50); // Adjust position
    scene.add(sunLight);

    // Orbit controls
    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.enableZoom = true;
    controls.autoRotate = false;
    controls.enablePan = false;

    const planets = [];

    // Function to generate random color
    function getRandomColor() {
        return new THREE.Color(Math.random(), Math.random(), Math.random());
    }

    // Function to generate random planets around Earth
    // Function to generate random planets around Earth


    // Variables to store the line and distance label
    let distanceLine;
    let distanceLabel;
    let persistentLine;
    let persistentLabel;
    let selectedPlanet;
    let popup;


    function removeDistanceLineAndPopup() {
        if (persistentLine) {
            scene.remove(persistentLine);
            persistentLine = null;
        }
        if (persistentLabel) {
            document.body.removeChild(persistentLabel);
            persistentLabel = null;
        }
        if (popup) {
            document.body.removeChild(popup);
            popup = null;
        }
        selectedPlanet = null;
    }

    function createPersistentLine(planet) {
        // Remove any existing persistent line
        if (persistentLine) {
            scene.remove(persistentLine);
        }

        // Create the line geometry
        const points = [
            earth.position,
            planet.position
        ];
        const lineGeometry = new THREE.BufferGeometry().setFromPoints(points);

        // Create the line material (gray color)
        const lineMaterial = new THREE.LineBasicMaterial({ color: 0xaaaaaa });

        // Create the new persistent line
        persistentLine = new THREE.Line(lineGeometry, lineMaterial);
        scene.add(persistentLine);
    }

    // Function to create a popup for the selected planet
    function createPopup(planet) {
        const { name, distanceFromEarth } = planet.userData;

        // Remove any existing popup and line
        removeDistanceLineAndPopup();

        // Create the persistent line
        createPersistentLine(planet);

        // Create the popup element
        popup = document.createElement('div');
        popup.style.position = 'absolute';
        popup.style.right = '20px';
        popup.style.top = '20px';
        popup.style.width = '200px';
        popup.style.padding = '15px';
        popup.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
        popup.style.color = 'white';
        popup.style.fontFamily = 'Arial, sans-serif';
        popup.style.borderRadius = '5px';
        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.5)';

        // Close button (X)
        const closeButton = document.createElement('button');
        closeButton.innerHTML = 'X';
        closeButton.style.position = 'absolute';
        closeButton.style.top = '5px';
        closeButton.style.right = '5px';
        closeButton.style.background = 'transparent';
        closeButton.style.color = 'white';
        closeButton.style.border = 'none';
        closeButton.style.cursor = 'pointer';
        closeButton.onclick = removeDistanceLineAndPopup;

        // Planet name
        const planetName = document.createElement('p');
        planetName.innerHTML = `<strong>${name}</strong>`;

        // Planet distance
        const planetDistance = document.createElement('p');
        planetDistance.innerHTML = `Distance from Earth: ${distanceFromEarth} units`;

        // Constellation button
        const constellationButton = document.createElement('button');
        constellationButton.innerHTML = 'Constellation';
        constellationButton.style.padding = '5px 10px';
        constellationButton.style.backgroundColor = '#4CAF50';
        constellationButton.style.color = 'white';
        constellationButton.style.border = 'none';
        constellationButton.style.borderRadius = '3px';
        constellationButton.style.cursor = 'pointer';

        // Append elements to popup
        popup.appendChild(closeButton);
        popup.appendChild(planetName);
        popup.appendChild(planetDistance);
        popup.appendChild(constellationButton);

        // Add popup to the body
        document.body.appendChild(popup);

        // Set the selected planet
        selectedPlanet = planet;
    }


    // Raycaster for detecting clicks on planets
    window.addEventListener('click', (event) => {
        // Check if the click is outside the popup
        if (popup && !popup.contains(event.target)) {
            removeDistanceLineAndPopup();
            return;
        }

        // Get canvas container
        const container = document.getElementById('threejs-container');

        // Calculate mouse position relative to the container
        const rect = container.getBoundingClientRect();
        const offsetX = event.clientX - rect.left;
        const offsetY = event.clientY - rect.top;

        // Normalize mouse coordinates
        mouse.x = (offsetX / container.clientWidth) * 2 - 1;
        mouse.y = -(offsetY / container.clientHeight) * 2 + 1;

        // Update raycaster with camera and mouse position
        raycaster.setFromCamera(mouse, camera);

        // Check for intersections with planets
        const intersects = raycaster.intersectObjects(planets);

        if (intersects.length > 0) {
            const planet = intersects[0].object;
            selectedPlanet = planet;

            // Create a popup for the selected planet
            createPopup(planet);
        }
    });

    // Shader for planet gradient
    const planetVertexShader = `
    varying vec2 vUv;
    void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
    }
`;

    const planetFragmentShader = `
    uniform vec3 color1;
    uniform vec3 color2;
    varying vec2 vUv;
    void main() {
        vec3 finalColor = mix(color1, color2, smoothstep(0.0, 1.0, vUv.y));
        gl_FragColor = vec4(finalColor, 1.0);
    }
`;

    // Function to generate random planets around Earth
    function createPlanetarySystem() {
        const planetGeometry = new THREE.SphereGeometry(3, 32, 32); // Increased segments for smoother appearance
        const planetNames = [];

        // Generate random planet names like 'aaa', 'aab', etc.
        for (let i = 0; i < 50; i++) {
            planetNames.push(String.fromCharCode(97 + Math.floor(i / 26)) + String.fromCharCode(97 + (i % 26)));
        }

        // Create 50 planets with random distances from Earth and gradient colors
        for (let i = 0; i < 50; i++) {
            const color1 = getRandomColor();
            const color2 = getRandomColor();

            const planetMaterial = new THREE.ShaderMaterial({
                uniforms: {
                    color1: { value: color1 },
                    color2: { value: color2 }
                },
                vertexShader: planetVertexShader,
                fragmentShader: planetFragmentShader
            });

            const planet = new THREE.Mesh(planetGeometry, planetMaterial);

            // Planet data: name and random distance
            const distance = (Math.random() * 190 + 10).toFixed(2); // Random distance between 10 and 200
            planet.userData = {
                name: planetNames[i],  // Random planet name
                distanceFromEarth: distance // Random distance
            };

            // Set the radius to reflect the planet's distance from Earth
            const radius = parseFloat(distance); // Use the random distance as the radius
            const theta = Math.random() * Math.PI * 2; // Horizontal angle
            const phi = Math.random() * Math.PI; // Vertical angle

            // Convert spherical coordinates to cartesian for planet position
            planet.position.x = radius * Math.sin(phi) * Math.cos(theta);
            planet.position.y = radius * Math.cos(phi);
            planet.position.z = radius * Math.sin(phi) * Math.sin(theta);

            scene.add(planet);
            planets.push(planet);
        }
    }

    // Call the function to create the planetary system
    createPlanetarySystem();

    // Raycaster for detecting mouse hover over planets
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();



    // Function to remove the existing distance line and label
    function removeDistanceLine() {
        if (distanceLine) {
            scene.remove(distanceLine);
            distanceLine = null;
        }
        if (distanceLabel) {
            document.body.removeChild(distanceLabel);
            distanceLabel = null;
        }
    }

    // Event for mouse movement (hover)
    window.addEventListener('mousemove', (event) => {
        // If a planet is already selected, skip hover behavior
        if (selectedPlanet) return;

        // Get canvas container
        const container = document.getElementById('threejs-container');

        // Calculate mouse position relative to the container
        const rect = container.getBoundingClientRect();
        const offsetX = event.clientX - rect.left;
        const offsetY = event.clientY - rect.top;

        // Normalize mouse coordinates
        mouse.x = (offsetX / container.clientWidth) * 2 - 1;
        mouse.y = -(offsetY / container.clientHeight) * 2 + 1;

        // Update raycaster with camera and mouse position
        raycaster.setFromCamera(mouse, camera);

        // Check for intersections with planets
        const intersects = raycaster.intersectObjects([earth, ...planets]);

        if (intersects.length > 0) {
            const intersectedObject = intersects[0].object;

            if (intersectedObject === earth) {
                // Remove the previous line and label
                removeDistanceLine();

                // Create a label to show the word "EARTH"
                distanceLabel = document.createElement('div');
                distanceLabel.style.position = 'absolute';
                distanceLabel.style.color = 'white';
                distanceLabel.style.fontFamily = 'Arial, sans-serif';
                distanceLabel.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                distanceLabel.style.padding = '5px';
                distanceLabel.style.borderRadius = '5px';
                distanceLabel.innerHTML = 'EARTH';

                // Add the label to the DOM
                document.body.appendChild(distanceLabel);

                // Convert Earth's 3D position to 2D screen coordinates
                const vector = earth.position.project(camera);
                const x = (vector.x * 0.5 + 0.5) * container.clientWidth;
                const y = -(vector.y * 0.5 - 0.5) * container.clientHeight;

                // Position the label near the center of Earth
                distanceLabel.style.left = `${x}px`;
                distanceLabel.style.top = `${y}px`;

            } else {
                const planet = intersectedObject;
                const { name, distanceFromEarth } = planet.userData;

                // Remove the previous line and label
                removeDistanceLine();

                // Create the line geometry
                const points = [];
                points.push(earth.position); // Earth position (start)
                points.push(planet.position); // Planet position (end)
                const lineGeometry = new THREE.BufferGeometry().setFromPoints(points);

                // Create the line material (gray color)
                const lineMaterial = new THREE.LineBasicMaterial({ color: 0xaaaaaa });

                // Create the line
                distanceLine = new THREE.Line(lineGeometry, lineMaterial);
                scene.add(distanceLine);

                // Create a label to show the name and distance near the middle of the line
                distanceLabel = document.createElement('div');
                distanceLabel.style.position = 'absolute';
                distanceLabel.style.color = 'white';
                distanceLabel.style.fontFamily = 'Arial, sans-serif';
                distanceLabel.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                distanceLabel.style.padding = '5px';
                distanceLabel.style.borderRadius = '5px';
                distanceLabel.innerHTML = `Planet name: ${name}<br>Distance from Earth: ${distanceFromEarth} units`;

                // Add the label to the DOM
                document.body.appendChild(distanceLabel);

                // Get the midpoint of the line
                const midpoint = new THREE.Vector3();
                midpoint.addVectors(earth.position, planet.position).divideScalar(2);

                // Convert the 3D position of the midpoint to 2D screen coordinates
                const vector = midpoint.project(camera);
                const x = (vector.x * 0.5 + 0.5) * container.clientWidth;
                const y = -(vector.y * 0.5 - 0.5) * container.clientHeight;

                // Position the label near the line
                distanceLabel.style.left = `${x}px`;
                distanceLabel.style.top = `${y}px`;
            }
        } else {
            // Remove the line and label when not hovering over any planets
            removeDistanceLine();
        }
    });



    // Update function to ensure the persistent line stays connected to the planet
    function updatePersistentLine() {
        if (persistentLine && selectedPlanet) {
            const points = [
                earth.position,
                selectedPlanet.position
            ];
            persistentLine.geometry.setFromPoints(points);
            persistentLine.geometry.verticesNeedUpdate = true;
        }
    }




    // Animation loop
    function animate() {
        requestAnimationFrame(animate);
        earth.rotation.y += 0.001; // Slow rotation of Earth
        controls.update();
        renderer.render(scene, camera);
    }

    animate();


    // Adjust renderer size on window resize
    window.addEventListener('resize', () => {
        const width = window.innerWidth;
        const height = window.innerHeight;
        renderer.setSize(width, height);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    });


</script>
@stop

@section('footer')
<div class="custom-footer">
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            Button :)
        </a>
    </strong>
</div>
@stop
