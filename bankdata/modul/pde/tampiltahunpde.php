<?php
	@session_start();
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $data=array();
    array_push($data, array("VALUETAHUN" => "", "TAHUN" => "-- Pilih Tahun --"));
    $result = $con->query("SELECT * from pembaharuan_data_entitas");
    while($row = $result->fetch_assoc()) 
    {
        array_push($data, array("VALUETAHUN" => $row['PDE_TAHUN'], "TAHUN" => $row['PDE_TAHUN']));
    }

	echo json_encode($data);
    $con->close();
?>