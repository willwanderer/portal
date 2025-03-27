<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $jumlahdata = 0;
	$result = $con->query("SELECT count(*) as 'jumlah' from register_surat_keluar where RSK_NOMOR_SURAT='" . $_POST['nosurat']  . "' ");
    while($row = $result->fetch_assoc()) 
    {
    	$jumlahdata = $row['jumlah'];
    }
    echo $jumlahdata;

?>