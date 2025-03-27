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
        if(isset($_GET['katakunci']))
        {
            $banyakdata = 0;

            $katacari = $_GET['katakunci'];
            $panjang = 10;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $mulai = ($halaman - 1) * $panjang;


            $whereklausal = "(case_name LIKE '%" . $katacari . "%' or condition LIKE '%" . $katacari . "%' or criteria LIKE '%" . $katacari . "%' or cause LIKE '%" . $katacari . "%' or effect LIKE '%" . $katacari . "%')";

            $kuery="SELECT * FROM caseviews where " . $whereklausal . " ORDER BY signed desc LIMIT " . $panjang . " OFFSET " . $mulai;

            $stmt = $pdo->query($kuery);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row) 
            {
                $datahasil[]=$row;
            }    

            $kuery="SELECT count(*) as jumlah FROM caseviews where " . $whereklausal;

            $stmt = $pdo->query($kuery);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row) 
            {
                $banyakdata=$row['jumlah'];
            }

            $totalhalaman = ceil($banyakdata / $panjang);


        }
        
    ?>
</head>
<body onload="kondisiload()" onbeforeunload="kondisiload()">
<div class="container">
<div class="row">
    <div class="col-lg-12 card-margin">
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
<div class="row">
        <div class="col-12">
            <div class="card card-margin">
                <div class="card-body">
                    <div class="row search-body">
                        <div class="col-lg-12">
                            <div class="search-result">
                                <div class="result-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="records">Menampilkan: <b><?php echo $mulai+1 ?>-<?php echo $mulai+$panjang ?></b> of <b><?php echo $banyakdata ?></b> hasil</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="result-actions">
                                                <!-- <div class="result-sorting">
                                                    <span>Sort By:</span>
                                                    <select class="form-control border-0" id="exampleOption">
                                                        <option value="1">Relevance</option>
                                                        <option value="2">Names (A-Z)</option>
                                                        <option value="3">Names (Z-A)</option>
                                                    </select>
                                                </div> -->
                                                <!-- <div class="result-views">
                                                    <button type="button" class="btn btn-soft-base btn-icon">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-list"
                                                        >
                                                            <line x1="8" y1="6" x2="21" y2="6"></line>
                                                            <line x1="8" y1="12" x2="21" y2="12"></line>
                                                            <line x1="8" y1="18" x2="21" y2="18"></line>
                                                            <line x1="3" y1="6" x2="3" y2="6"></line>
                                                            <line x1="3" y1="12" x2="3" y2="12"></line>
                                                            <line x1="3" y1="18" x2="3" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="btn btn-soft-base btn-icon">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-grid"
                                                        >
                                                            <rect x="3" y="3" width="7" height="7"></rect>
                                                            <rect x="14" y="3" width="7" height="7"></rect>
                                                            <rect x="14" y="14" width="7" height="7"></rect>
                                                            <rect x="3" y="14" width="7" height="7"></rect>
                                                        </svg>
                                                    </button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-body">
                                    <div class="table-responsive">
                                        <table class="table widget-26">
                                            <tbody>
                                                <?php
                                                    if(isset($datahasil))
                                                    {
                                                        foreach ($datahasil as $datahasil => $valuehasil)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="widget-26-job-title">
                                                                        <a onclick="loadhalaman()" href="detailtemuan.php?idtemuan=<?php echo $valuehasil['case_id'] ?>"><b><?php echo $valuehasil['case_name'] ?></b></a>
                                                                        <p class="m-0">
                                                                            <?php echo substr($valuehasil['condition'],0,200) ?> . . . <span class="text-muted time"><br>
                                                                            <?php echo $valuehasil['slate_name'] ?></span>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-info">
                                                                        <p class="type m-0"><?php echo $valuehasil['branch_name'] ?></p>
                                                                        <p class="text-muted m-0">pada <span class="location"><?php echo $valuehasil['entity_name'] ?></span></p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-salary"><?php echo $valuehasil['currency_alias'] . $valuehasil['case_value'] ?></div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-category bg-soft-base">
                                                                        <span><?php echo $valuehasil['type_name'] ?></span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination pagination-base pagination-boxed pagination-square mb-0">
                            <?php
                                $linkhalaman = "hasilpencarian.php?katakunci=" . $_GET['katakunci'] . "&halaman=";
                                if($halaman > 1)
                                {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link no-border" onclick="loadhalaman()" href="<?php echo $linkhalaman . $halaman - 1 ?>">
                                                <span aria-hidden="true">«</span>
                                                <span class="sr-only">Sebelumnya</span>
                                            </a>
                                        </li>
                                    <?php
                                }

                                $start = max(1, $halaman - 4);
                                $end = min($totalhalaman, $start + 9); 

                                if ($start > 1) 
                                {
                                    ?>
                                        <li class="page-item"><a class="page-link no-border" onclick="loadhalaman()" href="<?php echo $linkhalaman . "1" ?>">1</a></li>
                                    <?php
                                    if ($start > 2) 
                                    {
                                        ?>
                                            <li class="page-item"><a class="page-link no-border" onclick="loadhalaman()" href="#">...</a></li>
                                        <?php
                                    }
                                }

                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $halaman) 
                                    {
                                        ?>
                                            <li class="page-item active"><a class="page-link no-border" onclick="loadhalaman()" href="<?php echo $linkhalaman . $i ?>"><?php echo $i ?></a></li>
                                        <?php
                                    } 
                                    else 
                                    {
                                        ?>
                                            <li class="page-item"><a class="page-link no-border" onclick="loadhalaman()" href="<?php echo $linkhalaman . $i ?>"><?php echo $i ?></a></li>
                                        <?php
                                    }
                                }



                                if ($end < $totalhalaman) {
                                    if ($end < $totalhalaman - 1) 
                                    {
                                        ?>
                                            <li class="page-item"><a class="page-link no-border" onclick="loadhalaman()" href="#">...</a></li>
                                        <?php
                                    }
                                    ?>
                                        <li class="page-item"><a class="page-link no-border" onclick="loadhalaman()" href="<?php echo $linkhalaman . $totalhalaman ?>"><?php echo $totalhalaman ?></a></li>
                                    <?php
                                }

                                if($halaman < $totalhalaman)
                                {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link no-border" onclick="loadhalaman()" href="<?php echo $linkhalaman . $halaman + 1 ?>">
                                                <span aria-hidden="true">»</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </nav>
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
        //swal.close();
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

    function loadhalaman()
    {
        swal.fire(
        {
            title:"Menampilkan Data",
            text: "Menunggu Untuk menampilkan data",
            showConfirmButton: false,
            imageUrl: "../js/sweetalert2/img/load.gif"
        });
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