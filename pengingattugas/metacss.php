<?php
  @session_start();
  
  include("../modul/pengaturan/listDB.php");
  $database = $pengingattugasdb;
  include("../modul/pengaturan/KoneksiDB.php"); 
  
  if(empty($_SESSION['portalnipbaru']))
  {
    header("location: ../login.php");
  }

  $btsharideadline = 3;

  function aturprofil($foto, $jeniskelamin)
  {
      $fotobalik = "../bankdata/assets/images/users/usercowo.png";
      if($foto != "")
      {
          $fotobalik = "data:image/jpeg;base64,".base64_encode($foto);

      }
      else
      {
          if($jeniskelamin == "Wanita")
          {
              $fotobalik = "../bankdata/assets/images/users/usercewe.png";   
          }
      }
      echo $fotobalik;
  }

  function tampilstatustugas($status)
  {
    $balikin = "";
    if($status == "DiTugaskan")
    {
      $balikin = '<span class="badge" style="background-color: #F39C12;">' . $status .'</span>';
    }
    elseif($status == "DiKerjakan")
    {
      $balikin = '<span class="badge" style="background-color: #3C8DBC;">' . $status .'</span>';
    }
    elseif($status == "Selesai")
    {
      $balikin = '<span class="badge" style="background-color: #28A745;">' . $status .'</span>';
    }
    elseif($status == "Batal")
    {
      $balikin = '<span class="badge" style="background-color: #DC3545;">' . $status .'</span>';
    }
    return $balikin;
  }

  function tampilkepentingan($kepentingan)
  {
    $balikin1 = "";

    if($kepentingan == "Rendah")
    {
      $balikin1 = '<span class="badge" style="background-color: #F8F9FA; color: black">' . $kepentingan .'</span>';
    }
    elseif($kepentingan == "Sedang")
    {
      $balikin1 = '<span class="badge" style="background-color: #28A745;">' . $kepentingan .'</span>';
    }
    elseif($kepentingan == "Tinggi")
    {
      $balikin1 = '<span class="badge blink" style="background-color: #FFC107;">' . $kepentingan .'</span>';
    }
    elseif($kepentingan == "Mendesak")
    {
      $balikin1 = '<span class="badge blink" style="background-color: #DC3545;">' . $kepentingan .'</span>';
    }

    return $balikin1;
  }

  function ubahformattgl($tanggal,$asal)
  {
    $balikin2 = "";
    if ($asal!="db") 
    {
      $balikin2 = substr($tanggal,6,4) . "/" . substr($tanggal,3,2) . "/" . substr($tanggal,0,2);
    }
    else
    {
      $balikin2 = substr($tanggal,0,2) . "/" . substr($tanggal,3,2) . "/" . substr($tanggal,6,4);
    }
    return $balikin2;
  }
?>

<meta charset="UTF-8">
<title>Pengingat Tugas</title>
<link rel="icon" href="../img/logo/Pengingattugas3.ico" type="image/x-icon" />
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- fullCalendar -->
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->