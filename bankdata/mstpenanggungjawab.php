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

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Master</a></li>
                    <li class="active">Daftar Penanggung Jawab (LO)</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"><i class="fa fa-tag"></i></a> Daftar Penanggung Jawab (LO)</h3>
                                    <ul class="panel-controls">
                                        <!-- <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li> -->
                                        <li><a href="#" class="panel-add" data-toggle="tooltip" data-placement="left" title="Tambah Data Penanggung Jawab (LO)" onclick="tambahpenanggungjawab()"><span class="fa fa-plus"></span></a></li>
                                    </ul>                               
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Nama Pegawai</th>
                                                <th>Bidang Penanggung Jawab</th>
                                                <th>Tanggal Menjabat</th>
                                                <th>Detail Tugas</th>
                                                <th>Status</th>
                                                <th width= "150px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $kuery="SELECT p.*, k.PEG_NAMA from pembagian_lo p, pegawai k WHERE k.PEG_NIP_LAMA = p.PEG_NIP_LAMA";
                                                $result = $con->query($kuery);
                                                while($row = $result->fetch_assoc()) 
                                                {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row["PEG_NAMA"];?></td>
                                                            <td><?php echo $row["PLO_NAMA"];?></td>
                                                            <td><?php echo date('d M Y',strtotime($row["PLO_AWAL_MENJABAT"]));?></td>
                                                            <td><?php echo $row["PLO_DETAIL_TUGAS"];?></td>
                                                            <td><?php echo $row["PLO_STATUS"];?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Ubah Penanggung Jawab" onclick="ubahpenanggungjawab('<?php echo $row["PLO_ID"]; ?>')"><i class="fa fa-pencil"></i></button>
                                                                    <button class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Hubungi Penanggung Jawab" onclick="hubungipenanggungjawab('<?php echo $row["PLO_ID"]; ?>')"><i class="fa fa-comments"></i></button>
                                                                    <button class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Profil Penanggung Jawab" onclick="profilpenanggungjawab('<?php echo $row["PLO_ID"]; ?>')"><i class="fa fa-user"></i></button>
                                                                    <?php
                                                                        if($row["PLO_STATUS"] == "Aktif")
                                                                        {
                                                                            ?>
                                                                                <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Nonaktifkan Penanggung Jawab" onclick="ubahstatuspenanggungjawab('<?php echo $row["PLO_ID"]; ?>','Tidak Aktif')"><i class="fa fa-ban"></i></button>
                                                                            <?php 
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                                <button class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Aktifkan Penanggung Jawab" onclick="ubahstatuspenanggungjawab('<?php echo $row["PLO_ID"]; ?>','Aktif')"><i class="fa fa-check"></i></button>
                                                                            <?php 
                                                                        }
                                                                    ?>                                 
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->

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

            function tambahpenanggungjawab()
            {
                $.fancybox.open(
                {
                    fitToView   : false,
                    height      : '95%',
                    width       : '50%',
                    autoSize    : false,
                    href        : 'msttambahpenanggungjawab.php',
                    type        : 'iframe',
                    padding     : 10
                });
            }
            
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>