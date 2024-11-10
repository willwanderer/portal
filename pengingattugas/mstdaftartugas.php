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
                        <small>Daftar Tugas</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-tasks"></i> Home</a></li>
                        <li class="active">Daftar Tugas</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">                                        
                                <button class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Tambah Surat Keluar" onclick="tambahtugas()"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Tugas</button>
                            </div><!-- /. tools -->

                            <h3 class="box-title">
                                Daftar Tugas
                            </h3>                             
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-12">
                                <div class="col-md-2 col-xs-3 form-group">
                                    <label>Level Kepentingan</label>
                                    <select class="form-control" id="txtlevelkepentingan" name="txtlevelkepentingan">
                                        <option value="" 
                                            <?php
                                                if(isset($_GET['levelkepentingan']))
                                                {
                                                    if($_GET['levelkepentingan']=="")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >--Semua--</option>
                                        <option value="Rendah"
                                            <?php
                                                if(isset($_GET['levelkepentingan']))
                                                {
                                                    if($_GET['levelkepentingan']=="Rendah")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >Rendah</option>
                                        <option value="Sedang"
                                            <?php
                                                if(isset($_GET['levelkepentingan']))
                                                {
                                                    if($_GET['levelkepentingan']=="Sedang")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >Sedang</option>
                                        <option value="Tinggi"
                                            <?php
                                                if(isset($_GET['levelkepentingan']))
                                                {
                                                    if($_GET['levelkepentingan']=="Tinggi")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >Tinggi</option>
                                        <option value="Mendesak"
                                            <?php
                                                if(isset($_GET['levelkepentingan']))
                                                {
                                                    if($_GET['levelkepentingan']=="Mendesak")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >Mendesak</option>
                                    </select>
                                </div>

                                <div class="col-md-2 col-xs-3 form-group">
                                    <label>Status Tugas</label>
                                    <select class="form-control" id="txtstatustugas" name="txtstatustugas">
                                        <option value=""
                                            <?php
                                                if(isset($_GET['statustugas']))
                                                {
                                                    if($_GET['statustugas']=="")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >--Semua--</option>
                                        <option value="DiTugaskan"
                                            <?php
                                                if(isset($_GET['statustugas']))
                                                {
                                                    if($_GET['statustugas']=="DiTugaskan")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >DiTugaskan</option>
                                        <option value="Dikerjakan"
                                            <?php
                                                if(isset($_GET['statustugas']))
                                                {
                                                    if($_GET['statustugas']=="Dikerjakan")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >DiKerjakan</option>
                                        <option value="Selesai"
                                            <?php
                                                if(isset($_GET['statustugas']))
                                                {
                                                    if($_GET['statustugas']=="Selesai")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >Selesai</option>
                                        <option value="Batal"
                                            <?php
                                                if(isset($_GET['statustugas']))
                                                {
                                                    if($_GET['statustugas']=="Batal")
                                                    {
                                                        echo " Selected";
                                                    }
                                                }
                                            ?>
                                        >Batal</option>
                                    </select>
                                </div>

                                <div class="col-md-3 col-xs-3 form-group">
                                    <label>Tanggal Disposisi</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="txttanggaldisposisi" name="txttanggaldisposisi" 
                                            <?php
                                                if(isset($_GET['tanggaldispoawal']))
                                                {
                                                    if($_GET['tanggaldispoawal']!="")
                                                    {
                                                        echo ' value="' . $_GET['tanggaldispoawal'] . '-' . $_GET['tanggaldispoakhir'] . '"';
                                                    }
                                                }
                                            ?>
                                        />
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-3 form-group">
                                    <label>Tanggal Berakhir</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="txttanggalberakhir" name="txttanggalberakhir" 
                                            <?php
                                                if(isset($_GET['tanggalbatasawal']))
                                                {
                                                    if($_GET['tanggalbatasawal']!="")
                                                    {
                                                        echo ' value="' . $_GET['tanggalbatasawal'] . '-' . $_GET['tanggalbatasakhir'] . '"';
                                                    }
                                                }
                                            ?>
                                        />
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-12 form-group" style="padding-top: 25px;">
                                    <a type="button" class="btn btn-success" style="cursor: pointer;" onclick="filterdata()"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</a>
                                    <a type="button" class="btn btn-warning" style="cursor: pointer;" onclick="clearfilter()"><i class="fa fa-ban"></i>&nbsp;&nbsp;Kosongkan</a>
                                </div>

                            </div>
                            <br><br>
                            <div class="col-md-12">
                                <hr class="hr" />
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal Disposisi</th>
                                        <th>Judul</th>
                                        <th>Penanggungjawab</th>
                                        <th>Batas Waktu</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $filterkuery="";
                                        if(isset($_GET['levelkepentingan']))
                                        {
                                            if($_GET['levelkepentingan']!="")
                                            {
                                                $filterkuery=" and PT_LEVEL_KEPENTINGAN='" . $_GET['levelkepentingan'] . "'";
                                            }
                                        }
                                        if(isset($_GET['statustugas']))
                                        {
                                            if($_GET['statustugas']!="")
                                            {
                                                $filterkuery= $filterkuery . " and PT_STATUS='" . $_GET['statustugas'] . "'";
                                            }
                                        }
                                        if(isset($_GET['tanggaldispoawal']))
                                        {
                                            if($_GET['tanggaldispoawal']!="")
                                            {
                                                $filterkuery= $filterkuery . " and (PT_TANGGAL_AWAL BETWEEN '" . ubahformattgl($_GET['tanggaldispoawal'],'PHP') . "' and '" . ubahformattgl($_GET['tanggaldispoakhir'],'PHP') . "')";
                                            }
                                        }
                                        if(isset($_GET['tanggalbatasawal']))
                                        {
                                            if($_GET['tanggalbatasawal']!="")
                                            {
                                                $filterkuery= $filterkuery . " and (PT_TANGGAL_AKHIR BETWEEN '" . ubahformattgl($_GET['tanggalbatasawal'],'PHP') . "' and '" . ubahformattgl($_GET['tanggalbatasakhir'],'PHP') . "')";
                                            }
                                        }

                                        $kuery="SELECT *, DATEDIFF(PT_TANGGAL_AKHIR, now()) as 'PT_SISA_HARI' from pengingat_tugas where UO_ID='" . $_SESSION['portalidunitkerja'] . "' " . $filterkuery;
                                        $result = $con->query($kuery);
                                        while($row = $result->fetch_assoc()) 
                                        {  
                                            ?>
                                            <tr>
                                                <td><?php echo date('d M Y',strtotime($row['PT_TANGGAL_AWAL'])) ?></td>
                                                <td>
                                                    <?php 
                                                        echo $row['PT_JUDUL'] . "<br/>"; 
                                                        echo tampilkepentingan($row['PT_LEVEL_KEPENTINGAN']);
                                                    ?> </td>
                                                <td>
                                                    <?php 
                                                        $penanggungjawab = $row['PEG_NIP_LAMA'];
                                                        foreach ($_SESSION['dtpegawai'] as $key => $value)
                                                        {
                                                           if($value['PEG_NIP_LAMA'] == $row['PEG_NIP_LAMA'])
                                                           {
                                                                $penanggungjawab = $value['PEG_NAMA'];
                                                           }
                                                        } 
                                                        echo $penanggungjawab;
                                                    ?>
                                                        
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($row['PT_TANGGAL_AKHIR']!="" && ($row['PT_STATUS']!="Selesai" && $row['PT_STATUS']!="Batal"))
                                                        {
                                                            if($row['PT_SISA_HARI'] < 0)
                                                            {
                                                                ?>
                                                                    <span class="badge blink" style="background-color: #D9534F;">Terlewat <?php echo $row['PT_SISA_HARI'] *-1 ?> hari.</span><br>
                                                                <?php
                                                            }
                                                            elseif($row['PT_SISA_HARI'] <=$btsharideadline && $row['PT_SISA_HARI'] >= 0)
                                                            {
                                                                ?>
                                                                    <span class="badge blink" style="background-color: #D9534F;"><?php echo $row['PT_SISA_HARI'] ?> hari tersisa</span><br>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                    <span class="badge" style="background-color: #F39C12;"><?php echo $row['PT_SISA_HARI'] ?> hari tersisa</span><br>
                                                                <?php
                                                            }
                                                            
                                                        }
                                                        if($row['PT_TANGGAL_AKHIR'] != "")
                                                        {
                                                            echo date('d M Y',strtotime($row['PT_TANGGAL_AKHIR']));
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        echo $row['PT_CATATAN'];
                                                        if($row['PT_CATATAN'] != "")
                                                        {
                                                            echo "<br/>";
                                                        }
                                                        $klasifikasi = explode(",", $row['PT_KLASIFIKASI_TUGAS']);
                                                        foreach($klasifikasi as $value)
                                                        {
                                                            ?>
                                                                <span class="badge" style="background-color: #3C8DBC;"><?php echo $value ?></span>
                                                            <?php
                                                        }
                                                    ?> 
                                                </td>
                                                <td><?php echo tampilstatustugas($row['PT_STATUS']) ?></td>
                                                <td>
                                                    <a type="button" class="btn-xs btn-success" style="cursor: pointer;" onclick="riwayattugas('<?php echo $row['PT_ID'] ?>')"><i class="fa fa-eye" ></i></a>
                                                    <a type="button" class="btn-xs btn-primary" style="cursor: pointer;" onclick="ubahtugas('<?php echo $row['PT_ID'] ?>')"><i class="fa fa-pencil" ></i></a>
                                                    <a type="button" class="btn-xs btn-danger" style="cursor: pointer;" onclick="hapustugas('<?php echo $row['PT_ID'] ?>')"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal Disposisi</th>
                                        <th>Judul</th>
                                        <th>Penanggungjawab</th>
                                        <th>Batas Waktu</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
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
                $("#example1").dataTable({aaSorting: [[5, 'asc']]});

                $('#txttanggaldisposisi').daterangepicker(
                {
                    ranges: {
                        'Hari Ini': [moment(), moment()],
                        'Kemarin': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        '7 Hari Terakhir': [moment().subtract('days', 6), moment()],
                        '30 Hari Terakhir': [moment().subtract('days', 29), moment()],
                        'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                        'Bulan Lalu': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    startDate: moment().subtract('days', 29),
                    endDate: moment()
                },
                function(start, end) {
                    $('#txttanggaldisposisi').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
                }
                );

                $('#txttanggalberakhir').daterangepicker(
                {
                    ranges: {
                        'Hari Ini': [moment(), moment()],
                        'Kemarin': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        '7 Hari Terakhir': [moment().subtract('days', 6), moment()],
                        '30 Hari Terakhir': [moment().subtract('days', 29), moment()],
                        'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                        'Bulan Lalu': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    startDate: moment().subtract('days', 29),
                    endDate: moment()
                },
                function(start, end) {
                    $('#txttanggalberakhir').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
                }
                );
            }

            function tambahtugas()
            {
                $.fancybox.open(
                {
                    maxHeight   : 600,
                    fitToView   : false,
                    height      : '85%',
                    width       : '60%',
                    autoSize    : false,
                    href        : 'msttambahtugasbaru.php',
                    type        : 'iframe',
                    padding     : 10
                });
            }

            function ubahtugas(idt)
            {
                $.fancybox.open(
                {
                    maxHeight   : 600,
                    fitToView   : false,
                    height      : '85%',
                    width       : '60%',
                    autoSize    : false,
                    href        : 'mstubahtugas.php?idtugas=' + idt,
                    type        : 'iframe',
                    padding     : 10
                });
            }

            function riwayattugas(idt)
            {
                $.fancybox.open(
                {
                    maxHeight   : 600,
                    fitToView   : false,
                    height      : '85%',
                    width       : '60%',
                    autoSize    : false,
                    href        : 'mstriwayattugas.php?idtugas=' + idt,
                    type        : 'iframe',
                    padding     : 10
                });
            }

            function hapustugas(idtugas)
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
                            url:"modul/master/hapustugas.php",    
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

            function filterdata()
            {
                var tanggaldispoawal = "";
                var tanggaldispoakhir = "";
                var tanggalbatasawal = "";
                var tanggalbatasakhir = "";

                if($('#txttanggaldisposisi').val() != "")
                {
                    var bagiarray = $('#txttanggaldisposisi').val().split('-');
                    tanggaldispoawal = bagiarray[0];
                    tanggaldispoakhir = bagiarray[1];
                }

                if($('#txttanggalberakhir').val() != "")
                {
                    var bagiarray = $('#txttanggalberakhir').val().split('-');
                    tanggalbatasawal = bagiarray[0];
                    tanggalbatasakhir = bagiarray[1];
                }

                var levelkepentingan = $('#txtlevelkepentingan').val();
                var statustugas = $('#txtstatustugas').val();

                var halaman = "mstdaftartugas.php?levelkepentingan=" + levelkepentingan + "&statustugas=" + statustugas + "&tanggaldispoawal=" + tanggaldispoawal + "&tanggaldispoakhir=" + tanggaldispoakhir + "&tanggalbatasawal=" + tanggalbatasawal + "&tanggalbatasakhir=" + tanggalbatasakhir;

                window.location.href = halaman;
            }

            function getFormattedDate(date) 
            {
                let year = date.getFullYear();
                let month = (1 + date.getMonth()).toString().padStart(2, '0');
                let day = date.getDate().toString().padStart(2, '0');
              
                return day + '/' + month + '/' + year;
            }

            function clearfilter()
            {
                window.location.href = "mstdaftartugas.php";
            }
        </script>
    </body>
</html>