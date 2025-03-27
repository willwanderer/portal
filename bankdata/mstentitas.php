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
                    <li class="active">Master Entitas</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"><i class="fa fa-university"></i></a> Data Entitas</h3>
                                    <!-- <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul> -->                                
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Entitas</th>
                                                <th>Wilayah Supervisi</th>
                                                <th>Luas (km<sup>2</sup>)</th>
                                                <th>Opini</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $kuery="SELECT e.ENT_ID, e.ENT_NAMA, e.ENT_LUAS_WILAYAH, u.UO_NAMA as 'WILAYAH_SUPERVISI' FROM ENTITAS e, UNIT_ORGANISASI u where e.UO_ID=u.UO_ID";
                                                $result = $con->query($kuery);
                                                while($row = $result->fetch_assoc()) 
                                                {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row["ENT_NAMA"];?></td>
                                                            <td><?php echo $row["WILAYAH_SUPERVISI"];?></td>
                                                            <td align="right"><?php echo number_format($row["ENT_LUAS_WILAYAH"],2,',','.');?></td>
                                                            <td>
                                                                <?php
                                                                    $result1 = $con->query("select * from (SELECT * FROM `OPINI` where ENT_ID='" . $row['ENT_ID'] . "' order by OP_TAHUN_PEMERIKSAAN desc limit 3) t order by OP_TAHUN_PEMERIKSAAN asc");
                                                                    while($row1 = $result1->fetch_assoc()) 
                                                                    {
                                                                        ?>
                                                                        <span class="badge badge-pill" style="background-color: 
                                                                            <?php
                                                                                if(preg_replace('~\S\K\S*\s*~u', '', $row1['OP_OPINI'])=="WTP")
                                                                                {
                                                                                    echo "#28A745";
                                                                                }
                                                                                else if(preg_replace('~\S\K\S*\s*~u', '', $row1['OP_OPINI'])=="WDP")
                                                                                {
                                                                                    echo "#FFC107";
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo "#DC3545";
                                                                                }
                                                                            ?>" data-toggle="tooltip" data-placement="top" title="TA <?php echo $row1['OP_TAHUN_PEMERIKSAAN']; ?>"><?php echo preg_replace('~\S\K\S*\s*~u', '', $row1['OP_OPINI']);;?></span>   
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td ><a class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Detail Entitas" href="mstdetailentitas.php?entid=<?php echo $row["ENT_ID"]; ?>">Detail</a></td>
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


            
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>