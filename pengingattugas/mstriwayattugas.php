<!DOCTYPE html>
<html>
    <head>
        <?php 
            include("metacss.php"); 
            $result = $con->query("SELECT *, DATEDIFF(PT_TANGGAL_AKHIR, now()) as 'PT_SISA_HARI' FROM pengingat_tugas where PT_ID='".$_GET['idtugas']."'");
            while($row = $result->fetch_assoc()) 
            {
                $datatmp[]=$row;
            }

            $klasifikasi = explode(",",  $datatmp[0]['PT_KLASIFIKASI_TUGAS']);
        ?>
    </head>
    <body class="skin-blue" onload="kondisiload()">
        <div class="box box-warning">
            <form id="formkirim">
                <div class="box-body">
                
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="callout <?php 
                                if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Rendah") { echo " callout-sucsess"; } 
                                if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Sedang") { echo " callout-info"; } 
                                if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Tinggi") { echo " callout-warning"; }
                                if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Mendesak") { echo " callout-callout"; }
                            ?>">
                                <h4><?php echo $datatmp[0]['PT_JUDUL'] ?></h4>
                                <p style="margin-top: -10px ;">
                                    <span class="badge" style="background-color: #3C8DBC;"><i class="fa fa-user"></i>
                                    <?php 
                                        if($datatmp[0]['PEG_NIP_LAMA'] == "Tidak Ada" || $datatmp[0]['PEG_NIP_LAMA'] == "Semua Pegawai" || $datatmp[0]['PEG_NIP_LAMA'] == "Pemeriksa Ahli Madya" || $datatmp[0]['PEG_NIP_LAMA'] == "Pemeriksa Ahli Muda") 
                                        { 
                                            echo $datatmp[0]['PEG_NIP_LAMA']; 
                                        }
                                        else
                                        {
                                            foreach ($_SESSION['dtpegawai'] as $key => $value)
                                            {
                                                if($datatmp[0]['PEG_NIP_LAMA'] == $value['PEG_NIP_LAMA']) 
                                                { 
                                                    echo $value['PEG_NAMA']; 
                                                }
                                            }
                                        }
                                    ?>    
                                    </span>
                                    <span class="badge" style="background-color: #3C8DBC;"><i class="fa fa-calendar"></i>
                                    <?php 
                                        echo date('d M Y',strtotime($datatmp[0]['PT_TANGGAL_AWAL']));
                                        if($datatmp[0]['PT_TANGGAL_AKHIR']!="")
                                        {
                                            echo " s.d. " . date('d M Y',strtotime($datatmp[0]['PT_TANGGAL_AKHIR']));
                                        }
                                    ?> </span>
                                    <?php echo tampilkepentingan($datatmp[0]['PT_LEVEL_KEPENTINGAN']); ?>
                                    <span class="badge" style="background-color: #3C8DBC;"><?php echo $datatmp[0]['PT_STATUS']?></span>
                                    <?php
                                        if($datatmp[0]['PT_TANGGAL_AKHIR']!="")
                                        {
                                            if($datatmp[0]['PT_SISA_HARI'] < 0)
                                            {
                                                if($datatmp[0]['PT_STATUS']!="Selesai" || $datatmp[0]['PT_STATUS']!="Batal")
                                                {
                                                    ?>
                                                        <span class="badge blink" style="background-color: #D9534F;">Terlewat <?php echo $datatmp[0]['PT_SISA_HARI'] *-1 ?> hari.</span><br>
                                                    <?php
                                                }
                                            }
                                            elseif($datatmp[0]['PT_SISA_HARI'] <=2 && $datatmp[0]['PT_SISA_HARI'] >= 0)
                                            {
                                                ?>
                                                    <span class="badge blink" style="background-color: #D9534F;"><?php echo $datatmp[0]['PT_SISA_HARI'] ?> hari tersisa</span><br>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <span class="badge" style="background-color: #F39C12;"><?php echo $datatmp[0]['PT_SISA_HARI'] ?> hari tersisa</span><br>
                                                <?php
                                            }
                                            
                                        }
                                    ?>
                                </p>
                                <p><?php echo $datatmp[0]['PT_DETAIL'] ?>.</p>
                            </div>

                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="txtstatus" name="txtstatus" onchange="ubahstatus()">
                                                    <option value="DiKerjakan">DiKerjakan</option>
                                                    <option value="Selesai">Selesai</option>
                                                    <option value="Batal">Batal</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 form-group">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" id="txttanggal" name="txttanggal" max="100" min="1" />
                                            </div>
                                            <div class="col-sm-4 form-group">
                                                <label>Progres</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="txtprogres" name="txtprogres"/>
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-xs-12 form-group">
                                                <label>Catatan</label>
                                                <textarea class="form-control" rows="3" id="txtcatatan" name="txtcatatan"></textarea>
                                                <input type="text" id="txtidtugas" name="txtidtugas" style="display:none" value="<?php echo $_GET['idtugas'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row">
                                            <div class="chat">
                                                <div class="item">
                                                    <img src="img/progress/01Ditugaskan.png" alt="user image" class="offline"/>
                                                    <p class="message">
                                                        <a href="#" class="name">
                                                            <small class="text-muted pull-right"><i class="fa fa-calendar"></i> <?php echo date('d M Y',strtotime($datatmp[0]['PT_TANGGAL_AWAL'])) ?></small>
                                                            DiTugaskan
                                                        </a>
                                                        Tugas di Disposisi
                                                        <br>
                                                        <b>0%</b>
                                                    </p>
                                                </div><!-- /.item -->
                                                <?php
                                                    $result = $con->query("SELECT * FROM riwayat_pengingat_tugas where PT_ID='".$_GET['idtugas']."'");
                                                    while($row = $result->fetch_assoc()) 
                                                    {
                                                        ?>
                                                            <div class="item">
                                                                <img src="img/progress/<?php
                                                                    if($row['RPT_STATUS']=="DiTugaskan")
                                                                    {
                                                                        echo "01Ditugaskan";
                                                                    }
                                                                    elseif($row['RPT_STATUS']=="DiKerjakan")
                                                                    {
                                                                        echo "02Dikerjakan";
                                                                    }
                                                                    elseif($row['RPT_STATUS']=="Selesai")
                                                                    {
                                                                        echo "03Selesai";
                                                                    }
                                                                    elseif($row['RPT_STATUS']=="Batal")
                                                                    {
                                                                        echo "04Batal";
                                                                    }
                                                                ?>.png" alt="user image" class="offline"/>
                                                                <p class="message">
                                                                    <a href="#" class="name">
                                                                        <small class="text-muted pull-right"><i class="fa fa-calendar"></i> <?php echo date('d M Y',strtotime($row['RPT_TANGGAL'])) ?></small>
                                                                        <?php echo $row['RPT_STATUS'] ?>
                                                                    </a>
                                                                    <?php echo $row['RPT_KETERANGAN'] ?>
                                                                    <br>
                                                                    <b><?php echo $row['RPT_PERSENTASE'] ?>%</b>
                                                                    &nbsp;<i class="fa fa-trash-o" style="cursor:pointer; color: red;" onclick="hapusriwayat('<?php echo $row['RPT_ID'] ?>')"></i>
                                                                </p>
                                                            </div><!-- /.item -->
                                                        <?php
                                                    }
                                                ?>

                                            </div><!-- /.chat -->
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div><!-- /.box-body -->
            </form>
                <div class="box-footer clearfix">
                    <button class="pull-right btn btn-warning" onclick="simpantugas()"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                </div>
        </div><!-- /.box -->
        <?php include("javas.php"); ?>

        <script type="text/javascript">
            function kondisiload()
            {
                setmenu();
            }

            function ubahstatus()
            {
                if($('#txtstatus').val() == "Selesai")
                {
                    $('#txtprogres').val('100');
                    $('#txtprogres').prop('readonly', true);
                }
                else
                {
                    $('#txtprogres').val('');
                    $('#txtprogres').prop('readonly', false);
                }
            }

            function simpantugas()
            {
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
                    url:"modul/master/simpanriwayattugas.php",    
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
                                text: "Data Berhasil di Ubah!!",
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
                            swal.fire("Gagal","Data gagal Di Ubah. Error : " +data,"error");
                        }
                    }
                });
            }

            function hapusriwayat(idtugas)
            {
                swal.fire({
                    title: "Anda Yakin",
                    text: "Apa anda yakin ingin menghapus data Tugas?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Yakin',
                    cancelButtonText: 'Batal',
                    closeOnConfirm: false
                }).then((hasil) =>
                {
                    if(hasil.isConfirmed)
                    {
                        var kirimdata= {};
                        kirimdata.idtugas = idtugas;
                        $.ajax(
                        {
                            type:"POST",
                            url:"modul/master/hapusriwayattugas.php",    
                            data: kirimdata,
                            cache: false,
                            success: function(data)
                            {
                                if(data==0)
                                {
                                    swal.fire(
                                    {
                                        title: "Berhasil",
                                        text: "Perubahan Berhasil di Simpan!!",
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
                });
            }
        </script>
    </body>
</html>




