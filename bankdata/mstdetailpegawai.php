<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php"); 

            $jumlahpemeriksaan =0;

            $result = $con->query("SELECT p.*, u.UO_NAMA as 'PEG_UNIT_ORGANISASI' FROM PEGAWAI p, UNIT_ORGANISASI u where p.UO_ID=u.UO_ID and p.PEG_NIP_LAMA='".$_GET['nip']."'");
            while($row = $result->fetch_assoc()) 
            {
                $datapeg[]=$row;
            }


            $resultprks = $con->query("SELECT p.*, d.*, e.ENT_NAMA, e.ENT_LOGO FROM pemeriksaan p, entitas e, detail_pemeriksaan d where p.ENT_ID=e.ENT_ID and p.PEM_ID = d.PEM_ID and d.PEG_NIP_LAMA='".$_GET['nip']."' order by p.PEM_TAHUN desc");
            while($rowprks = $resultprks->fetch_assoc()) 
            {
                $dataprks[]=$rowprks;
                $jumlahpemeriksaan ++;
            }   

            $resultprks = $con->query("SELECT p.PEM_TAHUN FROM pemeriksaan p, entitas e, detail_pemeriksaan d where p.ENT_ID=e.ENT_ID and p.PEM_ID = d.PEM_ID and d.PEG_NIP_LAMA='".$_GET['nip']."' GROUP BY p.PEM_TAHUN order by p.PEM_TAHUN desc ");
            while($rowthnprks = $resultprks->fetch_assoc()) 
            {
                $datatahunpem[]=$rowthnprks;
            }
            
            $resultrekan = $con->query("SELECT * FROM pegawai WHERE UO_ID = '" . $datapeg[0]["UO_ID"] . "' ORDER BY RAND() LIMIT 6");
            while($rowrekan = $resultrekan->fetch_assoc()) 
            {
                $datarekan[]=$rowrekan;
            }

            $namalengkap = $datapeg[0]['PEG_GELAR_DEPAN'] . " ". $datapeg[0]['PEG_NAMA'] . " " . $datapeg[0]['PEG_GELAR_BELAKANG'];
                

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
                    <li><a href="mstbezettingpegawai.php">Bezetting Pegawai</a></li>
                    <li class="active">Detail Pegawai</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <div class="panel panel-default">
                                <div class="panel-body profile" style="background: url('../img/bcg-profile.jpg') top center no-repeat;">
                                    <div class="profile-image">
                                        <form id="frmfotoprofil">
                                            <label for="txtfotoprofil">
                                            <img id="imgfotoprofil" src="<?php echo aturprofil($datapeg[0]['PEG_FOTO'], $datapeg[0]['PEG_JENIS_KELAMIN']); ?>" style="object-fit: cover; object-position: center; cursor: pointer;" height="100px" data-toggle="tooltip" data-placement="top" title="Pilih untuk merubah Foto Profil" onclick=""/></label>
                                            <input id="txtfotoprofil" name="txtfotoprofil" type="file" style="display:none" onchange="gantifotoprofil()" />
                                            <input type="text" name="txtnip" id="txtnip" value="<?php echo $_GET['nip'] ?>" style="display:none" >
                                        </form>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><?php echo $namalengkap?></div>
                                        <div class="profile-data-title" style="color: #FFF;"><?php echo $datapeg[0]["PEG_JABATAN"];?></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a id="btnsimpanfoto" href="#" class="profile-control-left" style="display:none;" onclick="simpanfoto()"><span class="fa fa-save"></span></a>
                                        <!-- <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a> -->
                                    </div>
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a target="_blank" href="<?php linksisdm($datapeg[0]["PEG_NIP_LAMA"],$datapeg[0]["PEG_NIP_BARU"],$datapeg[0]["PEG_NAMA"]) ?>" class="btn btn-info btn-rounded btn-block"><span class="fa fa-check"></span> SISDM</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-primary btn-rounded btn-block"><span class="fa fa-comments"></span> Chat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body list-group border-bottom">
                                    <a id="tabriwayatpemeriksaan" class="list-group-item active" onclick="pindahtab('riwayatpemeriksaan')" style="cursor:pointer;"><span class="fa fa-bar-chart-o"></span> Riwayat Pemeriksaan <span class="badge badge-success"><?php echo $jumlahpemeriksaan ?></span></a>
                                    <a id="tabdetailpegawai" class="list-group-item" onclick="pindahtab('detailpegawai')" style="cursor:pointer;"><span class="fa fa-archive"></span> Detail Pegawai</a>
                                    <a id="tabkompetensipegawai" class="list-group-item" onclick="pindahtab('kompetensipegawai')" style="cursor:pointer;"><span class="fa fa-briefcase"></span> Kompetensi Pegawai</a>                                
                                    <a id="tabbenturankepentingan" class="list-group-item" onclick="pindahtab('benturankepentingan')" style="cursor:pointer;"><span class="fa fa-ban"></span> Benturan Kepentingan <span class="badge badge-danger">+7</span></a>
                                </div>
                                <div class="panel-body">
                                    <h4 class="text-title">Rekan Unit Kerja</h4>
                                    <div class="row">
                                        <?php
                                            foreach ($datarekan as $keyrekan => $valuerekan)
                                            {
                                                ?>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a class="friend" style="cursor:pointer;">
                                                            <img src="<?php echo aturprofil($valuerekan['PEG_FOTO'], $valuerekan['PEG_JENIS_KELAMIN']); ?>" height="55px" style="object-fit: cover; object-position: center;" onclick="kepegawai('<?php echo  $valuerekan['PEG_NIP_LAMA']?>')"/>
                                                            <span><?php echo substr($valuerekan['PEG_NAMA'],0,12) . "..." ?></span>
                                                        </a>                                            
                                                    </div>
                                                <?php
                                            }       
                                        ?>
                                    </div>
                                    <h4 class="text-title">Kompetensi</h4>
                                    <div class="gallery" id="links">                                                
                                        <!-- <a href="assets/images/gallery/music-1.jpg" title="Music Image 1" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/music-1.jpg" alt="Music Image 1"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/music-2.jpg" title="Music Image 2" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/music-2.jpg" alt="Music Image 2"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/music-3.jpg" title="Music Image 3" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/music-3.jpg" alt="Music Image 3"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/nature-1.jpg" title="Nature Image 1" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/nature-1.jpg" alt="Nature Image 1"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/nature-2.jpg" title="Nature Image 2" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/nature-2.jpg" alt="Nature Image 2"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/nature-3.jpg" title="Nature Image 3" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/nature-3.jpg" alt="Nature Image 3"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/nature-4.jpg" title="Nature Image 4" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/nature-4.jpg" alt="Nature Image 4"/>
                                            </div>                                            
                                        </a>
                                        <a href="assets/images/gallery/nature-5.jpg" title="Nature Image 5" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="assets/images/gallery/nature-5.jpg" alt="Nature Image 5"/>
                                            </div>                                            
                                        </a>  -->                                       
                                    </div>

                                    <h4 class="text-title">Lini Masa Pemeriksaan</h4>
                                    <div class="row" align="center">                                                
                                        <?php
                                            if(isset($datatahunpem))
                                            {
                                                foreach ($datatahunpem as $key => $value)
                                                {
                                                    $jumlahpem = 0;
                                                    foreach ($dataprks as $keypem => $valuepem)
                                                    {
                                                        if($valuepem['PEM_TAHUN'] == $value['PEM_TAHUN'])
                                                        {
                                                            $jumlahpem++;
                                                        }
                                                    }
                                                    ?>
                                                        <span class="badge badge-pill" style="background-color:#28A745; cursor:pointer; margin-top: 5px" data-toggle="tooltip" data-placement="top" title="<?php echo $jumlahpem . " Kali Pemeriksaan"?>"><?php echo $value['PEM_TAHUN']?></span>
                                                    <?php
                                                }
                                            }
                                        ?>                                
                                    </div>

                                </div>
                            </div>                            
                            
                        </div>
                        
                        <div class="col-md-9" id="divriwayatpemeriksaan">
                            <!-- START TIMELINE -->
                            <div class="timeline timeline-right">
                                
                                <?php
                                    if(isset($datatahunpem))
                                    {
                                        foreach ($datatahunpem as $key => $value)
                                        {
                                            ?>
                                                <!-- START TIMELINE ITEM -->
                                                <div class="timeline-item timeline-main">
                                                    <div class="timeline-date"><?php echo $value['PEM_TAHUN'] ?></div>
                                                </div>
                                                <!-- END TIMELINE ITEM -->

                                                <?php
                                                    foreach ($dataprks as $keypem => $valuepem)
                                                    {
                                                        if($valuepem['PEM_TAHUN'] == $value['PEM_TAHUN'])
                                                        {
                                                            $jumlahtim = 0;
                                                            $datatimpem = array();
                                                            $resulttim = $con->query("SELECT p.*, d.* FROM pegawai p, detail_pemeriksaan d where p.PEG_NIP_LAMA=d.PEG_NIP_LAMA and d.PEM_ID = '". $valuepem['PEM_ID'] ."'");
                                                            while($rowtim = $resulttim->fetch_assoc()) 
                                                            {
                                                                $datatimpem[]=$rowtim;
                                                                $jumlahtim ++;
                                                            }


                                                            ?>
                                                                <!-- START TIMELINE ITEM -->
                                                                    <div class="timeline-item timeline-item-right">
                                                                        <div class="timeline-item-info"><?php echo singkatjenispem($valuepem['PEM_JENIS']) ?></div>
                                                                        <div class="timeline-item-icon">
                                                                            <a href="mstdetailentitas.php?entid=<?php echo $valuepem["ENT_ID"] ?>">
                                                                                <img src="<?php echo 'data:image/jpeg;base64,'. base64_encode($valuepem['ENT_LOGO'])?>" alt="" width="45px" style="margin-left: -5px;margin-top: -5px"/>
                                                                            </a>
                                                                        </div>                                   
                                                                        <div class="timeline-item-content">
                                                                            <div class="timeline-heading padding-bottom-0">
                                                                                <a href="#"><?php echo $datapeg[0]["PEG_NAMA"];?></a> Melakukan Pemeriksaan pada <a href="mstdetailentitas.php?entid=<?php echo $valuepem["ENT_ID"] ?>"><?php echo $valuepem["ENT_NAMA"];?></a>
                                                                            </div>                                        
                                                                            <div class="timeline-body" style="margin-top: -10px;"> 
                                                                                <h5><?php echo $valuepem['PEM_OBJEK'] ?></h5>
                                                                            </div> 
                                                                            <div class="timeline-heading" style="padding-bottom: 10px; margin-top: -20px;"> 
                                                                                
                                                                                <?php
                                                                                    foreach ($datatimpem as $keytimpem => $valuetimpem)
                                                                                    {
                                                                                        ?>
                                                                                            <img src="<?php echo aturprofil($valuetimpem['PEG_FOTO'], $valuetimpem['PEG_JENIS_KELAMIN']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo  $valuetimpem['PEG_NAMA'] . " (" . $valuetimpem['DETPEM_PERAN_DALAM_TIM'] . ")"?>" style="cursor:pointer;object-fit: cover; object-position: center;" onclick="kepegawai('<?php echo  $valuetimpem['PEG_NIP_LAMA']?>')" />
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </div>                
                                                                            <div class="timeline-footer">
                                                                                <a href="#">Details</a>
                                                                                <div class="pull-right">
                                                                                    <?php
                                                                                        if(singkatjenispem($valuepem['PEM_JENIS'])=="LKPD")
                                                                                        {
                                                                                            ?>
                                                                                            <a href="#">
                                                                                        <?php
                                                                                            $result1 = $con->query("SELECT * FROM `OPINI` where ENT_ID='" . $valuepem["ENT_ID"] . "' and  OP_TAHUN_PEMERIKSAAN ='". $valuepem['PEM_TAHUN']-1 ."'");
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


                                                                                    </a> 
                                                                                            <?php
                                                                                        }
                                                                                    ?>
                                                                                    <a href="#"><span class="fa fa-suitcase"></span> <?php echo $valuepem["DETPEM_PERAN_DALAM_TIM"]?></a> 
                                                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Jumlah Personil"><span class="fa fa-users"></span> <?php echo $jumlahtim ?></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                    
                                                                    </div>       
                                                                    <!-- END TIMELINE ITEM -->
                                                            <?php
                                                        }
                                                    }
                                        }
                                    }
                                ?>
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->
                            </div>
                            <!-- END TIMELINE -->                            
                        </div>
                            
                        <div class="col-md-9" id="divdetailpegawai">
                            <form class="form-horizontal">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Detail</strong> Pegawai</h3>
                                    </div>
                                    <div class="panel-body">                                                                    
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">NIP</label>
                                                    <div class="col-md-9 col-xs-12">                                            
                                                        <input type="text" class="form-control" id="txtnipdp" name="txtnipdp"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">NIP BPK</label>
                                                    <div class="col-md-5 col-xs-12">                                            
                                                        <input type="text" class="form-control" id="txtnipbpkdp" name="txtnipbpkdp"/>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nama</label>
                                                    <div class="col-md-2 col-xs-12">                                            
                                                        <input type="text" class="form-control" id="txtgelardepandp" name="txtgelardepandp"/>
                                                    </div>
                                                    <div class="col-md-5 col-xs-15">                                            
                                                        <input type="text" class="form-control" id="txtnamadp" name="txtnamadp"/>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">                                            
                                                        <input type="text" class="form-control" id="txtgelarbelakangdp" name="txtgelarbelakangdp"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Jenis Kelamin</label>
                                                    <div class="col-md-9 col-xs-12">                                            
                                                        <select class="form-control" id="txtjeniskelamindp" name="txtjeniskelamindp" >
                                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                                            <option value="Pria">Pria</option>
                                                            <option value="Wanita">Wanita</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status Pernikahan</label>
                                                    <div class="col-md-9 col-xs-12">                                            
                                                        <select class="form-control" id="txtstatuspenikahandp" name="txtstatuspenikahandp" >
                                                            <option value="">-- Pilih Status Pernikahan --</option>
                                                            <option value="Belum Nikah">Belum Nikah</option>
                                                            <option value="Nikah">Nikah</option>
                                                            <option value="Single Parent">Single Parent</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Pendidikan</label>
                                                    <div class="col-md-9 col-xs-12">                                            
                                                        <select class="form-control" id="txtpendidikandp" name="txtpendidikandp" >
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Unit Organisasi</label>
                                                    <div class="col-md-9 col-xs-12">                                            
                                                        <select class="form-control" id="txtunitorganisasidp" name="txtunitorganisasidp" >
                                                        </select> 
                                                    </div>
                                                </div>    
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Jabatan</label>
                                                    <div class="col-md-9 col-xs-12">                                            
                                                        <select class="form-control" id="txtjabatanidp" name="txtjabatanidp" >
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Pangkat/ Golongan</label>
                                                    <div class="col-md-6 col-xs-6">                                            
                                                        <input type="text" class="form-control" id="txtpangkatdp" name="txtpangkatdp"/>
                                                    </div>
                                                    <div class="col-md-3 col-xs-3">                                            
                                                        <input type="text" class="form-control" id="txtgolongandp" name="txtgolongandp"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">                                        
                                                    <label class="col-md-3 control-label">Password</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                            <input type="password" class="form-control"/>
                                                        </div>            
                                                        <span class="help-block">Password untuk masuk ke aplikasi Portal</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">                                 
                                        <button class="btn btn-primary pull-right">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
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
                pindahtab("riwayatpemeriksaan");
            }

            function kepegawai(nip)
            {
                var halaman="mstdetailpegawai.php?nip="+nip;
                window.location=halaman;
            }

            function gantifotoprofil()
            {
                imgfotoprofil.src=URL.createObjectURL(event.target.files[0]);
                swal.fire({
                    title: "Simpan Foto",
                    text: "Foto berhasil ditampilkan. Apakah anda ingin melanjutkan ke penyimpanan?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    closeOnConfirm: false
                }).then((hasil) =>
                {
                    if(hasil.isConfirmed)
                    {
                        swal.fire(
                        {
                            title:"Menyimpan Data",
                            text: "Menunggu Untuk menyimpan data",
                            showConfirmButton: false,
                            imageUrl: "../js/sweetalert2/img/load.gif"
                        });

                        var myform = document.getElementById('frmfotoprofil');
                        var fd=new FormData(myform);

                        $.ajax(
                        {
                            type:"POST",
                            url:"modul/master/ubahfoto.php",    
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
                                        window.location.reload(true);
                                    }); 
                                }
                                else
                                {
                                    swal.fire("Gagal","Data gagal Di Simpan. Error : " +data,"error");
                                }
                            }
                        });
                    }
                });
            }

            function pindahtab(statusmenu)
            {
                $("#tabriwayatpemeriksaan").removeClass("active");
                $("#tabdetailpegawai").removeClass("active");
                $("#tabkompetensipegawai").removeClass("active");
                $("#tabbenturankepentingan").removeClass("active");

                $("#divriwayatpemeriksaan").css("display","none");
                $("#divdetailpegawai").css("display","none");
                $("#divkompetensipegawai").css("display","none");
                $("#divbenturankepentingan").css("display","none");

                if(statusmenu=="riwayatpemeriksaan")
                {
                    $("#tabriwayatpemeriksaan").addClass("active");
                    $("#divriwayatpemeriksaan").css("display","inline");
                }
                else if(statusmenu=="detailpegawai")
                {
                    $("#tabdetailpegawai").addClass("active");
                    $("#divdetailpegawai").css("display","inline");
                }
                else if(statusmenu=="kompetensipegawai")
                {
                    $("#tabkompetensipegawai").addClass("active");
                    $("#divkompetensipegawai").css("display","inline");
                }
                else if(statusmenu=="benturankepentingan")
                {
                    $("#tabbenturankepentingan").addClass("active");
                    $("#divbenturankepentingan").css("display","inline");
                }
            }
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>