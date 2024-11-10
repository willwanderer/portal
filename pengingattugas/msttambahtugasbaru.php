<!DOCTYPE html>
<html>
    <head>
        <?php 
            include("metacss.php"); 
        ?>
    </head>
    <body class="skin-blue" onload="kondisiload()">
        <div class="box box-warning">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Tambah Tugas Baru</h3>
            </div><!-- /.box-header -->
            <form id="formkirim">
                <div class="box-body">
                
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Judul Tugas</label>
                                <input type="text" class="form-control" id="txtjudultugas" name="txtjudultugas" />
                            </div>
                            <div class="form-group">
                                <label>Detail Tugas</label>
                                <textarea class="form-control" rows="3" id="txtdetailtugas" name="txtdetailtugas"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 form-group">
                            <label>Penanggungjawab</label><br>
                            <select id="txtnippic" name="txtnippic" class="form-control" style="width: 100%; min-height: 500px !important; overflow: auto;">
                                <option value="Tidak Ada">Tidak Ada</option>
                                <option value="Semua Pegawai">Semua Pegawai</option>
                                <option value="Pemeriksa Ahli Madya">Pemeriksa Ahli Madya</option>
                                <option value="Pemeriksa Ahli Muda">Pemeriksa Ahli Muda</option>
                                <?php
                                    foreach ($_SESSION['dtpegawai'] as $key => $value)
                                    {
                                        ?>
                                            <option value="<?php echo $value['PEG_NIP_LAMA'] ?>"><?php echo $value['PEG_NAMA'] ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                            <label>Tanggal Disposisi</label>
                            <input type="date" class="form-control" id="txttgldisposisi" name="txttgldisposisi" />   
                        </div>
                        <div class="col-sm-3 col-xs-6 form-group">
                            <label>Batas Waktu</label>
                            <input type="date" class="form-control" id="txttglbataswaktu" name="txttglbataswaktu" />
                        </div>
                        <div class="col-sm-7 col-xs-12 form-group">
                            <label>Klasifikasi</label><br>
                            <select id="txtklasifikasi" name="txtklasifikasi[]" class="form-control" multiple="multiple" style="width: 100%;" >
                                <option value="">-- Pilih Klasifikasi --</option>
                                <option value="Tindaklanjuti">Tindaklanjuti</option>
                                <option value="Pelajari">Pelajari</option>
                                <option value="Edarkan">Edarkan</option>
                                <option value="Sosialisasikan">Sosialisasikan</option>
                                <option value="Untuk Menjadi Perhatian">Untuk Menjadi Perhatian</option>
                                <option value="Bicarakan Bersama">Bicarakan Bersama</option>
                                <option value="Tembusan dari Kepala Perwakilan">Tembusan dari Kepala Perwakilan</option>
                                <option value="Untuk di Monitor">Untuk di Monitor</option>
                                <option value="Untuk di Pedomani">Untuk di Pedomani</option>
                                <option value="Untuk di Ketahui">Untuk di Ketahui</option>
                                <option value="Untuk di Manfaatkan">Untuk di Manfaatkan</option>
                            </select>
                        </div>
                        <div class="col-sm-5 col-xs-12 form-group">
                            <label>Level Kepentingan</label>
                            <select class="form-control" id="txtlevelkepentingan" name="txtlevelkepentingan">
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                                <option value="Mendesak">Mendesak</option>
                            </select>
                        </div>

                        <div class="col-xs-12">
                            <hr class="hr" />
                        </div>

                        <div class="col-sm-4 col-xs-6 form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" id="txtnomorsurat" name="txtnomorsurat" />
                        </div>
                        <div class="col-sm-4 col-xs-6 form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" id="txttglsurat" name="txttglsurat" />
                        </div>
                        <div class="col-sm-4 col-xs-12 form-group">
                            <label>Asal Surat</label>
                            <input type="text" class="form-control" id="txtasalsurat" name="txtasalsurat" />
                        </div>

                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" rows="3" id="txtcatatan" name="txtcatatan"></textarea>
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
                $('#txttgldisposisi').val("<?php echo date('Y-m-d'); ?>");

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
                    url:"modul/master/simpantugas.php",    
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
    </body>
</html>




