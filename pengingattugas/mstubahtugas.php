<!DOCTYPE html>
<html>
    <head>
        <?php 
            include("metacss.php"); 
            $result = $con->query("SELECT * FROM pengingat_tugas where PT_ID='".$_GET['idtugas']."'");
            while($row = $result->fetch_assoc()) 
            {
                $datatmp[]=$row;
            }

            $klasifikasi = explode(",",  $datatmp[0]['PT_KLASIFIKASI_TUGAS']);
        ?>
    </head>
    <body class="skin-blue" onload="kondisiload()">
        <div class="box box-warning">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Ubah Tugas</h3>
            </div><!-- /.box-header -->
            <form id="formkirim">
                <div class="box-body">
                
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Judul Tugas</label>
                                <input type="text" class="form-control" id="txtjudultugas" name="txtjudultugas" value="<?php echo $datatmp[0]['PT_JUDUL'] ?>" />
                                <input type="text" id="txtidtugas" name="txtidtugas" style="display:none" value="<?php echo $_GET['idtugas'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Detail Tugas</label>
                                <textarea class="form-control" rows="3" id="txtdetailtugas" name="txtdetailtugas"><?php echo $datatmp[0]['PT_DETAIL'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 form-group">
                            <label>Pegawai PIC</label>
                            <select id="txtnippic" name="txtnippic" class="form-control" style="height: 200px;">
                                <option value="Tidak Ada" <?php if($datatmp[0]['PEG_NIP_LAMA'] == "Tidak Ada") { echo " Selected"; } ?> >Tidak Ada</option>
                                <option value="Semua Pegawai" <?php if($datatmp[0]['PEG_NIP_LAMA'] == "Semua Pegawai") { echo " Selected"; } ?>>Semua Pegawai</option>
                                <option value="Pemeriksa Ahli Madya" <?php if($datatmp[0]['PEG_NIP_LAMA'] == "Pemeriksa Ahli Madya") { echo " Selected"; } ?>>Pemeriksa Ahli Madya</option>
                                <option value="Pemeriksa Ahli Muda" <?php if($datatmp[0]['PEG_NIP_LAMA'] == "Pemeriksa Ahli Muda") { echo " Selected"; } ?>>Pemeriksa Ahli Muda</option>
                                <?php
                                    foreach ($_SESSION['dtpegawai'] as $key => $value)
                                    {
                                        ?>
                                            <option value="<?php echo $value['PEG_NIP_LAMA'] ?>" <?php if($datatmp[0]['PEG_NIP_LAMA'] == $value['PEG_NIP_LAMA']) { echo " Selected"; } ?>><?php echo $value['PEG_NAMA'] ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                            <label>Tanggal Disposisi</label>
                            <input type="date" class="form-control" id="txttgldisposisi" name="txttgldisposisi" value="<?php echo date('Y-m-d',strtotime($datatmp[0]['PT_TANGGAL_AWAL'])) ?>" />   
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                            <label>Batas Waktu</label>
                            <input type="date" class="form-control" id="txttglbataswaktu" name="txttglbataswaktu" value="<?php if($datatmp[0]['PT_TANGGAL_AKHIR']!=""){ echo date('Y-m-d',strtotime($datatmp[0]['PT_TANGGAL_AKHIR'])); } ?>" />
                        </div>
                        <div class="col-sm-7 col-xs-12 form-group">
                            <label>Klasifikasi</label>
                            <select id="txtklasifikasi" name="txtklasifikasi[]" class="form-control" multiple="multiple" >
                                <option value="">-- Pilih Klasifikasi --</option>
                                <option value="Tindaklanjuti" 
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Tindaklanjuti")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Tindaklanjuti</option>
                                <option value="Pelajari" 
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Pelajari")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Pelajari</option>
                                <option value="Edarkan"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Edarkan")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Edarkan</option>
                                <option value="Sosialisasikan" 
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Sosialisasikan")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Sosialisasikan</option>
                                <option value="Untuk Menjadi Perhatian"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Untuk Menjadi Perhatian")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Untuk Menjadi Perhatian</option>
                                <option value="Bicarakan Bersama"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Bicarakan Bersama")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Bicarakan Bersama</option>
                                <option value="Tembusan dari Kepala Perwakilan"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Tembusan dari Kepala Perwakilan")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Tembusan dari Kepala Perwakilan</option>
                                <option value="Untuk di Monitor"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Untuk di Monitor")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Untuk di Monitor</option>
                                <option value="Untuk di Pedomani"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Untuk di Pedomani")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Untuk di Pedomani</option>
                                <option value="Untuk di Ketahui"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Untuk di Ketahui")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Untuk di Ketahui</option>
                                <option value="Untuk di Manfaatkan"
                                    <?php 
                                        foreach($klasifikasi as $value)
                                        {
                                            if($value == "Untuk di Manfaatkan")
                                            {
                                                echo " Selected";
                                            }
                                        } 
                                    ?>
                                >Untuk di Manfaatkan</option>
                            </select>
                        </div>
                        <div class="col-sm-5 col-xs-12 form-group">
                            <label>Level Kepentingan</label>
                            <select class="form-control" id="txtlevelkepentingan" name="txtlevelkepentingan">
                                <option value="Rendah" <?php if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Rendah") { echo " Selected"; } ?>>Rendah</option>
                                <option value="Sedang" <?php if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Sedang") { echo " Selected"; } ?>>Sedang</option>
                                <option value="Tinggi" <?php if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Tinggi") { echo " Selected"; } ?>>Tinggi</option>
                                <option value="Mendesak" <?php if($datatmp[0]['PT_LEVEL_KEPENTINGAN'] == "Mendesak") { echo " Selected"; } ?>>Mendesak</option>
                            </select>
                        </div>

                        <div class="col-xs-12">
                            <hr class="hr" />
                        </div>

                        <div class="col-sm-4 col-xs-6 form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" id="txtnomorsurat" name="txtnomorsurat"  value="<?php echo $datatmp[0]['PT_NOMOR_SURAT'] ?>" />
                        </div>
                        <div class="col-sm-4 col-xs-6 form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" id="txttglsurat" name="txttglsurat" value="<?php if($datatmp[0]['PT_TANGGAL_SURAT']!=""){ echo date('Y-m-d',strtotime($datatmp[0]['PT_TANGGAL_SURAT'])); } ?>"/>
                        </div>
                        <div class="col-sm-4 col-xs-12 form-group">
                            <label>Asal Surat</label>
                            <input type="text" class="form-control" id="txtasalsurat" name="txtasalsurat"  value="<?php echo $datatmp[0]['PT_ASAL_SURAT'] ?>"/>
                        </div>

                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" rows="3" id="txtcatatan" name="txtcatatan"><?php echo $datatmp[0]['PT_CATATAN'] ?></textarea>
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
                $('#txtnippic').select2();
                $("#txtklasifikasi").select2({tags: true });
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
                    url:"modul/master/ubahtugas.php",    
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
        </script>
    </body>
</html>




