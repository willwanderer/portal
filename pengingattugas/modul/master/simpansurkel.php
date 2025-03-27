<?php
    @session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $sql="insert into register_surat_keluar values(default,'" . $_SESSION['portalidunitkerja'] . "','" . $_POST['txtnomorsuratkeluar'] . "','" . $_POST['txttanggal'] . "','" . $_POST['txttujuan'] . "','" . $_POST['txtperihal'] . "')";
    if ($con->multi_query($sql) === TRUE) 
    {
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

?>