<!DOCTYPE html>
<html>
    <head>
        <?php 
            include("metacss.php"); 

            $totaltugas=0;
            $tugasdalamproses=0;
            $tugasbelumproses=0;
            $tugasdeadline=0;

            $result = $con->query("SELECT count(*) as 'jumlahc' FROM `pengingat_tugas`");
            while($row = $result->fetch_assoc()) 
            {
                $totaltugas=$row["jumlahc"];
            }

            $result = $con->query("SELECT count(*) as 'jumlahc' FROM `pengingat_tugas` where PT_STATUS='Dikerjakan'");
            while($row = $result->fetch_assoc()) 
            {
                $tugasdalamproses=$row["jumlahc"];
            }

            $result = $con->query("SELECT count(*) as 'jumlahc' FROM `pengingat_tugas` where PT_STATUS='DiTugaskan'");
            while($row = $result->fetch_assoc()) 
            {
                $tugasbelumproses=$row["jumlahc"];
            }

            $result = $con->query("SELECT count(*) as 'jumlahc' from pengingat_tugas where DATEDIFF(PT_TANGGAL_AKHIR, now()) <= " . $btsharideadline . " and (PT_STATUS <> 'Selesai' and PT_STATUS <> 'Batal')");
            while($row = $result->fetch_assoc()) 
            {
                $tugasdeadline=$row["jumlahc"];
            }

            $batastugas = date('d/m/Y');

        ?>
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
                        Dashboard
                        <small>Pengingat Tugas</small>
                    </h1>
                    <?php
                        if(!empty($_SESSION['portalnipbaru']))
                        {   
                            ?>
                               <ol class="breadcrumb">
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-success btn-sm" data-toggle="tooltip" title="Tambah Tugas Baru" onclick="tambahtugasbaru()"><i class="fa fa-plus"></i> Tambah Tugas Baru</i></button>
                                    </div>
                                </ol>
                            <?php
                        }
                    ?>
                    
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $tugasdeadline; ?>
                                    </h3>
                                    <p>
                                        Deadline Tugas
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <a href="mstdaftartugas.php?levelkepentingan=&statustugas=&tanggaldispoawal=&tanggaldispoakhir=&tanggalbatasawal=<?php echo $batastugas ?>&tanggalbatasakhir=<?php echo date('d/m/Y', strtotime($batastugas. ' + 3 days')) ?>" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $tugasbelumproses; ?>
                                    </h3>
                                    <p>
                                        Tugas Belum di Proses
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-exclamation-circle"></i>
                                </div>
                                <a href="mstdaftartugas.php?levelkepentingan=&statustugas=DiTugaskan&tanggaldispoawal=&tanggaldispoakhir=&tanggalbatasawal=&tanggalbatasakhir=" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $tugasdalamproses; ?>
                                    </h3>
                                    <p>
                                        Tugas dalam Proses
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-desktop"></i>
                                </div>
                                <a href="mstdaftartugas.php?levelkepentingan=&statustugas=Dikerjakan&tanggaldispoawal=&tanggaldispoakhir=&tanggalbatasawal=&tanggalbatasakhir=" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $totaltugas; ?>
                                    </h3>
                                    <p>
                                        Tugas Keseluruhan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <a href="mstdaftartugas.php" class="small-box-footer">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        
                        
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 

                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <h3 class="box-title">Daftar Tugas Mendesak</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Tugas</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Batas Waktu</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                            $nomor = 1;
                                            $kuery="SELECT *, DATEDIFF(PT_TANGGAL_AKHIR, now()) as 'PT_SISA_HARI', DATEDIFF(now(), PT_TANGGAL_AWAL) as 'PT_HARI_LEWAT' from pengingat_tugas where PT_LEVEL_KEPENTINGAN='Mendesak' and (PT_STATUS <> 'Selesai' and PT_STATUS <> 'Batal')";
                                            $result = $con->query($kuery);
                                            while($row = $result->fetch_assoc()) 
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $nomor;?></td>
                                                        <td>
                                                            <?php 
                                                                echo $row['PT_JUDUL'] . "<br/>"; 
                                                                echo tampilkepentingan($row['PT_LEVEL_KEPENTINGAN']);
                                                            ?>
                                                            <span class="badge" style="background-color: #3C8DBC;"><i class="fa fa-calendar"></i>
                                                                <?php 
                                                                    echo $row['PT_HARI_LEWAT'];
                                                                ?> hari setelah Disposisi
                                                            </span>
                                                        </td>
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
                                                                if($row['PT_TANGGAL_AKHIR']!="")
                                                                {
                                                                    if($row['PT_SISA_HARI'] < 0)
                                                                    {
                                                                        if($row['PT_STATUS']!="Selesai" || $row['PT_STATUS']!="Batal")
                                                                        {
                                                                            ?>
                                                                                <span class="badge blink" style="background-color: #D9534F;">Terlewat <?php echo $row['PT_SISA_HARI'] *-1 ?> hari.</span><br>
                                                                            <?php
                                                                        }
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
                                                            <a type="button" class="btn-xs btn-success" style="cursor: pointer;" onclick="riwayattugas('<?php echo $row['PT_ID'] ?>')"><i class="fa fa-eye" ></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $nomor ++;
                                            }
                                        ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>

                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <h3 class="box-title">Daftar Tugas Deadline (H-<?php echo $btsharideadline ?> hari)</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Tugas</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Batas Waktu</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                            $nomor = 1;
                                            $kuery="SELECT *, DATEDIFF(PT_TANGGAL_AKHIR, now()) as 'PT_SISA_HARI', DATEDIFF(now(), PT_TANGGAL_AWAL) as 'PT_HARI_LEWAT' from pengingat_tugas where DATEDIFF(PT_TANGGAL_AKHIR, now()) <= " . $btsharideadline . " and (PT_STATUS <> 'Selesai' and PT_STATUS <> 'Batal') order by PT_TANGGAL_AKHIR asc";
                                            $result = $con->query($kuery);
                                            while($row = $result->fetch_assoc()) 
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $nomor;?></td>
                                                        <td>
                                                            <?php 
                                                                echo $row['PT_JUDUL'] . "<br/>"; 
                                                                echo tampilkepentingan($row['PT_LEVEL_KEPENTINGAN']);
                                                            ?>
                                                            <span class="badge" style="background-color: #3C8DBC;"><i class="fa fa-calendar"></i>
                                                                <?php 
                                                                    echo $row['PT_HARI_LEWAT'];
                                                                ?> hari setelah Disposisi
                                                            </span>
                                                        </td>
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
                                                                if($row['PT_TANGGAL_AKHIR']!="")
                                                                {
                                                                    if($row['PT_SISA_HARI'] < 0)
                                                                    {
                                                                        if($row['PT_STATUS']!="Selesai" || $row['PT_STATUS']!="Batal")
                                                                        {
                                                                            ?>
                                                                                <span class="badge blink" style="background-color: #D9534F;">Terlewat <?php echo $row['PT_SISA_HARI'] *-1 ?> hari.</span><br>
                                                                            <?php
                                                                        }
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
                                                            <a type="button" class="btn-xs btn-success" style="cursor: pointer;" onclick="riwayattugas('<?php echo $row['PT_ID'] ?>')"><i class="fa fa-eye" ></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $nomor ++;
                                            }
                                        ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>

                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Daftar Tugas Belum Selesai</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Tugas</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Batas Waktu</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                            $nomor = 1;
                                            $kuery="SELECT *, DATEDIFF(PT_TANGGAL_AKHIR, now()) as 'PT_SISA_HARI', DATEDIFF(now(), PT_TANGGAL_AWAL) as 'PT_HARI_LEWAT' from pengingat_tugas where (PT_STATUS <> 'Selesai' and PT_STATUS <> 'Batal') order by PT_TANGGAL_AKHIR asc";
                                            $result = $con->query($kuery);
                                            while($row = $result->fetch_assoc()) 
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $nomor;?></td>
                                                        <td>
                                                            <?php 
                                                                echo $row['PT_JUDUL'] . "<br/>"; 
                                                                echo tampilkepentingan($row['PT_LEVEL_KEPENTINGAN']);
                                                            ?>
                                                            <span class="badge" style="background-color: #3C8DBC;"><i class="fa fa-calendar"></i>
                                                                <?php 
                                                                    echo $row['PT_HARI_LEWAT'];
                                                                ?> hari setelah Disposisi
                                                            </span>
                                                        </td>
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
                                                                if($row['PT_TANGGAL_AKHIR']!="")
                                                                {
                                                                    if($row['PT_SISA_HARI'] < 0)
                                                                    {
                                                                        if($row['PT_STATUS']!="Selesai" || $row['PT_STATUS']!="Batal")
                                                                        {
                                                                            ?>
                                                                                <span class="badge blink" style="background-color: #D9534F;">Terlewat <?php echo $row['PT_SISA_HARI'] *-1 ?> hari.</span><br>
                                                                            <?php
                                                                        }
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
                                                            <a type="button" class="btn-xs btn-success" style="cursor: pointer;" onclick="riwayattugas('<?php echo $row['PT_ID'] ?>')"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $nomor ++;
                                            }
                                        ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                            

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">

                            <!-- Calendar -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">Calendar</div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="kalender"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        <?php include("javas.php"); ?>

        <script type="text/javascript">

            function kondisiload()
            {
                setmenu();

                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate();
                m = date.getMonth();
                y = date.getFullYear();

                //Calendar
                $('#kalender').fullCalendar({
                    editable: false, //Enable drag and drop
                    events: [
                        <?php
                            $nomor = 1;
                            $kuery="SELECT * from pengingat_tugas where PT_TANGGAL_AKHIR is not null";
                            $result = $con->query($kuery);
                            while($row = $result->fetch_assoc()) 
                            {
                                if($nomor == 1)
                                {
                                    ?>
                                        {
                                            title: '<?php echo substr($row['PT_JUDUL'],0,22) . "..." ?>',
                                            start: new Date(<?php echo substr($row['PT_TANGGAL_AKHIR'],0,4) ?>, <?php echo substr($row['PT_TANGGAL_AKHIR'],5,2)-1 ?>,<?php echo substr($row['PT_TANGGAL_AKHIR'],8,2) ?>),
                                            backgroundColor: "<?php
                                                if($row['PT_LEVEL_KEPENTINGAN'] == "Rendah")
                                                {
                                                  echo '#F8F9FA';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Sedang")
                                                {
                                                  echo '#28A745';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Tinggi")
                                                {
                                                  echo '#FFC107';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Mendesak")
                                                {
                                                  echo '#DC3545';
                                                }
                                            ?>",
                                            borderColor: "<?php
                                                if($row['PT_LEVEL_KEPENTINGAN'] == "Rendah")
                                                {
                                                  echo '#F8F9FA';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Sedang")
                                                {
                                                  echo '#28A745';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Tinggi")
                                                {
                                                  echo '#FFC107';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Mendesak")
                                                {
                                                  echo '#DC3545';
                                                }
                                            ?>",
                                            url: "mstdaftartugas.php?levelkepentingan=&statustugas=&tanggaldispoawal=&tanggaldispoakhir=&tanggalbatasawal=<?php echo date('d/m/Y', strtotime($row['PT_TANGGAL_AKHIR'])) ?>&tanggalbatasakhir=<?php echo date('d/m/Y', strtotime($row['PT_TANGGAL_AKHIR'])) ?>",
                                            textColor: "#333333"
                                        }
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        ,
                                        {
                                            title: '<?php echo substr($row['PT_JUDUL'],0,22) . "..." ?>',
                                            start: new Date(<?php echo substr($row['PT_TANGGAL_AKHIR'],0,4) ?>, <?php echo substr($row['PT_TANGGAL_AKHIR'],5,2)-1 ?>,<?php echo substr($row['PT_TANGGAL_AKHIR'],8,2) ?>),
                                            backgroundColor: "<?php
                                                if($row['PT_LEVEL_KEPENTINGAN'] == "Rendah")
                                                {
                                                  echo '#F8F9FA';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Sedang")
                                                {
                                                  echo '#28A745';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Tinggi")
                                                {
                                                  echo '#FFC107';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Mendesak")
                                                {
                                                  echo '#DC3545';
                                                }
                                            ?>",
                                            borderColor: "<?php
                                                if($row['PT_LEVEL_KEPENTINGAN'] == "Rendah")
                                                {
                                                  echo '#F8F9FA';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Sedang")
                                                {
                                                  echo '#28A745';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Tinggi")
                                                {
                                                  echo '#FFC107';
                                                }
                                                elseif($row['PT_LEVEL_KEPENTINGAN'] == "Mendesak")
                                                {
                                                  echo '#DC3545';
                                                }
                                            ?>",
                                            url: "mstdaftartugas.php?levelkepentingan=&statustugas=&tanggaldispoawal=&tanggaldispoakhir=&tanggalbatasawal=<?php echo date('d/m/Y', strtotime($row['PT_TANGGAL_AKHIR'])) ?>&tanggalbatasakhir=<?php echo date('d/m/Y', strtotime($row['PT_TANGGAL_AKHIR'])) ?>",
                                            textColor: "#333333"
                                        }
                                    <?php
                                }
                                $nomor ++;
                            }
                        ?>
                    ],
                    buttonText: {//This is to add icons to the visible buttons
                        prev: "<span class='fa fa-caret-left'></span>",
                        next: "<span class='fa fa-caret-right'></span>",
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
                    header: {
                        left: 'title',
                        center: '',
                        right: 'prev,next'
                    },
                    eventClick: function(info) {
                        info.jsEvent.preventDefault();
                        if (info.event.url) {
                          
                            riwayattugas(info.event.url);
                        }
                    }
                });
            }
            
            function tambahtugasbaru()
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
            
        </script>
    </body>
</html>