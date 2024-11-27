<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php include("metacss.php"); ?>
    </head>
    <body onload="kondisiload()">
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <?php include("menusamping.php");?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <?php include ("menuatas.php");?>                     

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->  

            
                     
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                   <div class="col-md-4">                                            
                                            <div class="progress-list">                                               
                                                <div class="pull-left"><strong>Jumlah WTP</strong></div>
                                                <div class="pull-right">75%</div>                                                
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">75%</div>
                                                </div>
                                            </div>
                                            <div class="progress-list">                                               
                                                <div class="pull-left"><strong>Shipped Products</strong></div>
                                                <div class="pull-right">450/500</div>                                                
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
                                                </div>
                                            </div>
                                            <div class="progress-list">                                               
                                                <div class="pull-left"><strong class="text-danger">Returned Products</strong></div>
                                                <div class="pull-right">25/500</div>                                                
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">5%</div>
                                                </div>
                                            </div>
                                            <div class="progress-list">                                               
                                                <div class="pull-left"><strong class="text-warning">Progress Today</strong></div>
                                                <div class="pull-right">75/150</div>                                                
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                                </div>
                                            </div>
                                            <p><span class="fa fa-warning"></span> Data update in end of each hour. You can update it manual by pressign update button</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="petasulsel" style="width: 100%; height: 460px"></div>
                                            <div class="legend" id="legend">
                                                <h4>Legend</h4><br><br>
                                            </div>
                                            <div id="details">
                                                <img id="area-image" src="" alt="Area Image">
                                                <h5 id="area-name">Select an area</h5>
                                                <p id="area-description">Description will appear here.</p>
                                                <button id="details-button">Show More</button>
                                            </div>
                                        </div>
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <?php include("audiojs.php"); ?>

        <script type="text/javascript">
            
            function kondisiload()
            {
                loadmap();

                
            }

            const map = L.map('petasulsel').setView([-4.2020144,119.8209562], 7);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

            // Tambahkan GeoJSON
            fetch('gjsonsulsel/7301.geojson') // Path ke file GeoJSON Anda
                .then(response => response.json())
                .then(geojsonData => {
                    L.geoJSON(geojsonData, {
                        style: {
                            color: "blue", // Warna garis
                            weight: 2,    // Ketebalan garis
                            fillColor: "yellow", // Warna isi
                            fillOpacity: 0.5    // Transparansi warna isi
                        },
                        onEachFeature: (feature, layer) => {
                            if (feature.properties && feature.properties.name) {
                                layer.bindPopup(`Area: ${feature.properties.name}`);
                            }
                        }
                    }).addTo(map);
                })
                .catch(err => console.error('Gagal memuat GeoJSON:', err));

            function loadmap()
            {
                

                

            }

            function chartpendidikan()
            {

            }
            
            
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>