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

                <?php
                    $totalpemeriksa=0;
                    $totalpegawai=0;
                    $totalpemda=0;
                    $totalentitas=0;
                    $totalpemlkpd=0;
                    $totalpemeriksaan=0;
                    $totaltimterbentuk=0;
                    $totaltimkeseluruhan=0;
                    $totalpria=0;
                    $totalwanita=0;
                    

                    $result = $con->query("SELECT count(*) as 'jumlahc' FROM `PEGAWAI` where PEG_STATUS='Aktif' and SUBSTRING_INDEX(PEG_JABATAN, ' ', 1) = 'Pemeriksa'");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalpemeriksa=$row["jumlahc"];
                    }

                    $result = $con->query("SELECT count(PEG_JENIS_KELAMIN) as 'jumlahc' FROM `PEGAWAI` where PEG_STATUS='Aktif' and SUBSTRING_INDEX(PEG_JABATAN, ' ', 1) = 'Pemeriksa' and PEG_JENIS_KELAMIN='Pria'");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalpria=$row["jumlahc"];
                    }

                    $result = $con->query("SELECT count(PEG_JENIS_KELAMIN) as 'jumlahc' FROM `PEGAWAI` where PEG_STATUS='Aktif' and SUBSTRING_INDEX(PEG_JABATAN, ' ', 1) = 'Pemeriksa' and PEG_JENIS_KELAMIN='Wanita'");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalwanita=$row["jumlahc"];
                    }

                    $result = $con->query("SELECT count(*) as 'jumlahc' FROM `PEGAWAI` where PEG_STATUS>='Aktif'");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalpegawai=$row["jumlahc"];
                    }

                    $result = $con->query("select count(*) as 'jumlahc' from entitas where SUBSTRING_INDEX(ENT_NAMA, ' ', 1) = 'Kabupaten' or SUBSTRING_INDEX(ENT_NAMA, ' ', 1) = 'Kota' or SUBSTRING_INDEX(ENT_NAMA, ' ', 1) = 'Provinsi'");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalpemda=$row["jumlahc"];
                    }

                    $result = $con->query("SELECT count(*) as 'jumlahc' FROM `ENTITAS`");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalentitas=$row["jumlahc"];
                    }

                    // $result = $con->query("SELECT PEM_OBJEK FROM `PEMERIKSAAN` where PEM_JENIS='Laporan Keuangan Pemerintah Daerah' GROUP BY PEM_OBJEK");
                    // while($row = $result->fetch_assoc()) 
                    // {
                    //     $pempemda[]= $row["PEM_OBJEK"];
                    // }
                    // $totalpemlkpd = count($pempemda);

                    $result = $con->query("SELECT PEM_OBJEK FROM `PEMERIKSAAN` GROUP BY PEM_OBJEK");
                    while($row = $result->fetch_assoc()) 
                    {
                        $pemseluruh[]= $row["PEM_OBJEK"];
                    }
                    $totalpemeriksaan = count($pemseluruh);

                    $result = $con->query("select PEG_PENDIDIKAN, count(PEG_PENDIDIKAN) as 'jumlah' from PEGAWAI where PEG_STATUS='Aktif' and SUBSTRING_INDEX(PEG_JABATAN, ' ', 1) = 'Pemeriksa' GROUP by PEG_PENDIDIKAN order by count(PEG_PENDIDIKAN) desc limit 5");
                    while($row = $result->fetch_assoc()) 
                    {
                        $datapendidikan[]= $row;
                    }

                ?>
                     
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-carousel">
                                <div class="owl-carousel" id="owl-example">
                                    <div>                                    
                                        <div class="widget-title">Total Pegawai</div>
                                        <div class="widget-subtitle">Total Pegawai secara Keseluruhan</div>
                                        <div class="widget-int"><?php echo $totalpegawai ?></div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Total Pemeriksa</div>
                                        <div class="widget-subtitle">Pegawai</div>
                                        <div class="widget-int"><?php echo $totalpemeriksa ?></div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Total Non Pemeriksa</div>
                                        <div class="widget-subtitle">Pegawai</div>
                                        <div class="widget-int"><?php echo ($totalpegawai - $totalpemeriksa) ?></div>
                                    </div>
                                </div>                            
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                             
                            </div>         
                            <!-- END WIDGET SLIDER -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-envelope"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $totalpemda ?></div>
                                    <div class="widget-title">Entitas</div>
                                    <div class="widget-subtitle">di Sulawesi Selatan</div>
                                </div>      
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $totalpemeriksaan ?></div>
                                    <div class="widget-title">Pemeriksaan</div>
                                    <div class="widget-subtitle">di Sulawesi Selatan</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
                    </div>
                    <!-- END WIDGETS -->                    
                    
                    <div class="row">
                        <div class="col-md-8">
                            
                            <!-- START SALES BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Entitas</h3>
                                        <span>Entitas di Sulawesi Selatan</span>
                                    </div>                                     
                                    <ul class="panel-controls panel-controls-title">
                                        <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
                                    </ul>                                    
                                    
                                </div>
                                <div class="panel-body">                                    
                                    <div class="row stacked">
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
                                </div>
                            </div>
                            <!-- END SALES BLOCK -->
                            
                        </div>

                        <div class="col-md-4" >
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Pendidikan</h3>
                                        <span>Perbandingan jumlah Pendidikan pada Pemeriksa</span>
                                    </div>
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>                                      
                                    </ul>
                                </div>
                                <div class="panel-body padding-0">
                                    <div class="chart-holder" id="dashboard-donut-1" style="min-height: 213px;"></div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>

                        <div class="col-md-4">
                            
                            <!-- START USERS ACTIVITY BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Pemeriksaan</h3>
                                        <span>Jumlah Pemeriksaan per Tahun</span>
                                    </div>                                    
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    </ul>                                    
                                </div>                                
                                <div class="panel-body padding-0">
                                    <div class="chart-holder" id="dashboard-bar-1" style="min-height: 200px;"></div>
                                </div>                                    
                            </div>
                            <!-- END USERS ACTIVITY BLOCK -->
                            
                        </div>



                        <div class="col-md-4">
                            
                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Projects</h3>
                                        <span>Projects activity</span>
                                    </div>                                    
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body panel-body-table">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Project</th>
                                                    <th width="20%">Status</th>
                                                    <th width="30%">Activity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Atlant</strong></td>
                                                    <td><span class="label label-danger">Developing</span></td>
                                                    <td>
                                                        <div class="progress progress-small progress-striped active">
                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gemini</strong></td>
                                                    <td><span class="label label-warning">Updating</span></td>
                                                    <td>
                                                        <div class="progress progress-small progress-striped active">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td><strong>Taurus</strong></td>
                                                    <td><span class="label label-warning">Updating</span></td>
                                                    <td>
                                                        <div class="progress progress-small progress-striped active">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Leo</strong></td>
                                                    <td><span class="label label-success">Support</span></td>
                                                    <td>
                                                        <div class="progress progress-small progress-striped active">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Virgo</strong></td>
                                                    <td><span class="label label-success">Support</span></td>
                                                    <td>
                                                        <div class="progress progress-small progress-striped active">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                                <tr>
                                                    <td><strong>Aquarius</strong></td>
                                                    <td><span class="label label-success">Support</span></td>
                                                    <td>
                                                        <div class="progress progress-small progress-striped active">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->
                            
                        </div>

                        <div class="col-md-4">
                            
                            <!-- START SALES & EVENTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Sales & Event</h3>
                                        <span>Event "Purchase Button"</span>
                                    </div>
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-0">
                                    <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
                                </div>
                            </div>
                            <!-- END SALES & EVENTS BLOCK -->
                            
                        </div>
                    </div>
                    
                    <!-- START DASHBOARD CHART -->
                    <div class="block-full-width">
                        <div id="dashboard-chart" style="height: 250px; width: 100%; float: left;"></div>
                        <div class="chart-legend">
                            <div id="dashboard-legend"></div>
                        </div>                                                
                    </div>                    
                    <!-- END DASHBOARD CHART -->
                    
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

                /* Donut dashboard chart */
                Morris.Donut({
                    element: 'dashboard-donut-1',
                    data: [
                        <?php 
                            $in=0;
                            foreach($datapendidikan as $key => $value)
                            {
                                if($in<4)
                                {
                                    echo '{label: "' . $value['PEG_PENDIDIKAN'] . '", value: ' . $value['jumlah'] . '},';
                                }
                                else
                                {
                                    echo '{label: "' . $value['PEG_PENDIDIKAN'] . '", value: ' . $value['jumlah'] . '}';
                                }
                                $in++;
                            }
                        ?>
                    ],
                    colors: ['#33414E', '#3FBAE4', '#FEA223', '#B64645', '#95B75D'],
                    resize: true
                });
                /* END Donut dashboard chart */

                /* Bar dashboard chart */
                Morris.Bar({
                    element: 'dashboard-bar-1',
                    data: [
                        <?php
                            $tahunsekarang=date("Y");
                            $in=0;
                            for($i=($tahunsekarang-4); $i<=$tahunsekarang; $i++)
                            {
                                unset($hitung);
                                $jumlah = 0;
                                $result = $con->query("select count(*) as 'jumlah' from pemeriksaan where PEM_TAHUN ='" . $i . "'");
                                while($row = $result->fetch_assoc()) 
                                {
                                    $jumlah=$row['jumlah'];
                                }   

                                if($in<4)
                                {
                                    echo "{ y: " . $i . ", a: " . $jumlah . " },";
                                }
                                else
                                {
                                    echo "{ y: " . $i . ", a: " . $jumlah . " }";
                                }
                            }
                        ?>
                    ],
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Pemeriksaan'],
                    barColors: ['#33414E'],
                    gridTextSize: '10px',
                    hideHover: true,
                    resize: true,
                    gridLineColor: '#E5E5E5'
                });
                /* END Bar dashboard chart */
            }

            var geojsonFeature = {
                "type": "Feature",
                "properties": {
                    "name": "Coors Field",
                    "amenity": "Baseball Stadium",
                    "popupContent": "This is where the Rockies play!"
                },
                "geometry": {
                    "type": "Point",
                    "coordinates": [-104.99404, 39.75621]
                }
            };

            function loadmap()
            {
                const map = L.map('petasulsel').setView([-4.2020144,119.8209562], 7);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);


               const geojsonFiles = [
                    { file: 'gjsonsulsel/7301.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7302.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7303.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7304.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7305.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7306.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7307.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7308.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7309.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7310.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7311.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7312.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7313.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7314.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7315.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7316.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7317.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7318.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7319.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7322.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7325.geojson', name: 'Area 7303' },
                    { file: 'gjsonsulsel/7371.geojson', name: 'Area 7302' },
                    { file: 'gjsonsulsel/7373.geojson', name: 'Area 7303' }
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

                

            }

            function chartpendidikan()
            {

            }
            
            
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>