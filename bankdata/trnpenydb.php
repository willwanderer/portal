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
                    <li class="active">Penyelarasan Database</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"><i class="fa fa-cloud-download"></i></a> Penyelarasan Database</h3>
                                </div>
                                <div class="panel-body">
                                   
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