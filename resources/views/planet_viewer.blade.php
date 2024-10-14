<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Viewer</title>
    <style>
        body { margin: 0; }
        canvas { display: block; }
        #interaction-panel {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }
        #interaction-panel div {
            margin-bottom: 5px;
        }
    </style>
<script type="importmap">
    {
    "imports": {
        "three": "https://cdn.jsdelivr.net/npm/three@0.169.0/build/three.module.js",
        "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.169.0/examples/jsm/"
    }
    }
</script>
</head>
<body>
    <div id="interaction-panel">
        <div>Telescope: <span id="telescope-status">Hidden</span></div>
        <div>Left Panel: <span id="leftpanel-status">Hidden</span></div>
        <div>Top Panel: <span id="toppanel-status">Hidden</span></div>
        <div>Planet: <span id="planet-status">Hidden</span></div>
    </div>
    <script type="module" >
import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

const scene = new THREE.Scene();
const notCollide = 1;
const objectLayer = 0;
let line1, line2;

function addCamera() {
    const camera = new THREE.PerspectiveCamera(
        90,
        window.innerWidth / window.innerHeight,
        0.01,
        1000
    )
    camera.position.set(0, 1.6, 5); // Ajusta la posición de la cámara
    camera.lookAt(0, 0, 0)
    return camera
}
let camera = addCamera()
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

const ambientLight = new THREE.AmbientLight(0xFFF2F0, 0.7);
scene.add(ambientLight);

const loader = new GLTFLoader();
let leftpanel;
let planet;
let sun;
let telescope;
let panels;

function changeVisibility()
{
    panels.visible = !panels.visible;
    if (panels.visible)
        panels.layers.set(objectLayer);
    else
        panels.layers.set(notCollide);
    panels.children.forEach(panel => {
        panel.visible = !panel.visible;
        if (panel.visible)
            panel.layers.set(objectLayer);
        else
        panel.layers.set(notCollide);
    })
    return panels;
}

loader.load('/assets/keplerbig.glb', function(gltf) {
    const model = gltf.scene;   
    model.name = "cockpit";
    model.position.set(0, 0, 0);  
    model.scale.set(1, 1, 1);    
    model.layers.set(objectLayer);
    scene.add(gltf.scene);  
    renderer.render(scene, camera);  

    gltf.scene.traverse((child) => {
        if (child.isMesh) {
            if (child.name === 'toppanel') 
            {
                child.visible = false;
                panels = child;  
                panels.layers.set(notCollide);
                panels.children.forEach(panel => {
                    panel.visible = false;
                    panel.layers.set(notCollide);
                });
            }
            else if (child.name === 'leftpanel')
            {
                child.visible = false;
                leftpanel = child;
                leftpanel.layers.set(notCollide);
            }
            else if (child.name === 'telescope')
                {
                    telescope = child;
                }
            else if (child.name === 'Planet')
            {
                child.visible = false;
                planet = child; 
            }
            else if (child.name === 'Sun')
            {
                sun = child;
            }
        }
    });
});

scene.background = new THREE.Color(0xffffff); 

window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.dampingFactor = 0.05;
controls.screenSpacePanning = false;
controls.minDistance = 1;
controls.maxDistance = 50;

const sounds = {};

const listener = new THREE.AudioListener();
camera.add( listener );

const audioLoader = new THREE.AudioLoader();

audioLoader.load( 'assets/big_planet.wav', function( buffer ) {
    const sound = new THREE.Audio(listener);
	sound.setBuffer( buffer );
	sound.setLoop( false );
	sound.setVolume( 0.7 );
    sounds.big = sound;
});
audioLoader.load( 'assets/medium.wav', function( buffer ) {
    const sound = new THREE.Audio(listener);
	sound.setBuffer( buffer );
	sound.setLoop( false );
	sound.setVolume( 0.7 );
    sounds.mid = sound;
});
audioLoader.load( 'assets/small_planet.wav', function( buffer ) {
    const sound = new THREE.Audio(listener);
	sound.setBuffer( buffer );
	sound.setLoop( false );
	sound.setVolume( 0.7 );
    sounds.small = sound;
});

audioLoader.load( 'assets/congrats.wav', function( buffer ) {
    const sound = new THREE.Audio(listener);
	sound.setBuffer( buffer );
	sound.setLoop( false );
	sound.setVolume( 0.7 );
    sounds.congrats = sound;
});

audioLoader.load( 'assets/kepler_audio.wav', function( buffer ) {
    const sound = new THREE.Audio(listener);
	sound.setBuffer( buffer );
	sound.setLoop( false );
	sound.setVolume( 0.7 );
    sounds.kepler = sound;
});

const background = new THREE.Audio(listener);

audioLoader.load( 'assets/background.mp3', function( buffer ) {
	background.setBuffer( buffer );
	background.setLoop( true );
	background.setVolume( 0.2 );
    sounds.background = background;
});

function render() {
    if (sun) {
        sun.rotation.y += 0.00005;
        sun.rotation.x += 0.00002;
        sun.rotation.z -= 0.00001;
    }
    if (telescope) {
        telescope.rotation.y += 0.0002;
    }
    if (planet) {
        planet.rotation.y += 0.0008;
    }
    controls.update();
    renderer.render(scene, camera);
}

function getTextureName(object)
{
    return object.material.map.name;
}

function playAudio(texture)
{
    if (texture.includes('big'))
        sounds.big.play();
    else if (texture.includes('small'))
        sounds.small.play();
    else if (texture.includes('med'))
        sounds.mid.play();
}

const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();

function onDocumentClick(event) {
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    const intersects = raycaster.intersectObjects(scene.children, true);

    if (intersects.length > 0) {
        const intersectedObject = intersects[0].object;
        console.log(`Clicked on: ${intersectedObject.name}`);

        if (intersectedObject.name === "telescope")
        {
            sounds.kepler.play();
            leftpanel.visible = !leftpanel.visible;
            if (leftpanel.visible)
                leftpanel.layers.set(objectLayer);
            else
                leftpanel.layers.set(notCollide);
            changeVisibility();
            if (intersectedObject.material.color.getHex() === 0xFFFFFF)
                intersectedObject.material.color.set(0xE7E7E7); // Change color on click
            else
            {
                intersectedObject.material.color.set(0xFFFFFF); // Change color on click
            }
            document.getElementById('telescope-status').textContent = leftpanel.visible ? 'Visible' : 'Hidden';
        }
        else if (intersectedObject.name === "toppanel") //Always the correct one 
        {
            sounds.congrats.play();
            planet.visible = true;
            changeVisibility();
            document.getElementById('planet-status').textContent = 'Visible';
        }
        else if(intersectedObject.name === "leftpanel")
        {
            let name = getTextureName(intersectedObject)
            playAudio(name);
            document.getElementById('leftpanel-status').textContent = intersectedObject.visible ? 'Visible' : 'Hidden';
        }
        else if (intersectedObject.name === "botpanel")
        {
            let name = getTextureName(intersectedObject)
            playAudio(name);
        }
        else if (intersectedObject.name === "midpanel")
        {
            let name = getTextureName(intersectedObject)
            playAudio(name);
        }
    }
}

document.addEventListener('click', onDocumentClick);

document.addEventListener('click', () => {
    if (sounds.background && !sounds.background.isPlaying) {
        sounds.background.play();
    }
});

renderer.setAnimationLoop(render);

    </script> <!-- Link to your JavaScript file -->
</body>
</html>