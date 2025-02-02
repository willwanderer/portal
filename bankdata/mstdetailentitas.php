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

            $resultprks = $con->query("SELECT p.*, e.* FROM pemeriksaan p, entitas e where p.ENT_ID = e.ENT_ID and e.ENT_ID='".$_GET['entid']."'");
            while($rowprks = $resultprks->fetch_assoc()) 
            {
                $dataprks[]=$rowprks;
                $jumlahpemeriksaan ++;
            }   

            $resultthprks = $con->query("SELECT p.PEM_TAHUN FROM pemeriksaan p, entitas e, detail_pemeriksaan d where p.ENT_ID=e.ENT_ID and p.PEM_ID = d.PEM_ID and p.ENT_ID='".$_GET['entid']."' GROUP BY p.PEM_TAHUN order by p.PEM_TAHUN desc ");
            while($rowthnprks = $resultthprks->fetch_assoc()) 
            {
                $datatahunpem[]=$rowthnprks;
            }
            
            $resultrekan = $con->query("SELECT r.* FROM pegawai r, ENTITAS e, pemeriksaan p, detail_pemeriksaan d WHERE e.ENT_ID = p.ENT_ID and p.PEM_ID = d.PEM_ID and r.PEG_NIP_LAMA = d.PEG_NIP_LAMA and p.ENT_ID = '".$_GET['entid']."' and r.PEG_STATUS = 'Aktif' GROUP by r.PEG_NIP_LAMA ORDER BY RAND() LIMIT 6");
            while($rowrekan = $resultrekan->fetch_assoc()) 
            {
                $datarekan[]=$rowrekan;
            }    

            $resulttimdosir = $con->query("SELECT d.*, p.PEG_NAMA, p.PEG_GELAR_DEPAN, p.PEG_GELAR_BELAKANG, p.PEG_JENIS_KELAMIN, p.PEG_FOTO FROM dosir d, pegawai p, entitas e WHERE d.PEG_NIP_LAMA = p.PEG_NIP_LAMA and e.ENT_ID = d.ENT_ID and d.ENT_ID = '".$_GET['entid']."'");
            while($rowtimdosir = $resulttimdosir->fetch_assoc()) 
            {
                $datatimdosir[]=$rowtimdosir;
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
                    <li><a href="#">Master</a></li>
                    <li><a href="mstentitas.php">Entitas</a></li>
                    <li class="active">Detail Entitas</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
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
                                <div class="panel-body">                                    
                                    <div class="row" align="center">
                                        
                                        <?php
                                            $result1 = $con->query("select * from (SELECT * FROM `OPINI` where ENT_ID='" . $_GET['entid'] . "' order by OP_TAHUN_PEMERIKSAAN desc limit 5) t order by OP_TAHUN_PEMERIKSAAN asc");
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

                                    </div>
                                </div>
                                <div class="panel-body list-group border-bottom">
                                    <a id="tabprofilentitas" class="list-group-item active" onclick="pindahtab('profilentitas')" style="cursor:pointer;"><span class="fa fa-university"></span> Profil Entitas</a>
                                    <a id="tabdaftarpejabat" class="list-group-item" onclick="pindahtab('daftarpejabat')" style="cursor:pointer;"><span class="fa fa-gavel"></span> Daftar Pejabat</a>
                                    <a id="tabforkopimda" class="list-group-item" onclick="pindahtab('forkopimda')" style="cursor:pointer;"><span class="fa fa-puzzle-piece"></span> 
                                    Forkopimda</a>
                                    <a id="tabdaftarskpdkecamatan" class="list-group-item" onclick="pindahtab('daftarskpdkecamatan')" style="cursor:pointer;"><span class="fa fa-sitemap"></span> SKPD dan Kecamatan<span class="badge badge-success"><?php echo $jumlahpemeriksaan ?></span><span class="badge badge-success"><?php echo $jumlahpemeriksaan ?></span></a>
                                    <a id="tabriwayatpemeriksaan" class="list-group-item" onclick="pindahtab('riwayatpemeriksaan')" style="cursor:pointer;"><span class="fa fa-archive"></span> Riwayat Pemeriksaan<span class="badge badge-success"><?php echo $jumlahpemeriksaan ?></span></a>
                                    <a id="tablaporankeuangan" class="list-group-item" onclick="pindahtab('laporankeuangan')" style="cursor:pointer;"><span class="fa fa-file-text"></span> Laporan Keuangan</span></a>
                                    <a id="tabpenduduk" class="list-group-item" onclick="pindahtab('penduduk')" style="cursor:pointer;"><span class="fa fa-group"></span> Penduduk</span></a>
                                    <a id="tabbumdblud" class="list-group-item" onclick="pindahtab('bumdblud')" style="cursor:pointer;"><span class="fa fa-hospital-o"></span> BUMD/BLUD</span></a>
                                </div>
                                <div class="panel-body">
                                    <h4 class="text-title">Tim Dosir <span class="badge badge-success pull-right" style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Manajemen Tim Dosir" onclick="pindahtab('timdosir')"><i class="fa fa-users"></i></span></h4>
                                    <div class="gallery" id="links">                                                
                                        <?php
                                            if(isset($datatimdosir))
                                            {
                                                foreach ($datatimdosir as $datadosir => $valuedosir)
                                                {
                                                    if($valuedosir['DOS_STATUS'] == "Aktif")
                                                    {
                                                        ?>
                                                            <div class="col-md-4 col-xs-4">
                                                                <a class="friend" style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $valuedosir['PEG_NAMA'] ?>">
                                                                    <img src="<?php echo aturprofil($valuedosir['PEG_FOTO'], $valuedosir['PEG_JENIS_KELAMIN']); ?>" onload="this.style.height = this.offsetWidth + 'px';" style="object-fit: cover; object-position: center;" onclick="kepegawai('<?php echo  $valuedosir['PEG_NIP_LAMA']?>')"/>
                                                                    <span><?php echo substr($valuedosir['PEG_NAMA'],0,7) . ".." ?></span>
                                                                </a>                                            
                                                            </div>
                                                        <?php
                                                    }
                                                } 
                                            }
                                        ?>                                        
                                    </div>

                                    <h4 class="text-title">Riwayat Tim Pemeriksa</h4>
                                    <div class="row">
                                        <?php
                                            foreach ($datarekan as $keyrekan => $valuerekan)
                                            {
                                                ?>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a class="friend" style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $valuerekan['PEG_NAMA'] ?>">
                                                            <img src="<?php echo aturprofil($valuerekan['PEG_FOTO'], $valuerekan['PEG_JENIS_KELAMIN']); ?>" onload="this.style.height = this.offsetWidth + 'px';" style="object-fit: cover; object-position: center;" onclick="kepegawai('<?php echo  $valuerekan['PEG_NIP_LAMA']?>')"/>
                                                            <span><?php echo substr($valuerekan['PEG_NAMA'],0,7) . ".." ?></span>
                                                        </a>                                            
                                                    </div>
                                                <?php
                                            }       
                                        ?>
                                    </div>
                                </div>
                            </div>                            
                            
                        </div>
                        
                        <div class="col-md-9" id="divriwayatpemeriksaan">

                            <!-- Profil Entitas -->
                            <div class="timeline timeline-right" id="detprofilentitas">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <h2><?php echo $dataent[0]["ENT_NAMA"]?></h2>                                
                                        <p>Kabupaten Luwu Utara adalah salah satu Daerah Tingkat II di provinsi Sulawesi Selatan, Indonesia. Ibu kota kabupaten ini terletak di Masamba. Kabupaten Luwu Utara yang dibentuk berdasarkan UU No. 19 tahun 1999 merupakan pecahan dari Kabupaten Luwu.</p>
                                        <p>Saat pembentukannya daerah ini memiliki luas 14.447,56 km² dengan jumlah penduduk sekitar 450.000 jiwa. Namun setelah dimekarkan kembali dengan membentuk Kabupaten Luwu Timur pada tahun 2003 maka saat ini luas wilayah Kabupaten Luwu Utara adalah 7.502,58 km² dengan jumlah penduduk 327.820 jiwa (2022).</p>
                                        
                                        <h2><small>Geografis</small></h2>
                                        <p>Luas wilayah Kabupaten Luwu Utara adalah 7.502 km² dan secara geografis Kabupaten Luwu Utara terletak pada koordinat antara 20°30’45” sampai 2°37’30” Lintang Selatan dan 119°41’15” sampai 12°43’11” Bujur Timur. Wilayah Kabupaten Luwu Utara merupakan paling utara di provinsi Sulawesi Selatan yang terdiri dari pantai, dataran rendah hingga pegunungan dengan ketinggian antara 0-3.016 Mdpl.</p>
                                        <p>Wilayah Selatan berupa dataran rendah dan pantai yang berbatasan langsung dengan Teluk Bone. Sebagian besar wilayah berupa pegunungan dengan gunung menjulang seperti Gunung Tolangi, Gunung Balease, Gunung Kabentonu, Gunung Kambuno, Gunung Tusang, Gunung Tantanggunta dan lainnya. Sejumlah sungai besar yang berada di wilayah ini antara lain Sungai Salu Rongkong, Sungai Salu Kula, Sungai Salu Balease, Sungai Salu Karama, Sungai Salu Lodang dan lainnya.</p>

                                        <h2><small>Batas Wilayah</small></h2>
                                        Batas administratif Kabupaten Luwu Utara sebagai berikut:<br>
                                        Utara   Sulawesi Tengah<br>
                                        Timur   Kabupaten Luwu Timur<br>
                                        Selatan Teluk Bone dan Kabupaten Luwu<br>
                                        Barat   Kabupaten Toraja Utara dan Sulawesi Barat

                                    </div>
                                    <!-- <div class="panel-footer">                                 
                                        <button class="btn btn-success btn-block">Choose Plan</button>
                                    </div> -->
                                </div>
                            </div>

                            <!-- Tim Dosir -->
                            <div class="timeline timeline-right" id="dettimdosir">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <h2>Tim Dosir <?php echo $dataent[0]["ENT_NAMA"]?></h2>   
                                        <form id="frmformtimdosir">
                                            <div class="row">
                                                <div class="col-md-4">
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
                                                <div class="col-md-8">
                                                    
                                                        <div class="form-group">
                                                            <input type="text" id="txtidentitas" name="txtidentitas" value="<?php echo $_GET['entid']?>" style="display: none">
                                                            <label class="col-md-12 control-label">Nama Pegawai</label>
                                                            <div class="col-md-12">
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
                                                                <br>                                     
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Peran dalam Tim</label>
                                                            <div class="col-md-12">
                                                                <select id="txtperandalamtim" name="txtperandalamtim" class="form-control select" onchange="tampildetail()" data-live-search="true">
                                                                    <option value="">--- Pilih Peran ---</option>  
                                                                    <option value="Pengendali Teknis">Pengendali Teknis</option>
                                                                    <option value="Ketua Tim">Ketua Tim</option>
                                                                    <option value="Anggota Tim">Anggota Tim</option>
                                                                </select>
                                                            </div>
                                                            <br><br>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Waktu Tugas</label>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                                    <input type="text" class="form-control datepicker" id="txttanggalawal" name="txttanggalawal" onchange="aturakhir()">                                            
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                                    <input type="text" class="form-control datepicker" id="txttanggalakhir" name="txttanggalakhir">                                            
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                        </div>
                                                        <div class="form-group pull-right">
                                                            <button style="margin-top: 20px" class="btn btn-primary" onclick="simpandata()">Simpan</button>   
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                        <br>          
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Peran dalam Tim</th>
                                                    <th>Periode</th>
                                                    <th>Status Tim</th>
                                                    <th width= "150px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(isset($datatimdosir))
                                                    {
                                                        foreach ($datatimdosir as $keytimdosir => $valuetimdosir)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $valuetimdosir['PEG_NAMA']; ?></td>
                                                                <td><?php echo $valuetimdosir['DOS_PERAN_DALAM_TIM']; ?></td>
                                                                <td><?php
                                                                $akhir = "Sekarang";
                                                                if($valuetimdosir['DOS_AKHIR_MENJABAT'] != "")
                                                                {
                                                                    $akhir = date('d M Y',strtotime($valuetimdosir['DOS_AKHIR_MENJABAT']));
                                                                }
                                                                echo date('d M Y',strtotime($valuetimdosir['DOS_AWAL_MENJABAT'])) . " - " . $akhir ?></td>
                                                                <td>
                                                                    <span class="label label-<?php if($valuetimdosir["DOS_STATUS"] == "Aktif"){ echo "danger";}else{echo "success";} ?>"><?php echo $valuetimdosir["DOS_STATUS"] ?></span></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Profil Pegawai" onclick="profilpenanggungjawab('<?php echo $valuetimdosir["DOS_ID"]; ?>')"><i class="fa fa-user"></i></button>
                                                                        <button class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Hubungi Pegawai" onclick="hubungipenanggungjawab('<?php echo $valuetimdosir["DOS_ID"]; ?>')"><i class="fa fa-comments"></i></button>
                                                                        
                                                                        <?php
                                                                            if($valuetimdosir["DOS_STATUS"] == "Aktif")
                                                                            {
                                                                                ?>
                                                                                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Nonaktifkan Pegawai pada Tim Dosir" onclick="ubahstatuspenanggungjawab('<?php echo $valuetimdosir["DOS_ID"]; ?>', 'Tidak Aktif', '<?php echo $valuetimdosir['PEG_NAMA']; ?>','<?php echo $dataent[0]["ENT_NAMA"]?>')"><i class="fa fa-ban"></i></button>
                                                                                <?php 
                                                                            }
                                                                        ?>                                 
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    
                                                ?>

                                                
                                            </tbody>
                                        </table>
                                        

                                    </div>
                                    <!-- <div class="panel-footer">                                 
                                        <button class="btn btn-success btn-block">Choose Plan</button>
                                    </div> -->
                                </div>
                            </div>

                            <!-- Riwayat Pemeriksaan -->
                            <div class="timeline timeline-right" id="detriwayatpemeriksaan">
                                
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
                                                                            <img src="<?php echo 'data:image/jpeg;base64,'. base64_encode($valuepem['ENT_LOGO'])?>" alt="" width="45px" style="margin-left: -5px;margin-top: -5px"/>
                                                                        </div>                                   
                                                                        <div class="timeline-item-content">
                                                                            <div class="timeline-heading padding-bottom-0">
                                                                                Pemeriksaan pada <a href="#"><?php echo $valuepem["ENT_NAMA"];?></a> terkait
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
                                                                                            $result1 = $con->query("SELECT * FROM `OPINI` where ENT_ID='" . $_GET['entid'] . "' and  OP_TAHUN_PEMERIKSAAN ='". $valuepem['PEM_TAHUN']-1 ."'");
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
                pindahtab("profilentitas");
                // pindahtab("timdosir");
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
                    title: "Simpan Logo",
                    text: "Logo berhasil ditampilkan. Apakah anda ingin melanjutkan ke penyimpanan?",
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
                            url:"modul/master/ubahlogo.php",    
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
                $("#tabprofilentitas").removeClass("active");
                $("#tabriwayatpemeriksaan").removeClass("active");
                $("#tabdaftarpejabat").removeClass("active");
                $("#tablaporankeuangan").removeClass("active");

                $("#detriwayatpemeriksaan").css("display","none");
                $("#detprofilentitas").css("display","none");
                $("#dettimdosir").css("display","none");



                if(statusmenu=="profilentitas")
                {
                    $("#tabprofilentitas").addClass("active");
                    $("#detprofilentitas").css("display","inline");
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

                var myform = document.getElementById('frmformtimdosir');
                var fd=new FormData(myform);
                $.ajax(
                {
                    type:"POST",
                    url:"modul/master/simpantimdosir.php",    
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

            function ubahstatuspenanggungjawab(idpj, status, namap, namaentitas)
            {
                if(status == "Tidak Aktif")
                {
                    swal.fire({
                        title: "Anda Yakin?",
                        text: "Apakah Anda ingin menonaktifkan '" + namap + "' dari Tim Dosir '" + namaentitas + "'?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                        closeOnConfirm: false
                    }).then((hasil) =>
                    {
                        if(hasil.isConfirmed)
                        {
                            Swal.fire({
                                title: "Waktu Berakhir Tugas",
                                html: "<p>Harap mengisi tanggal '" + namap + "' tidak menjadi Tim Dosir '" + namaentitas + "'?</p><div class='input-group'><span class='input-group-addon'><span class='fa fa-calendar'></span></span><input type='date' class='form-control' id='txttanggalakhirubstatus' name='txttanggalakhirubstatus'></div>",
                                focusConfirm: false,
                                preConfirm: () => {
                                    return [
                                        document.getElementById("txttanggalakhirubstatus").value
                                    ];
                                },
                                inputValidator: () => { if(document.getElementById("txttanggalakhirubstatus").value=="") { return 'Data Tidak Boleh Kosong!'}}
                            }).then(function(result) {
                                if(result.value == "")
                                {
                                    swal.fire("Gagal","Data tidak boleh kosong","error");
                                }
                                else
                                {
                                    var kirimdata= {};
                                    kirimdata.idtd = idpj;
                                    kirimdata.status = status;
                                    kirimdata.tglakhir = result.value[0];
                                    $.ajax(
                                    {
                                        type:"POST",
                                        url:"modul/master/nonaktiftimdosir.php",    
                                        data: kirimdata,
                                        cache: false,
                                        success: function(data)
                                        {
                                            if(data==0)
                                            {
                                                swal.fire(
                                                    {
                                                        title: "Berhasil",
                                                        text:  namap + " berhasil dikeluarkan dari '" + namaentitas + "' !!",
                                                        icon: "success",
                                                        showCancelButton: false,
                                                        confirmButtonText: "Lanjutkan",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: false
                                                    }).then((hasilnya) =>
                                                    {
                                                        if(hasilnya.isConfirmed)
                                                        {
                                                           window.location.reload();
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
                            });


                        }
                    });

                }
            }
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>