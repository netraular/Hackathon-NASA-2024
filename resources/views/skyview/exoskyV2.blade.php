@extends('layouts.app')

@section('subtitle', 'Star Field')

@section('content_body')
    <div id="threejs-container">
        <div id="info">
            <div id="text_tutorial">
                    Here you can create your own constellations and share it with others.
                <button class="btn btn-outline-dark btn-sm" style="color:white" onclick="document.getElementById('text_tutorial').style.display = 'none';">X</button>
            </div>
        </div>
        <div id="star-info" style="position: absolute; color: white; font-family: Arial, sans-serif; z-index: 1;"></div>
        <div id="constellation-info"></div>
    <div class="controls">
        <button id="create-btn">Create Constellation</button>
    </div>

    <div id="constellation-name-modal">
        <div class="modal-content">
            <h2>Name your constellation</h2>
            <input type="text" id="constellation-name" placeholder="Enter constellation name">
            <button id="save-constellation">Save</button>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script>
         // Scene setup
         const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('threejs-container').appendChild(renderer.domElement);

        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;

        // Variables
        const stars = [];
        let currentConstellation = [];
        let savedConstellations = [];
        let drawing = false;
        let hoveredLine = null;

        // Create star field
        function createStarField() {
            const starGeometry = new THREE.SphereGeometry(1, 16, 16);
            for (let i = 0; i < 100; i++) {
                const starMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff });
                const star = new THREE.Mesh(starGeometry, starMaterial);
                star.position.set(
                    Math.random() * 200 - 100,
                    Math.random() * 200 - 100,
                    Math.random() * 200 - 100
                );
                scene.add(star);
                stars.push(star);
            }
        }
        createStarField();

        // Raycaster for interactions
        const raycaster = new THREE.Raycaster();
        const mouse = new THREE.Vector2();

        // Event listeners
        window.addEventListener('click', onMouseClick);
        window.addEventListener('mousemove', onMouseMove);

        function onMouseClick(event) {
            updateMousePosition(event);
            raycaster.setFromCamera(mouse, camera);

            if (drawing) {
                if (hoveredLine) {
                    deleteLine(hoveredLine);
                } else {
                    const intersects = raycaster.intersectObjects(stars);
                    if (intersects.length > 0) {
                        const star = intersects[0].object;
                        addStarToConstellation(star);
                    }
                }
            }
        }

        function onMouseMove(event) {
            updateMousePosition(event);
            raycaster.setFromCamera(mouse, camera);

            if (drawing) {
                checkLineHover();
            } else {
                checkConstellationHover();
            }
        }

        function updateMousePosition(event) {
            const rect = renderer.domElement.getBoundingClientRect();
            mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
            mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
        }

        function addStarToConstellation(star) {
            if (currentConstellation.length > 0) {
                const lastStar = currentConstellation[currentConstellation.length - 1].star;
                const line = drawLine(lastStar.position, star.position, 0xffff00);
                currentConstellation.push({ star, line });
            } else {
                currentConstellation.push({ star, line: null });
            }
        }

        function drawLine(start, end, color) {
            const material = new THREE.LineBasicMaterial({ color });
            const geometry = new THREE.BufferGeometry().setFromPoints([start, end]);
            const line = new THREE.Line(geometry, material);
            scene.add(line);
            return line;
        }

        function deleteLine(line) {
            scene.remove(line);
            const index = currentConstellation.findIndex(item => item.line === line);
            if (index !== -1) {
                if (index === 0) {
                    currentConstellation[1].line = null;
                } else {
                    currentConstellation[index - 1].line = null;
                }
                currentConstellation.splice(index, 1);
            }
            hoveredLine = null;
        }


        function checkLineHover() {
        hoveredLine = null;
        
        // Create an array of lines to check
        const linesToCheck = currentConstellation
            .filter(item => item.line)
            .map(item => item.line);
        
        const intersects = raycaster.intersectObjects(linesToCheck, true);
        
        if (intersects.length > 0) {
            hoveredLine = intersects[0].object;
            hoveredLine.material.color.setHex(0xff0000); // Change color on hover
        }

        // Reset all other lines to default color
        currentConstellation.forEach(item => {
            if (item.line && item.line !== hoveredLine) {
                item.line.material.color.setHex(0xffff00); // Default color
            }
        });
    }

        function distanceFromLine(point, line) {
            const linePoints = line.geometry.attributes.position.array;
            const start = new THREE.Vector3(linePoints[0], linePoints[1], linePoints[2]);
            const end = new THREE.Vector3(linePoints[3], linePoints[4], linePoints[5]);
            const lineDirection = end.clone().sub(start).normalize();
            const pointToStart = point.clone().sub(start);
            const projection = pointToStart.dot(lineDirection);

            let closestPoint;
            if (projection <= 0) {
                closestPoint = start;
            } else if (projection >= start.distanceTo(end)) {
                closestPoint = end;
            } else {
                closestPoint = start.clone().add(lineDirection.multiplyScalar(projection));
            }

            return point.distanceTo(closestPoint);
        }

        function checkConstellationHover() {
        const constellationInfo = document.getElementById('constellation-info');
        constellationInfo.style.display = 'none';

        savedConstellations.forEach(constellation => {
            // Reset all constellation lines to default color
            constellation.lines.forEach(line => {
                line.material.color.setHex(0xaaaaaa); // Default color
            });

            const intersects = raycaster.intersectObjects(constellation.lines, true);

            if (intersects.length > 0) {
                // If any line is intersected, change its color and show info
                constellation.lines.forEach(line => {
                    line.material.color.setHex(0xffff00); // Highlight color
                });
                showConstellationInfo(constellation, event);
            }
        });
    }

        function showConstellationInfo(constellation, event) {
            const constellationInfo = document.getElementById('constellation-info');
            constellationInfo.textContent = constellation.name;
            constellationInfo.style.display = 'block';
            constellationInfo.style.left = event.clientX + 10 + 'px';
            constellationInfo.style.top = event.clientY + 10 + 'px';
        }

        // UI Controls
        const createBtn = document.getElementById('create-btn');
        createBtn.addEventListener('click', toggleDrawing);

        function toggleDrawing() {
            drawing = !drawing;
            if (drawing) {
                createBtn.textContent = 'Done';
                currentConstellation = [];
            } else {
                showNamePrompt();
            }
        }

        function showNamePrompt() {
            document.getElementById('constellation-name-modal').style.display = 'block';
        }

        document.getElementById('save-constellation').addEventListener('click', saveConstellation);

        function saveConstellation() {
            const name = document.getElementById('constellation-name').value;
            if (name && currentConstellation.length > 0) {
                const lines = currentConstellation
                    .filter(item => item.line)
                    .map(item => item.line);
                
                lines.forEach(line => line.material.color.setHex(0xaaaaaa));
                
                savedConstellations.push({ name, lines });
                document.getElementById('constellation-name-modal').style.display = 'none';
                createBtn.textContent = 'Create Constellation';
                currentConstellation = [];
            }
        }

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            controls.update();
            renderer.render(scene, camera);
        }
        animate();

        // Window resize handler
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // Set initial camera position
        camera.position.set(0, 100, 200);
        camera.lookAt(0, 0, 0);
    </script>
@stop

@section('footer')
    <div class="custom-footer">
        <div class="float-right">
            Version: {{ config('app.version', '2.0.0') }}
        </div>
        <strong>
            <a href="{{ config('app.company_url', '#') }}">
                
            </a>
        </strong>
    </div>
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
    #constellation-info {
                display: none;
                position: absolute;
                color: white;
                background-color: rgba(0, 0, 0, 0.7);
                padding: 5px;
                border-radius: 5px;
                pointer-events: none;
                z-index: 1;
            }
            .controls {
                position: absolute;
                top: 30px;
                left: 10px;
                z-index: 2;
            }
            button {
                padding: 10px 15px;
                background-color: #333;
                color: white;
                border: none;
                cursor: pointer;
                margin-right: 10px;
            }
            button:hover {
                background-color: #555;
            }
            #constellation-name-modal {
                display: none;
                position: fixed;
                z-index: 3;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 300px;
                color: black;
            }
            #constellation-name {
                width: 100%;
                padding: 5px;
                margin-bottom: 10px;
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