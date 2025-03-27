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
            background-image: url('images/bgaris.png');
            background-repeat: no-repeat;
              background-attachment: fixed;  
              background-size: cover;
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
<body onload="kondisiload()">
<div class="container">
    <div style="align: center;">
        <br><br><br><br><br>
        <img src="images/crocologo.png" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
    </div>
<div class="row">

    
    <div class="col-lg-12 card-margin" >
        <div class="card search-form">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-lg-11 col-md-9 col-sm-12 p-0">
                                <input type="text" placeholder="Kata Kunci ...." class="form-control" id="txtkatakunci" name="txtkatakunci" value="<?php if(isset($_GET['katakunci'])){ echo $_GET['katakunci'];} ?>">
                            </div>
                            <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                <button type="button" class="btn btn-base" onclick="mulaicari()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </button>
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

    function kondisiload()
    {
        swal.close();
    }

	function mulaicari()
    {
        swal.fire(
        {
            title:"Menampilkan Data",
            text: "Menunggu Untuk menampilkan data",
            showConfirmButton: false,
            imageUrl: "../js/sweetalert2/img/load.gif"
        });
        halaman = "hasilpencarian.php?katakunci=" + $('#txtkatakunci').val();
        window.location=halaman;
    }

    $("#txtkatakunci").on("keydown", function(event) {
        if(event.which == 13)
        {
            swal.fire(
            {
                title:"Menampilkan Data",
                text: "Menunggu Untuk menampilkan data",
                showConfirmButton: false,
                imageUrl: "../js/sweetalert2/img/load.gif"
            });
            mulaicari();
        }
    });
</script>
</body>
</html>