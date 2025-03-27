<!DOCTYPE html>
<html>
    <head>
        <?php include("metacss.php"); ?>
    </head>
    <body class="skin-blue" onload="kondisiload()">
        <?php include("header.php");?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include("menusamping.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master
                        <small>Register Surat Keluar</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-envelope"></i> Home</a></li>
                        <li class="active">Register Surat Keluar</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">                                        
                                <button class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Tambah Surat Keluar" onclick="tambahregistersuratkeluar()"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Register Surat Keluar</button>
                            </div><!-- /. tools -->

                            <h3 class="box-title">
                                Register Surat Keluar
                            </h3>                             
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>Tujuan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $kuery="SELECT * from register_surat_keluar where UO_ID='" . $_SESSION['portalidunitkerja'] . "' and YEAR(RSK_TANGGAL) = YEAR(now())";
                                        $result = $con->query($kuery);
                                        while($row = $result->fetch_assoc()) 
                                        {  
                                            ?>
                                            <tr>
                                                <td><?php echo $row['RSK_NOMOR_SURAT'] ?></td>
                                                <td><?php 
                                                    echo date('d M Y',strtotime($row['RSK_TANGGAL']));
                                                ?></td>
                                                <td><?php echo $row['RSK_PERIHAL'] ?></td>
                                                <td><?php echo $row['RSK_TUJUAN'] ?></td>
                                                <td>
                                                    <a type="button" class="btn-xs btn-primary" style="cursor: pointer;"><i class="fa fa-pencil" onclick="ubahdetailsurat('<?php echo $row['RSK_ID'] ?>')"></i></a>
                                                    <a type="button" class="btn-xs btn-danger" style="cursor: pointer;" onclick="hapussurat('<?php echo $row['RSK_ID'] ?>')"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>Tujuan</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        <?php include("javas.php"); ?>

        <script type="text/javascript">
            function kondisiload()
            {
                setmenu();
                $("#example1").dataTable({aaSorting: [[0, 'desc']]});
            }

            function tambahregistersuratkeluar()
            {
                $.fancybox.open(
                {
                    maxHeight   : 600,
                    fitToView   : false,
                    height      : '85%',
                    width       : '50%',
                    autoSize    : false,
                    href        : 'msttambahregistersuratkeluar.php',
                    type        : 'iframe',
                    padding     : 10
                });

            }

            function ubahdetailsurat(idsurat)
            {
                $.fancybox.open(
                {
                    maxHeight   : 600,
                    fitToView   : false,
                    height      : '85%',
                    width       : '50%',
                    autoSize    : false,
                    href        : 'mstubahregistersuratkeluar.php?idsurat='+idsurat,
                    type        : 'iframe',
                    padding     : 10
                });
            }
            
            function hapussurat(idsurat)
            {
                swal.fire({
                    title: "Anda Yakin",
                    text: "Apa anda yakin ingin menghapus data Surat Keluar?",
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
                        kirimdata.idsurat = idsurat;
                        $.ajax(
                        {
                            type:"POST",
                            url:"modul/master/hapussurat.php",    
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
                                        window.location.reload();
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