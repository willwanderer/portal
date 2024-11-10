
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            @session_start();
        ?>
        <!-- META SECTION -->
        <title>Portal - Aplikasi BPK Perwakilan Sulawesi Selatan</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- END META SECTION -->
        <link rel="icon" href="img/logo/SS3Logo.ico" type="image/x-icon" />
        
        <link rel="stylesheet" type="text/css" href="portal/css/styles.css" media="screen" />
        
    </head>
    <body>
        <!-- page container -->
        <div class="page-container">
            
            <!-- page header -->
            <div class="page-header">
                
                <!-- page header holder -->
                <div class="page-header-holder">
                    
                    <!-- page logo -->
                    <div class="logo">
                        <img src="img/logo/Portal.png" width="150px">
                    </div>
                    <!-- ./page logo -->

                    <!-- nav mobile bars -->
                    <div class="navigation-toggle">
                        <div class="navigation-toggle-button"><span class="fa fa-bars"></span></div>
                    </div>
                    <!-- ./nav mobile bars -->
                    
                    <!-- navigation -->
                    <ul class="navigation">
                        <li>
                            <a href="#">Beranda</a>
                        </li>
                        <li>
                            <a href="#">BPK Sulsel</a>
                        </li>
                        <!-- <li>
                            <a href="#">Blog</a>
                            <ul>
                                <li><a href="blog-grid.html">Blog Grid</a></li>
                                <li><a href="blog-post.html">Blog Post</a></li>                                
                            </ul>
                        </li> -->
                        <li>
                            <?php 
                                if(!isset($_SESSION['portalnama']) || $_SESSION['portalnama'] =="")
                                {
                                    ?> <a href="login.php">Login Aplikasi</a> <?php
                                }
                                else
                                {
                                    ?>
                                        <a href="#"><?php echo $_SESSION['portalnama']; ?></a>
                                        <ul>
                                            <li><a href="portfolio-with-title.html">Halaman Profil</a></li>
                                            <li><a href="#" onclick="cekkeluar()">Keluar Aplikasi</a></li>
                                        </ul>
                                    <?php
                                }
                                
                            ?>
                            
                        </li>
                    </ul>
                    <!-- ./navigation -->                        

                    
                </div>
                <!-- ./page header holder -->
                
            </div>
            <!-- ./page header -->
            
            <!-- page content -->
            <div class="page-content">
                
                
                
                                    

                <!-- page content wrapper -->
                <div class="page-content-wrap bg-img-1">

                    <div class="divider"><div class="box"><span class="fa fa-angle-down"></span></div></div>                    
                    
                    <!-- page content holder -->
                    <div class="page-content-holder">
                        
                        <div class="row">
                            <div class="col-md-4">                                
                                <div class="text-column text-column-centralized tex-column-icon-lg this-animate" data-animate="fadeInLeft" style="cursor: pointer;">
                                    <div class="text-column-icon">
                                        <img src="img/logo/ASTI-2.png" height="100px">
                                    </div>
                                    <h4>Asti</h4>
                                    <div class="text-column-info">
                                        Aplikasi <strong>ASTI</strong> adalah Aplikasi Penyusunan Tim yang digunakan untuk membantu Pemberi Tugas dalam melakukan Penyusunan Tim Pemeriksaan.
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="col-md-4">                                
                                <div class="text-column text-column-centralized tex-column-icon-lg this-animate" data-animate="fadeInUp" style="cursor: pointer;" onclick="menujuaplikasi('bankdata/index.php')">
                                    <div class="text-column-icon">
                                        <img src="img/logo/BankData1.png" height="100px">
                                    </div>
                                    <h4>Bank Data</h4>
                                    <div class="text-column-info">
                                        Aplikasi Bank Data digunakan sebagai penyimpanan Data baik data Entitas sampai data Pemeriksa.
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="col-md-4">                                
                                <div class="text-column text-column-centralized tex-column-icon-lg this-animate" data-animate="fadeInRight" style="cursor: pointer;" onclick="menujuaplikasi('pengingattugas/index.php')">
                                    <div class="text-column-icon">
                                        <img src="img/logo/PengingatTugas2.png" height="100px">
                                    </div>
                                    <h4>Pengingat Tugas</h4>
                                    <div class="text-column-info">
                                        Aplikasi yang dapat membantu Pegawai BPK Sulsel dalam memonitoring penyelesaian Tugas berserta Progres pengerjaanya</strong>.
                                    </div>
                                </div>                                
                            </div>

                            <div class="col-md-4">                                
                                <div class="text-column text-column-centralized tex-column-icon-lg this-animate" data-animate="fadeInRight" style="cursor: pointer;" onclick="menujuaplikasi('cintatepe/index.php')">
                                    <div class="text-column-icon">
                                        <img src="img/logo/cintatepe.png" height="100px">
                                    </div>
                                    <h4>Cinta TEPE</h4>
                                    <div class="text-column-info">
                                        Aplikasi Backup dari Aplikasi Sahabat TEPE</strong>.
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        
                        <br><br><br><br><br><br><br><br><br><br><br>
                        
                    </div>
                    <!-- ./page content holder -->
                </div>
                <!-- ./page content wrapper -->                
                
            </div>
            <!-- ./page content -->
            





            
        </div>        
        <!-- ./page container -->
        
        <!-- page scripts -->
        <script type="text/javascript" src="portal/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="portal/js/plugins/bootstrap/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="portal/js/plugins/mixitup/jquery.mixitup.js"></script>
        <script type="text/javascript" src="portal/js/plugins/appear/jquery.appear.js"></script>
        
        <script type="text/javascript" src="portal/js/actions.js"></script>                

        <script src="js/sweetalert2/package/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="js/sweetalert2/package/dist/sweetalert2.min.css">

        <script type="text/javascript">
            function cekkeluar()
            {
                swal.fire({
                    title: "Anda Yakin?",
                    text: "Apakah Anda Ingin Keluar dari Aplikasi?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    closeOnConfirm: false
                }).then((hasil) =>
                {
                    if(hasil.isConfirmed)
                    {
                        window.location = "logout.php";
                    }
                });
            }

            function menujuaplikasi(halaman)
            {
                swal.fire({
                    title: "Anda Yakin?",
                    text: "Apakah Anda Ingin Berpindah ke Aplikasi lain?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    closeOnConfirm: false
                }).then((hasil) =>
                {
                    if(hasil.isConfirmed)
                    {
                        window.open(halaman, '_blank');
                    }
                });
                
            }
        </script>   
        <!-- ./page scripts -->
    </body>
</html>