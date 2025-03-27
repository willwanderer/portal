<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $sql="update register_surat_keluar set RSK_NOMOR_SURAT='" . $_POST['txtnomorsuratkeluar'] . "', RSK_TANGGAL='" . $_POST['txttanggal'] . "', RSK_TUJUAN='" . $_POST['txttujuan'] . "', RSK_PERIHAL='" . $_POST['txtperihal'] . "' where RSK_ID='" . $_POST['txtidsurat'] . "'";
    if ($con->multi_query($sql) === TRUE) 
    {
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
?>