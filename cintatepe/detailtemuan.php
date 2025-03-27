<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Cinta TEPE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../img/logo/CintaTepe1.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/utama.css" rel="stylesheet">
    <link href="css/loading.scss" rel="stylesheet">
    <style type="text/css">
        body
        {
            background:#dcdcdc;
            margin-top:20px;
        }

        .floating-button {
            position: fixed; /* Menggunakan fixed agar tetap di posisi yang sama saat scroll */
            bottom: 20px; /* Jarak dari bawah */
            right: 20px; /* Jarak dari kanan */
            background-color: #007BFF; /* Warna latar belakang */
            color: white; /* Warna teks */
            border: none; /* Tanpa border */
            border-radius: 50%; /* Membuat tombol bulat */
            width: 60px; /* Lebar tombol */
            height: 60px; /* Tinggi tombol */
            font-size: 24px; /* Ukuran font */
            cursor: pointer; /* Menunjukkan bahwa ini adalah tombol yang dapat diklik */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Bayangan */
            transition: background-color 0.3s; /* Transisi untuk efek hover */
            display: flex; /* Menggunakan flexbox untuk memusatkan ikon */
            align-items: center; /* Memusatkan secara vertikal */
            justify-content: center; /* Memusatkan secara horizontal */
        }

        .floating-button:hover {
            background-color: #0056b3; /* Warna saat hover */
        }
    </style>
    <?php
        include('..\modul\pengaturan\KoneksiDBPorste.php');    
    ?>
</head>
<body onload="kondisiload()" >
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body">
                        <div class="col-lg-12">
                            <div class="search-result">
                                <div class="result-body">
                                    <div class="table-responsive">
                                        <button type="button" onclick="window.history.go(-1); Location.reload ();" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;&nbsp;Kembali</button>
                                        <?php
                                            $kuery="SELECT * FROM caseviews where case_id='" . $_GET['idtemuan'] . "'";

                                            $stmt = $pdo->query($kuery);
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($results as $row) 
                                            {
                                                ?>
                                                <h2><?php echo $row['case_name']; ?></h2>
                                                <p>
                                                    <span class="badge badge-primary"><i class="fas fa-university"></i> <?php echo $row['entity_name']; ?></span>
                                                    <span class="badge badge-secondary"><i class="fas fa-briefcase"></i> <?php echo $row['branch_name']; ?></span>
                                                    <span class="badge badge-success"><i class="fas fa-briefcase"></i> <?php echo $row['type_name']; ?></span>
                                                    <span class="badge badge-danger"><i class="fas fa-briefcase"></i> <?php echo $row['opinion_name']; ?></span>
                                                    <span class="badge badge-warning"><i class="fas fa-briefcase"></i> <?php echo $row['slate_name']; ?></span>
                                                    <span class="badge badge-info"><i class="fas fa-book"></i> <?php echo $row['advisory_number']; ?></span>
                                                    <span class="badge badge-success"><a href="<?php echo $row['case_url']; ?>" target="_blank"><i class="fas fa-book"></i> Lihat di SMP</a></span>
                                                </p>
                                                <h4>Kondisi</h4>
                                                <p><?php echo $row['condition']; ?></p>
                                                <h4>Kriteria</h4>
                                                <p><?php echo $row['criteria']; ?></p>
                                                <h4>Sebab</h4>
                                                <p><?php echo $row['cause']; ?></p>
                                                <h4>Akibat</h4>
                                                <p><?php echo $row['effect']; ?></p>
                                                <h4>Rekomendasi</h4>
                                                <p>
                                                <?php
                                                    $kueryrekom="SELECT * FROM recommendations where case_id='" . $_GET['idtemuan'] . "' order by id asc";

                                                    $stmtrek = $pdo->query($kueryrekom);
                                                    $resultrek = $stmtrek->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($resultrek as $rowrek) 
                                                    {
                                                        echo $rowrek['content']."<br>";
                                                    }
                                                ?>
                                                </p>
                                                <?php
                                            }    
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<button class="floating-button" id="playButton" onclick="toggleMusic()">
    <i class="fas fa-play" id="playIcon"></i> <!-- Ikon play dari Font Awesome -->
</button>

<!-- <audio id="audio" src="ZIGAZ - SAHABAT JADI CINTA.mp3" autoplay="autoplay" loop="loop"></audio> -->

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="../js/sweetalert2/package/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../js/sweetalert2/package/dist/sweetalert2.min.css">

<script type="text/javascript">


    // const audio = document.getElementById('audio');
    // const playButton = document.getElementById('playButton');
    // const playIcon = document.getElementById('playIcon');

    // function toggleMusic() {
    //     if (audio.paused) {
    //         audio.play();
    //         playIcon.classList.remove('fa-play'); // Menghapus ikon play
    //         playIcon.classList.add('fa-pause'); // Menambahkan ikon pause
    //     } else {
    //         audio.pause();
    //         playIcon.classList.remove('fa-pause'); // Menghapus ikon pause
    //         playIcon.classList.add('fa-play'); // Menambahkan ikon play
    //     }
    // }

	function mulaicari()
    {
        halaman = "hasilpencarian.php?katakunci=" + $('#txtkatakunci').val();
        window.location=halaman;
    }

    $("#txtkatakunci").on("keydown", function(event) {
      if(event.which == 13)
      {
        mulaicari();
      }
    });
</script>
</body>
</html>