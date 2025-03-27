<?php
	@session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = "bankdata_" . $_POST['tahunpde'];
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $con->close();
?>