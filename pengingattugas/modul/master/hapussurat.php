<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $sql="delete from register_surat_keluar where RSK_ID='" . $_POST['idsurat'] . "'";
    if ($con->multi_query($sql) === TRUE) 
    {
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
?>