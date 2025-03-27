<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php"); 
        ?>
    </head>
    <body onload="kondisiload()">
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <?php include("menusamping.php");?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <?php include ("menuatas.php");?>                     

                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-users"></span> Bezetting Pegawai</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
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
                                        <div class="widget-subtitle">Pegawai Aktif</div>
                                        <div class="widget-int" id="txttotalpegawai">0</div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Total Pegawai</div>                                                                        
                                        <div class="widget-subtitle">Pegawai Pemeriksa</div>
                                        <div class="widget-int" id="txttotalpemeriksa">0</div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Total Pegawai</div>                                                                        
                                        <div class="widget-subtitle">Pegawai Non Pemeriksa</div>
                                        <div class="widget-int" id="txttotalnonpemeriksa">0</div>
                                    </div>
                                </div>                                                        
                            </div>         
                            <!-- END WIDGET SLIDER -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-envelope"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count">0</div>
                                    <div class="widget-title">New messages</div>
                                    <div class="widget-subtitle">In your mailbox</div>
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
                                    <div class="widget-int num-count">0</div>
                                    <div class="widget-title">Registred users</div>
                                    <div class="widget-subtitle">On your website</div>
                                </div>                          
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>

                        <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-danger widget-item-icon" onclick="location.href='pages-address-book.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-table"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count" id="txtdatatidaklengkap">0</div>
                                    <div class="widget-title">Data Pegawai</div>
                                    <div class="widget-subtitle">Jumlah Data Pegawai dengan Data Tidak Lengkap</div>
                                </div>                          
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                    </div>
                    <!-- END WIDGETS -->  
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Gunakan untuk mencari pegawai menggunakan Nama, NIP, atau email.</p>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-search"></span>
                                                    </div>
                                                    <input id="txtpencarian" type="text" class="form-control" placeholder="Siapakah yang anda cari?" onkeyup="caripegawai()" />
                                                    <!-- <div class="input-group-btn">
                                                        <button class="btn btn-primary">Cari</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-success btn-block"><span class="fa fa-plus"></span> Tambah Pegawai</button>
                                            </div>
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <?php
                            $kuery="SELECT p.*, u.UO_NAMA as 'PEG_UNIT_ORGANISASI' FROM PEGAWAI p, UNIT_ORGANISASI u where p.UO_ID=u.UO_ID and p.PEG_STATUS='Aktif' order by p.PEG_NIP_BARU";
                            $result = $con->query($kuery);
                            while($row = $result->fetch_assoc()) 
                            {   
                                
                                ?>
                                    <div class="col-md-3 kartupegawai">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default" style="height: 370px;">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img style="object-fit: cover; object-position: center;" src="<?php echo aturprofil($row['PEG_FOTO'], $row['PEG_JENIS_KELAMIN']) ?>"  height="100px" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name"><?php echo $row["PEG_NAMA"]?></div>
                                                    <div class="profile-data-title"><?php echo $row["PEG_JABATAN"];?></div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="mstdetailpegawai.php?nip=<?php echo $row["PEG_NIP_LAMA"] ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                                                    <a href="#" class="profile-control-right"><span class="fa fa-comments"></span></a>
                                                </div>
                                            </div>                                
                                            <div class="panel-body">                                    
                                                <div class="contact-info">
                                                    <p><small>Nama</small><br/><?php echo $row["PEG_GELAR_DEPAN"] . " " . $row["PEG_NAMA"] . " " . $row["PEG_GELAR_BELAKANG"];?></p>
                                                    <p><small>NIP</small><br/><?php echo $row["PEG_NIP_BARU"];?>/<?php echo $row["PEG_NIP_LAMA"];?></p>
                                                    <p><small>Unit Kerja</small><br/><?php echo $row["PEG_UNIT_ORGANISASI"];?></p>
                                                    <p><small>Golongan/Pangkat</small><br/>
                                                        <?php echo $row["PEG_PANGKAT"];?> (<?php echo $row["PEG_GOLONGAN"];?>)
                                                    </p>                                   
                                                </div>
                                            </div>                                
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                <?php
                            }
                        ?>

                        

                    </div>
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                               
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <?php include("audiojs.php"); ?>

        <script type="text/javascript">
            function kondisiload() {
                tampilpegawai();
            }

            function tampilpegawai() {
                
            }

            function tampilinformasi() {

            }

            function caripegawai()
            {
                var input = document.getElementById("txtpencarian");
                var filter = input.value.toLowerCase();
                var nodes = document.getElementsByClassName('kartupegawai');

                for (let i = 0; i < nodes.length; i++) {
                    if (nodes[i].innerText.toLowerCase().includes(filter)) {
                        nodes[i].style.display = "block";
                    } 
                    else {
                        nodes[i].style.display = "none";
                    }
                }
            }

        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>