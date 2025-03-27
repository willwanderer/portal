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
            <div class="page-content" id="divinduk">
                
                <?php include ("menuatas.php");?>                     

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a class="active">Pembaharuan Data Entitas</a></li>
                </ul>
                <!-- END BREADCRUMB -->    

                <div class="col-md-2 pull-right" style="margin-right: 4px; margin-bottom: 10px;">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <select class="form-control" id="txttahunpde" name="txttahunpde" onchange="isidataentitas()"></select> 
                    </div>
                </div>
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <p>Gunakan untuk mencari entitas menggunakan Nama.</p>
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <span class="fa fa-search"></span>
                                                            </div>
                                                            <input id="txtpencarian" type="text" class="form-control" placeholder="Entitas yang anda cari?" onkeyup="carientitas()" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>                                    
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div id="isibox"></div>
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
                isidatatahunpde();
                // alert();
            }

            function tampilbox(data)
            {
                data.forEach(data => {
                    const dataHtml = `
                        <div class="col-md-2 kartuentitas" >
                            <div class="panel panel-default">
                                <div class="panel-body profile bg-default" style="min-height: 190px;">
                                    <div class="profile-data">
                                        <img id="imgfotoprofil" src="${data.ENT_LOGO}" style="object-fit: cover; object-position: center; cursor: pointer;" height="100px"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">${data.ENT_NAMA}</div>
                                    </div>
                                </div> 
                                <div class="panel-footer"> 
                                    <div class="progress-list">                                           
                                        <div class="pull-right">75%</div>                                                
                                        <div class="progress progress-small active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">75%</div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-block" onclick="tampildetailpde('${data.ENT_ID}')">Pembaharuan Data</button>
                                </div>                           
                            </div>
                        </div>
                    `;
                    $('#isibox').append(dataHtml);
                    $('#divinduk').css('height', 'auto');
                });
            }

            function tampiltahunpde(data)
            {
                data.forEach(data => {
                    $('#txttahunpde').append($('<option>', {
                        value: data.VALUETAHUN,
                        text: data.TAHUN
                    }));
                });
                $('#txttahunpde').val('<?php if(isset($_SESSION['tahunpde'])){ echo $_SESSION['tahunpde'];} else { echo ""; } ?>');
                isidataentitas();
            }

            function isidataentitas()
            {
                swal.fire(
                {
                    title:"Menyimpan Data",
                    text: "Menunggu Untuk menyimpan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });
                $('#isibox').empty();
                var tahunpde = $("#txttahunpde").val();
                $.ajax({
                    type: "POST", 
                    url : "modul/pde/tampilentitas.php", 
                    data: "tahunpde=" + tahunpde,
                    dataType: "json",
                    success: function(data)
                    {
                        tampilbox(data);
                    }       
                });
                swal.close();
            }

            function isidatatahunpde()
            {
                swal.fire(
                {
                    title:"Menyimpan Data",
                    text: "Menunggu Untuk menyimpan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });

                $.ajax({
                    type: "POST", 
                    url : "modul/pde/tampiltahunpde.php", 
                    data: "",
                    dataType: "json",
                    success: function(data)
                    {
                        tampiltahunpde(data);
                    }       
                });
                swal.close();
            }

            function tampildetailpde(id)
            {
                window.location="trndetailpde.php?entid="+id+"&tahun="+$('#txttahunpde').val();
            }

            function carientitas()
            {
                var input = document.getElementById("txtpencarian");
                var filter = input.value.toLowerCase();
                var nodes = document.getElementsByClassName('kartuentitas');

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