<?php
	@session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $tanggalakhir = $_POST['txttanggalakhir'];
    if($tanggalakhir == "")
    {
        $tanggalakhir = "NULL";
    }
    else
    {
        $tanggalakhir = "'" . $tanggalakhir . "'";
    }

    $sql="insert into dosir values(default,'" . $_POST['txtnippemeriksa'] . "','" . $_POST['txtidentitas'] . "','" . $_POST['txtperandalamtim'] . "','" . $_POST['txttanggalawal'] . "'," . $tanggalakhir . ",'Aktif')";
    if($con->multi_query($sql) === TRUE) 
    {
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $con->close();
?>