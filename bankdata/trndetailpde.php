<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php"); 

            $jumlahpemeriksaan =0;

            $result = $con->query("SELECT e.*, u.UO_NAMA as 'WILAYAH_SUPERVISI' FROM ENTITAS e, UNIT_ORGANISASI u where e.UO_ID=u.UO_ID and ENT_ID='".$_GET['entid']."'");
            while($row = $result->fetch_assoc()) 
            {
                $dataent[]=$row;
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

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Pembaharuan Data Entitas</a></li>
                    <li class="active"><a href="mstdetailentitas.php?entid=<?php echo $_GET['entid'] ?>"><?php echo $dataent[0]["ENT_NAMA"]?></a></li>
                </ul>
                <!-- END BREADCRUMB -->                

                <div class="col-md-2 pull-right" style="margin-right: 4px; margin-bottom: 10px;">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                        <select class="form-control" id="txttahunpde" name="txttahunpde" onchange="gantitahunpde()"></select>
                    </div>
                </div>
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <div class="panel panel-default">
                                <div class="panel-body profile" style="background: url('../img/bcg-profile.jpg') top center no-repeat;">
                                    <div class="" align="center">
                                        <form id="frmfotoprofil">
                                            <label for="txtfotoprofil">
                                            <img id="imgfotoprofil" src="<?php echo aturlogoentitas($dataent[0]['ENT_LOGO']); ?>" style="object-fit: cover; object-position: center; cursor: pointer;" height="100px" data-toggle="tooltip" data-placement="top" title="Pilih untuk merubah Foto Profil" onclick=""/></label>
                                            <input id="txtfotoprofil" name="txtfotoprofil" type="file" style="display:none" onchange="gantifotoprofil()" />
                                            <input type="text" name="txtentid" id="txtentid" value="<?php echo $_GET['entid'] ?>" style="display:none" >
                                        </form>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><?php echo $dataent[0]["ENT_NAMA"]?></div>
                                        <div class="profile-data-title" style="color: #FFF;"><?php echo $dataent[0]["WILAYAH_SUPERVISI"];?></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a id="btnsimpanfoto" href="#" class="profile-control-left" style="display:none;" onclick="simpanfoto()"><span class="fa fa-save"></span></a>
                                        <!-- <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a> -->
                                    </div>
                                </div>                                
                                <div class="panel-body list-group border-bottom">
                                    <a id="tabprofilentitas" class="list-group-item active" onclick="pindahtab('profilentitas')" style="cursor:pointer;"><span class="fa fa-university"></span> Profil Entitas</a>
                                    <a id="tabdaftarskpdkecamatan" class="list-group-item" onclick="pindahtab('daftarskpdkecamatan')" style="cursor:pointer;"><span class="fa fa-sitemap"></span> SKPD dan Kecamatan<span class="badge badge-success"><?php echo $jumlahpemeriksaan ?></span><span class="badge badge-success"><?php echo $jumlahpemeriksaan ?></span></a>
                                    <a id="tabdaftarpejabat" class="list-group-item" onclick="pindahtab('daftarpejabat')" style="cursor:pointer;"><span class="fa fa-gavel"></span> Daftar Pejabat</a>
                                    <a id="tabforkopimda" class="list-group-item" onclick="pindahtab('forkopimda')" style="cursor:pointer;"><span class="fa fa-puzzle-piece"></span> 
                                    Forkopimda</a>
                                    <a id="tablaporankeuangan" class="list-group-item" onclick="pindahtab('laporankeuangan')" style="cursor:pointer;"><span class="fa fa-file-text"></span> Laporan Keuangan</span></a>
                                    <a id="tabpenduduk" class="list-group-item" onclick="pindahtab('penduduk')" style="cursor:pointer;"><span class="fa fa-group"></span> Penduduk</span></a>
                                     <a id="tabbumdblud" class="list-group-item" onclick="pindahtab('bumdblud')" style="cursor:pointer;"><span class="fa fa-hospital-o"></span> BUMD/BLUD</span></a>
                                </div>
                            </div>                            
                            
                        </div>
                        
                        <div class="col-md-9">

                            <!-- Profil Entitas -->
                            <div id="detprofilentitas">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <form id="frmdetailprofil">
                                            <h2><?php echo $dataent[0]["ENT_NAMA"]?></h2> 
                                            <h2><small>Gambaran Umum</small></h2>                               
                                            <textarea id="txtgambaranumum" name="txtgambaranumum"></textarea>
                                            <br>
                                            <h2><small>Geografis</small></h2>
                                            <textarea class="tinymcetxt" id="txtgeografis" name="txtgeografis"></textarea>
                                            <br>
                                            <h2><small>Batas Wilayah</small></h2>
                                            <textarea class="tinymcetxt" id="txtbataswilayah" name="txtbataswilayah"></textarea>
                                        </form>                                        
                                    </div>
                                    <div class="panel-footer">                                 
                                        <button class="btn btn-success btn-block" onclick="simpandata('frmdetailprofil','<?php echo $_GET['entid']?>','<?php echo $_GET['tahun']?>')">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar SKPD dan Kecamatan -->
                            <div id="detdaftarskpdkecamatan">
                                <div class="panel panel-success">
                                    <div class="panel-body">                           
                                        <textarea id="txtskpdkecamatan" name="txtskpdkecamatan"></textarea>
                                        <br>
                                        <div class="col-md-12">
                                            <div class="col-md-6 col-xs-6" style="margin-left:-20px;">
                                                <h2><small>Daftar SKPD</small></h2>
                                            </div>
                                            <div class="col-md-6 col-xs-6 text-right">
                                                <button class="btn btn-success" onclick="tampilformtambah('SKPD')"><i class="fa fa-plus"></i> Tambah SKPD</button>
                                                <button class="btn btn-info"><i class="fa fa-mail-forward"></i> Data Tahun Lalu</button>
                                            </div>
                                        </div>
                                        
                                        <table class="table table-hover" id="tblskpd">
                                            <thead>
                                                <tr>
                                                    <th>Nama SKPD</th>
                                                    <th>Alamat</th>
                                                    <th width= "150px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <h2><small>Daftar Kecamatan</small></h2>
                                        <table class="table table-hover" id="tblkecamatan">
                                            <thead>
                                                <tr>
                                                    <th>Nama Kecamatan</th>
                                                    <th>Alamat</th>
                                                    <th width= "150px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-footer">                                 
                                        <button class="btn btn-success btn-block">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>                         
                            
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

            const txtgambaranumum= new Jodit('#txtgambaranumum', { height: 500 });
            const txtgeografis= new Jodit('#txtgeografis', { height: 500 });
            const txtbataswilayah= new Jodit('#txtbataswilayah', { height: 500 });
            const txtskpdkecamatan= new Jodit('#txtskpdkecamatan', { height: 500 });



            function kondisiload()
            {
                pindahtab("profilentitas");
                isidatatahunpde();
                ambildata('<?php echo $_GET['entid']?>');
            }

            function pindahtab(statusmenu)
            {
                $("#tabprofilentitas").removeClass("active");
                $("#tabdaftarskpdkecamatan").removeClass("active");
                $("#tabriwayatpemeriksaan").removeClass("active");
                $("#tabdaftarpejabat").removeClass("active");
                $("#tablaporankeuangan").removeClass("active");

                $("#detriwayatpemeriksaan").css("display","none");
                $("#detdaftarskpdkecamatan").css("display","none");
                $("#detprofilentitas").css("display","none");
                $("#dettimdosir").css("display","none");

                if(statusmenu=="profilentitas")
                {
                    $("#tabprofilentitas").addClass("active");
                    $("#detprofilentitas").css("display","inline");
                }
                else if(statusmenu=="daftarskpdkecamatan")
                {
                    $("#tabdaftarskpdkecamatan").addClass("active");
                    $("#detdaftarskpdkecamatan").css("display","inline");
                }
                else if(statusmenu=="riwayatpemeriksaan")
                {
                    $("#tabriwayatpemeriksaan").addClass("active");
                    $("#detriwayatpemeriksaan").css("display","inline");
                }
                else if(statusmenu=="daftarpejabat")
                {
                    $("#tabdaftarpejabat").addClass("active");
                }
                else if(statusmenu=="laporankeuangan")
                {
                    $("#tablaporankeuangan").addClass("active");
                }
                else if(statusmenu=="timdosir")
                {
                    $("#dettimdosir").css("display","inline");
                }
            }

            function tampiltahunpde(data)
            {
                data.forEach(data => {
                    $('#txttahunpde').append($('<option>', {
                        value: data.VALUETAHUN,
                        text: data.TAHUN
                    }));
                });
                $('#txttahunpde').val('<?php echo $_GET['tahun']; ?>');
            }
            
            function isidatatahunpde()
            {
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
            }

            function simpandata(namaform, identitas, tahunpde)
            {
                swal.fire(
                {
                    title:"Menyimpan Data",
                    text: "Menunggu Untuk menyimpan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });
                
                var kirimdata= {};
                kirimdata.namaform = namaform;
                kirimdata.identitas = identitas;
                kirimdata.tahunpde = tahunpde;
                kirimdata.txtgambaranumum = txtgambaranumum.getEditorValue();
                kirimdata.txtgeografis = txtgeografis.getEditorValue();
                kirimdata.txtbataswilayah = txtbataswilayah.getEditorValue();
                
                $.ajax(
                {
                    type:"POST",
                    url:"modul/pde/simpandatapde.php",    
                    data: kirimdata,
                    cache: false,
                    success: function(data)
                    {
                        if(data==0)
                        {
                            swal.fire(
                            {
                                title: "Berhasil",
                                text:  "Data Berhasil di Sipman",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "Lanjutkan",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }).then((hasilnya) =>
                            {
                                if(hasilnya.isConfirmed)
                                {
                                   swal.close();
                                }
                            });
                        }
                        else
                        {
                            swal.fire("Gagal","Data gagal Diubah. Error : " +data,"error");
                        }
                    }
                });
            }

            function ambildata(identitas)
            {
                swal.fire(
                {
                    title:"Menampilkan Data",
                    text: "Menunggu Untuk menampilkan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });

                txtgambaranumum.value="";
                txtgeografis.value="";
                txtbataswilayah.value="";
                
                var kirimdata= {};
                kirimdata.identitas = identitas;
                kirimdata.tahunpde = '<?php echo $_GET['tahun'] ?>';
                $.ajax(
                {
                    type:"POST",
                    url:"modul/pde/tampildatapde.php",    
                    data: kirimdata,
                    cache: false,
                    success: function(data)
                    {
                        if(data==1)
                        {
                            swal.close();
                        }
                        else
                        {
                            var datakembali = JSON.parse(data);
                            txtgambaranumum.value = datakembali.ENT_GAMBARAN_UMUM;
                            txtgeografis.value = datakembali.ENT_GEOGRAFIS;
                            txtbataswilayah.value = datakembali.ENT_BATAS_WILAYAH;
                        }
                    }
                });
                swal.close();
            }

            function gantitahunpde()
            {
                window.location="trndetailpde.php?entid="+<?php echo $_GET['entid']?>+"&tahun="+$('#txttahunpde').val();
            }

            function tampilformtambah(jenis, identitas)
            {
                var halaman="trntambahskpdpde.php";
                if(jenis == "SKPD")
                {
                    halaman="trntambahskpdpde.php?ident=" + identitas;
                }

                $.fancybox.open(
                {
                    maxHeight   : 600,
                    fitToView   : false,
                    height      : '90%',
                    width       : '85%',
                    autoSize    : false,
                    href        : halaman,
                    type        : 'iframe',
                    padding     : 10
                });
            }
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>