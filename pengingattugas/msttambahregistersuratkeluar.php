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
                <h3 class="box-title">Tambah Register Surat Keluar</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form id="formkirim">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input id="txttanggal" name="txttanggal" type="date" class="form-control" onchange="ubahnomorsurat()"/>
                    </div>

                    <div class="form-group">
                        <label>Nomor Surat Keluar</label>
                        <input id="txtnomorsuratkeluar" name="txtnomorsuratkeluar" type="text" class="form-control" onkeyup="cekiddouble()" />
                    </div>

                    <div class="form-group">
                        <label>Perihal</label>
                        <textarea id="txtperihal" name="txtperihal" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tujuan</label>
                        <input id="txttujuan" name="txttujuan" type="text" class="form-control"/>
                    </div>
                </form>
                    <div class="box-footer clearfix">
                        <button class="pull-right btn btn-warning" onclick="simpansurkel()"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <?php include("javas.php"); ?>

        <script type="text/javascript">
            function kondisiload()
            {
                $('#txttanggal').val("<?php echo date('Y-m-d'); ?>");
                $('#txttanggal').attr({"min" : '<?php echo date('Y') ?>-01-01'});
                $('#txttanggal').attr({"max" : '<?php echo date('Y') ?>-12-31'});

                ubahnomorsurat();
            }

            function ubahnomorsurat()
            {
                swal.fire(
                {
                    title:"Menyiapkan Data",
                    text: "Menunggu Untuk menyiapkan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });

                var kirimdata= {};
                kirimdata.tanggal = $('#txttanggal').val();
                $.ajax(
                {
                    type:"POST",
                    url:"modul/master/getnomorsurat.php",    
                    data: kirimdata,
                    cache: false,
                    success: function(data)
                    {
                        $('#txtnomorsuratkeluar').val(data);
                    }
                });

                swal.close();
                
            }
            function simpansurkel()
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
                    url:"modul/master/simpansurkel.php",    
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

            function cekiddouble()
            {
                var kirimdata= {};
                kirimdata.nosurat = $('#txtnomorsuratkeluar').val();
                $.ajax(
                {
                    type:"POST",
                    url:"modul/master/ceknomorsurat.php",    
                    data: kirimdata,
                    cache: false,
                    success: function(data)
                    {
                        if(data>=1)
                        {
                            swal.fire({
                                title: "Nomor Sudah Dipakai",
                                text: "Nomor " + $('#txtnomorsuratkeluar').val() + " Telah digunakan. Apakah anda ingin mengganti Nomor Surat Keluar?",
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonText: 'Ganti Nomor Surat Keluar',
                                cancelButtonText: 'Lanjutkan',
                                closeOnConfirm: false
                            }).then((hasil) =>
                            {
                                if(hasil.isConfirmed)
                                {
                                    ubahnomorsurat();
                                }
                                else
                                {
                                    $('#txtperihal').focus();
                                }
                            });
                        }
                    }
                });

                
            }
        </script>
    </body>
</html>




