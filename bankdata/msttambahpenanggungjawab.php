<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php"); 
              
        ?>
    </head>
    <body onload="kondisiload()">

        <form class="form-horizontal" id="formkirim">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Tambah</strong> Daftar Penanggung Jawab (LO)</h3>
                </div>
                <div class="panel-body">      

                    <div class="row" align="center">
                        <div class="col-md-5 col-xs-5" id="divtampildetail" style="display: none;">

                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int" style="margin-bottom: 7px;">
                                    <img class="fotoprofile" id="imgfotoprofilpeg" style="object-fit: cover; object-position: center;"  height="100px" />
                                </div>                            
                                <div class="widget-subtitle" id="divnamatampil" style="margin-bottom: 0px; font-weight: bold"></div>
                                <div class="widget-subtitle" id="divunittampil"></div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right" onclick="tutupdetail()"><span class="fa fa-times"></span></a>
                                </div>                                                        
                            </div>                        

                        </div>                           
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Pegawai</label>
                        <div class="col-md-6 col-xs-12">
                            <select id="txtnippemeriksa" name="txtnippemeriksa" class="form-control select" onchange="tampildetail()" data-live-search="true">
                                <option value="">--- Pilih Pemeriksa ---</option>
                                <?php
                                    $kuery="SELECT p.*, u.UO_NAMA as 'PEG_UNIT_ORGANISASI' FROM PEGAWAI p, UNIT_ORGANISASI u where p.UO_ID=u.UO_ID and p.PEG_STATUS='Aktif' order by p.PEG_NIP_BARU";
                                    $result = $con->query($kuery);
                                    while($row = $result->fetch_assoc()) 
                                    {
                                        ?>
                                        
                                            <option value="<?php echo $row['PEG_NIP_LAMA'] ?>"><?php echo $row['PEG_GELAR_DEPAN'] ." ". $row['PEG_NAMA'] . " " .  $row['PEG_GELAR_BELAKANG']?></option>
                                        
                                        <?php
                                    }
                                ?>      
                            </select>                                      
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Bidang Penanggungjawab</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <input type="text" class="form-control" id="txtnamatanggungjawab" name="txtnamatanggungjawab" />
                        </div>
                    </div>
                    
                    <div class="form-group">                                        
                        <label class="col-md-3 col-xs-12 control-label">Waktu Tugas</label>
                        <div class="col-md-6 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input type="text" class="form-control datepicker" id="txttanggalawal" name="txttanggalawal" onchange="aturakhir()">                                            
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input type="text" class="form-control datepicker" id="txttanggalakhir" name="txttanggalakhir">                                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Detail Tugas</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <textarea class="form-control" rows="5" id="txtdetailtugas" name="txtdetailtugas"></textarea>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button class="btn btn-default">Kosongkan Form</button>                                    
                    <button class="btn btn-primary pull-right" onclick="simpandata()">Simpan</button>
                </div>
            </div>
            </form>

        <?php include("audiojs.php"); ?>

        <script type="text/javascript">
            function kondisiload()
            {

            }   

            function aturakhir()
            {
                
                $("#txttanggalakhir").datepicker({
                    minDate: new Date($("#txttanggalawal").datepicker("getDate"))
                });

                //$("#txttanggalakhir").datepicker("option","minDate",$("#txttanggalawal").datepicker("getDate"));
            }

            function tampildetail()
            {
                if($('#txtnippemeriksa').val()=="")
                {
                    $('#divtampildetail').css("display","none");
                }
                else
                {                
                    var kirimdata= {};
                    kirimdata.nip = $('#txtnippemeriksa').val();
                    kirimdata.kembali = "tampildetailpegawai";
                    $.ajax(
                    {
                        type:"POST",
                        url:"modul/master/kembalisatuan.php",    
                        data: kirimdata,
                        dataType: "json",
                        success: function(data)
                        {
                            $('#divnamatampil').html($('#txtnippemeriksa option:selected').text());
                            $('#divunittampil').html(data.unit);
                            $("#imgfotoprofilpeg").attr("src", data.foto);
                            $('#divtampildetail').css("display","inline");    
                            $('#divtampildetail').delay(5000).fadeOut(300);
                        }
                    });
                }                
            } 

            function tutupdetail()
            {
                $('#divtampildetail').css("display","none"); 
            } 

            function simpandata()
            {
                event.preventDefault();
                swal.fire(
                {
                    title:"Menyimpan Data",
                    text: "Menunggu Untuk menyimpan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });

                var myform = document.getElementById('formkirim');
                var fd=new FormData(myform);
                $.ajax(
                {
                    type:"POST",
                    url:"modul/master/simpanpenanggungjawab.php",    
                    data: fd,
                    contentType: false,
                    cache: false,
                    processData:false,  
                    success: function(data)
                    {
                        if(data==0)
                        {
                            swal.fire(
                            {
                                title: "Berhasil",
                                text: "Data Berhasil di Simpan!!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "Lanjutkan",
                                closeOnConfirm: false
                            }).then((isConfirm) =>
                            {
                                window.parent.location.reload();
                            }); 
                        }
                        else
                        {
                            swal.fire("Gagal","Data gagal Di Simpan. Error : " +data,"error");
                        }
                    }
                });
            }
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>