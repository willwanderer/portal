<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive GeoJSON Map</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        #map {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .legend {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            z-index: 1000;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            max-width: 300px;
            height: auto;
        }

        .legend div {
            width: 45%;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .legend div:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .legend div span {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 4px;
        }

        .legend #clear-button {
            width: 100%;
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }

        .legend #clear-button:hover {
            background-color: #d32f2f;
        }

        #details {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 200px;
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            box-sizing: border-box;
            font-size: 12px;
            color: #333;
            z-index: 1001;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: none;
        }

        #details img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        #details h5 {
            margin: 0;
            font-size: 14px;
        }

        #details p {
            margin: 5px 0;
        }

        #details button {
            margin-top: 8px;
            padding: 6px 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        #details button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div class="legend" id="legend">
        <h4>Legend</h4><br>
    </div>
    <div id="details">
        <img id="area-image" src="" alt="Area Image">
        <h5 id="area-name">Select an area</h5>
        <p id="area-description">Description will appear here.</p>
        <button id="details-button">Show More</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>

    <!-- START PRELOADS -->
    <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
    <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
    <!-- END PRELOADS -->                  

    <!-- START SCRIPTS -->
    <!-- START PLUGINS -->
    <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
    <!-- END PLUGINS -->

    <!-- START THIS PAGE PLUGINS-->     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>


    <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
    <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

    <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
    <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
    <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
    <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
    <!-- <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
    <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                 -->
    <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
    <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>      

    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
    <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>           

    <script type="text/javascript" src="js/plugins/moment.min.js"></script>
    <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>

    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 

    <script src="../../js/sweetalert2/package/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../../js/sweetalert2/package/dist/sweetalert2.min.css">

    <script type="text/javascript" src="../../js/Fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="../../js/Fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

     <script type="text/javascript" src="js/plugins/summernote/summernote.js"></script>

    <!-- END THIS PAGE PLUGINS-->        

    <!-- START TEMPLATE -->
    <script type="text/javascript" src="js/settings.js"></script>

    <script type="text/javascript" src="js/plugins.js"></script>        
    <script type="text/javascript" src="js/actions.js"></script>
    <script>
        const map = L.map('map').setView([-2.5, 120.0], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const geojsonFiles = [
            { file: '7301.geojson', name: 'Area 7302' },
            { file: '7302.geojson', name: 'Area 7302' },
            { file: '7303.geojson', name: 'Area 7303' },
            { file: '7304.geojson', name: 'Area 7302' },
            { file: '7305.geojson', name: 'Area 7302' },
            { file: '7306.geojson', name: 'Area 7303' },
            { file: '7307.geojson', name: 'Area 7302' },
            { file: '7308.geojson', name: 'Area 7302' },
            { file: '7309.geojson', name: 'Area 7303' },
            { file: '7310.geojson', name: 'Area 7302' },
            { file: '7311.geojson', name: 'Area 7302' },
            { file: '7312.geojson', name: 'Area 7303' },
            { file: '7313.geojson', name: 'Area 7302' },
            { file: '7314.geojson', name: 'Area 7302' },
            { file: '7315.geojson', name: 'Area 7303' },
            { file: '7316.geojson', name: 'Area 7302' },
            { file: '7317.geojson', name: 'Area 7302' },
            { file: '7318.geojson', name: 'Area 7303' },
            { file: '7322.geojson', name: 'Area 7302' },
            { file: '7325.geojson', name: 'Area 7303' },
            { file: '7371.geojson', name: 'Area 7302' },
            { file: '7373.geojson', name: 'Area 7303' }
        ];

        // Function to generate a random color
        function generateRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        const legend = $('#legend');
        const details = $('#details');
        const areaNameElement = $('#area-name');
        const areaDescriptionElement = $('#area-description');
        const areaImageElement = $('#area-image');
        let layers = [];
        let labelMarker = null;

        geojsonFiles.forEach((geojson, index) => {
            const color = generateRandomColor(); // Generate random color for each area

            fetch(geojson.file)
                .then(response => response.json())
                .then(data => {
                    const layer = L.geoJSON(data, {
                        style: { color: color, weight: 2, fillOpacity: 0.5 }
                    }).addTo(map);
                    layers.push(layer); // Store the layer for later reference

                    const bounds = layer.getBounds();
                    const randomImage = `https://picsum.photos/400/300?random=${index}`;

                    legend.append(`
                        <div data-index="${index}" data-bounds='${JSON.stringify(bounds)}' data-name="${geojson.name}" data-description="${data.features[0]?.properties?.description || 'No description available'}" data-image="${randomImage}">
                            <span style="background-color: ${color};"></span>${geojson.name}
                        </div>
                    `);

                    legend.on('click', `div[data-index="${index}"]`, function () {
                        // Hide all layers
                        layers.forEach(layer => map.removeLayer(layer));

                        // Show the clicked area layer
                        map.fitBounds(bounds, { padding: [20, 20] });
                        layer.addTo(map);

                        // Create or update the label marker at the center of the bounds
                        if (labelMarker) {
                            map.removeLayer(labelMarker);
                        }
                        const center = bounds.getCenter();
                        labelMarker = L.marker(center, {
                            icon: L.divIcon({
                                className: 'leaflet-label',
                                html: `<div style="font-size: 16px; font-weight: bold; color: ${color}; background: rgba(255, 255, 255, 0.7); padding: 5px; border-radius: 8px;">${geojson.name}</div>`,
                                iconSize: [100, 40],
                                iconAnchor: [50, 20]
                            })
                        }).addTo(map);

                        // Update details
                        areaNameElement.text($(this).data('name'));
                        areaDescriptionElement.text($(this).data('description'));
                        areaImageElement.attr('src', $(this).data('image'));
                        details.show();
                    });
                });
        });

        // Clear all areas and reset map
        $('#clear-button').on('click', function () {
            layers.forEach(layer => map.removeLayer(layer));
            if (labelMarker) {
                map.removeLayer(labelMarker);
            }
            details.hide();
        });
    </script>
</body>
</html>
