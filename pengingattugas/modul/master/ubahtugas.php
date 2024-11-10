<?php
	@session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  


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

    $sql="update pengingat_tugas set UO_ID = '" . $_SESSION['portalidunitkerja'] . "', PEG_NIP_LAMA='" . $_POST['txtnippic'] . "', PT_JUDUL='" . $_POST['txtjudultugas'] . "', PT_DETAIL='" . $_POST['txtdetailtugas'] . "', PT_TANGGAL_AWAL='" . $_POST['txttgldisposisi'] . "', PT_TANGGAL_AKHIR=" . $tanggalakhir . ", PT_NOMOR_SURAT='" . $_POST['txtnomorsurat'] . "', PT_TANGGAL_SURAT=" . $tanggalsurat . ", PT_ASAL_SURAT='" . $_POST['txtasalsurat'] . "', PT_KLASIFIKASI_TUGAS='" . $klasifikasi . "',PT_CATATAN='" . $_POST['txtcatatan'] . "', PT_LEVEL_KEPENTINGAN='" . $_POST['txtlevelkepentingan'] . "' where PT_ID='" . $_POST['txtidtugas'] . "'";
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