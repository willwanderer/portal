<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php"); 

            $jumlahpegawai = 0;

            $result = $con->query("SELECT count(*) as 'jumlahc' FROM `PEGAWAI` where PEG_STATUS='Aktif' and SUBSTRING_INDEX(PEG_JABATAN, ' ', 1) = 'Pemeriksa'");
            while($row = $result->fetch_assoc()) 
            {
                $jumlahpegawai=$row["jumlahc"];
            }

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
                    <h2><span class="fa fa-users"></span> Mutasi Pegawai <small><?php echo$jumlahpegawai ?> Pegawai Aktif di BPK Perwakilan Sulawesi Selatan</small></h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
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
                    
                    <div id="divisi" class="row">
                        
                    </div>
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                               
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <?php include("audiojs.php"); ?>

        <script type="text/javascript">
            
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