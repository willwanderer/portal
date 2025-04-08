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
                    $totalpemeriksa = 0;
                    $totalpegawai = 0;
                    $totalpemda = 0;
                    $totalentitas = 0;
                    $totalpemlkpd = 0;
                    $totalpemeriksaan = 0;
                    $totaltimterbentuk = 0;
                    $totaltimkeseluruhan = 0;
                    $totalpria = 0;
                    $totalwanita = 0;

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

                    $result = $con->query("SELECT count(*) as 'jumlahc' from entitas where SUBSTRING_INDEX(ENT_NAMA, ' ', 1) = 'Kabupaten' or SUBSTRING_INDEX(ENT_NAMA, ' ', 1) = 'Kota' or SUBSTRING_INDEX(ENT_NAMA, ' ', 1) = 'Provinsi'");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalpemda=$row["jumlahc"];
                    }

                    $result = $con->query("SELECT count(*) as 'jumlahc' FROM `ENTITAS`");
                    while($row = $result->fetch_assoc()) 
                    {
                        $totalentitas=$row["jumlahc"];
                    }

                    $result = $con->query("SELECT PEM_OBJEK FROM `PEMERIKSAAN` where PEM_JENIS='Pemeriksaan Laporan Keuangan' GROUP BY PEM_OBJEK");
                    while($row = $result->fetch_assoc()) 
                    {
                        $pempemda[]= $row["PEM_OBJEK"];
                    }
                    
                    if(isset($pempemda))
                    {
                        $totalpemlkpd = count($pempemda);
                    }

                    $result = $con->query("SELECT PEM_OBJEK FROM `PEMERIKSAAN` GROUP BY PEM_OBJEK");
                    while($row = $result->fetch_assoc()) 
                    {
                        $pemseluruh[]= $row["PEM_OBJEK"];
                    }
                    
                    if(isset($pemseluruh))
                    {
                        $totalpemeriksaan = count($pemseluruh);
                    }

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
                                    <div class="widget-subtitle">di Sulawesi Selatan Sejak Tahun 2015</div>
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
                                            <div id="details">
                                                <img class="location-logo" src="" alt="Logo" style="display:none;" />
                                                <div class="location-title">Pilih lokasi untuk melihat detail</div>
                                                <div class="location-description"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="petasulsel" style="width: 100%; height: 460px"></div>
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
                            for($i=($tahunsekarang-4); $i<=$tahunsekarang; $i++)
                            {
                                $jumlah = 0;
                                $result = $con->query("select count(*) as 'jumlah' from pemeriksaan where PEM_TAHUN ='" . $i . "'");
                                while($row = $result->fetch_assoc()) 
                                {
                                    $jumlah=$row['jumlah'];
                                }
                                echo "{ y: " . $i . ", a: " . $jumlah . "},";
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

            function loadmap()
            {
                const map = L.map('petasulsel').setView([-4.2020144,119.8209562], 7);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: ''
                }).addTo(map);

                // Koordinat untuk beberapa titik di Kota Makassar
                const locations = [
                    { 
                        name: "Pantai Losari", 
                        coords: [-5.134, 119.417], 
                        description: "Pantai terkenal di Makassar.", 
                        iconUrl: 'https://example.com/path/to/logo1.png' // Ganti dengan URL gambar logo Pantai Losari
                    },
                    { 
                        name: "Fort Rotterdam", 
                        coords: [-5.134, 119.426], 
                        description: "Benteng bersejarah yang dibangun oleh Belanda.", 
                        iconUrl: 'https://example.com/path/to/logo2.png' // Ganti dengan URL gambar logo Fort Rotterdam
                    },
                    { 
                        name: "Trans Studio Makassar", 
                        coords: [-5.139, 119.426], 
                        description: "Taman hiburan indoor terbesar di Indonesia.", 
                        iconUrl: 'https://example.com/path/to/logo3.png' // Ganti dengan URL gambar logo Trans Studio
                    },
                    { 
                        name: "Mall Panakkukang", 
                        coords: [-5.136, 119.426], 
                        description: "Salah satu pusat perbelanjaan terbesar di Makassar.", 
                        iconUrl: 'https://example.com/path/to/logo4.png' // Ganti dengan URL gambar logo Mall Panakkukang
                    },
                    { 
                        name: "Universitas Hasanuddin", 
                        coords: [-5.134, 119.432], 
                        description: "Universitas terkemuka di Sulawesi.", 
                        iconUrl: 'https://example.com/path/to/logo5.png' // Ganti dengan URL gambar logo Universitas Hasanuddin
                    }
                ];

                // Menambahkan marker untuk setiap lokasi
                locations.forEach(location => {
                    const customIcon = L.icon({
                        iconUrl: location.iconUrl, // Menggunakan URL gambar logo dari lokasi
                        iconSize: [32, 32], // Ukuran ikon
                        iconAnchor: [16, 32], // Titik jangkar ikon
                        popupAnchor: [0, -32] // Titik jangkar popup
                    });

                    const marker = L.marker(location.coords, { icon: customIcon })
                        .addTo(map)
                        .bindPopup(location.name); // Menambahkan popup dengan nama lokasi

                    // Menambahkan event listener untuk marker
                    marker.on('click', function() {
                        // Menampilkan detail lokasi di div sebelah peta
                        document.querySelector('.location-title').innerText = location.name;
                        document.querySelector('.location-description').innerText = location.description;
                        const logoImage = document.querySelector('.location-logo');
                        logoImage.src = location.iconUrl; // Mengatur src gambar logo
                        logoImage.style.display = 'block';
                    });
                });
            }

            function chartpendidikan()
            {

            }
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>