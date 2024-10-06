<script>
    // Event listeners
    function setupEventListeners(raycaster, mouse, camera, stars, currentConstellation, savedConstellations, renderer) {
        window.addEventListener('click', onMouseClick);
        window.addEventListener('mousemove', onMouseMove);

        function onMouseClick(event) {
            updateMousePosition(event, renderer);
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
            updateMousePosition(event, renderer);
            raycaster.setFromCamera(mouse, camera);

            if (drawing) {
                checkLineHover();
            } else {
                checkConstellationHover();
            }
        }

        function updateMousePosition(event, renderer) {
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
            
            const linesToCheck = currentConstellation
                .filter(item => item.line)
                .map(item => item.line);
            
            const intersects = raycaster.intersectObjects(linesToCheck, true);
            
            if (intersects.length > 0) {
                hoveredLine = intersects[0].object;
                hoveredLine.material.color.setHex(0xff0000);
            }

            currentConstellation.forEach(item => {
                if (item.line && item.line !== hoveredLine) {
                    item.line.material.color.setHex(0xffff00);
                }
            });
        }

        function checkConstellationHover() {
            const constellationInfo = document.getElementById('constellation-info');
            constellationInfo.style.display = 'none';

            savedConstellations.forEach(constellation => {
                constellation.lines.forEach(line => {
                    line.material.color.setHex(0xaaaaaa);
                });

                const intersects = raycaster.intersectObjects(constellation.lines, true);

                if (intersects.length > 0) {
                    constellation.lines.forEach(line => {
                        line.material.color.setHex(0xffff00);
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

        return { onMouseClick, onMouseMove, updateMousePosition, addStarToConstellation, drawLine, deleteLine, checkLineHover, checkConstellationHover, showConstellationInfo };
    }

    // UI Controls
    function setupUIControls(currentConstellation, savedConstellations) {
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
                const lines = [];
                
                if (currentConstellation[0].line) {
                    lines.push(currentConstellation[0].line);
                }
                
                for (let i = 1; i < currentConstellation.length; i++) {
                    if (currentConstellation[i].line) {
                        lines.push(currentConstellation[i].line);
                    }
                }
                
                lines.forEach(line => line.material.color.setHex(0xaaaaaa));
                
                savedConstellations.push({ name, lines });
                document.getElementById('constellation-name-modal').style.display = 'none';
                createBtn.textContent = 'Create Constellation';
                currentConstellation = [];
            }
        }

        return { toggleDrawing, showNamePrompt, saveConstellation };
    }
</script>