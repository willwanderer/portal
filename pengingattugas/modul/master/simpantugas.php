<?php
	@session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $statustugas = "DiTugaskan";
    $klasifikasi="";
    if(isset($_POST["txtklasifikasi"])) 
    {
        $ind=0;
        foreach ($_POST['txtklasifikasi'] as $subject)
        {
            if($ind==0)
            {
                $klasifikasi=$subject;
            }
            else
            {
                $klasifikasi=$klasifikasi . "," . $subject;
            }
            if($subject == "Untuk di Ketahui")
            {
                $klasifikasi="Selesai";
            }
            $ind ++;
        } 
    }

    $tanggalakhir = $_POST['txttglbataswaktu'];
    if($tanggalakhir == "")
    {
        $tanggalakhir = "NULL";
    }
    else
    {
        $tanggalakhir = "'" . $tanggalakhir . "'";
    }

    $tanggalsurat =  $_POST['txttglsurat'];
    if($tanggalsurat == "")
    {
        $tanggalsurat = "NULL";
    }
    else
    {
        $tanggalsurat = "'" . $tanggalsurat . "'";
    }

    $sql="insert into pengingat_tugas values(default,'" . $_SESSION['portalidunitkerja'] . "','" . $_POST['txtnippic'] . "','" . $_POST['txtjudultugas'] . "','" . $_POST['txtdetailtugas'] . "','" . $_POST['txttgldisposisi'] . "'," . $tanggalakhir . ",'" . $_POST['txtnomorsurat'] . "'," . $tanggalsurat . ",'" . $_POST['txtasalsurat'] . "','" . $klasifikasi . "','" . $_POST['txtcatatan'] . "','" . $_POST['txtlevelkepentingan'] . "','" . $statustugas . "')";
    if ($con->multi_query($sql) === TRUE) 
    {
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    //echo $sql;
?>