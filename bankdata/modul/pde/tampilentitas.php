<?php
	@session_start();
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  


    $bankdatadb = "bankdata_" . $_POST['tahunpde'];
    $_SESSION['tahunpde'] = $_POST['tahunpde'];

    $data=array();
    $result = $conduadb->query("select entb.ENT_ID, entp.ENT_NAMA, entp.ENT_LOGO from portal_dbv1.entitas entp, " . $bankdatadb . ".entitas entb WHERE entp.ENT_ID = entb.ENT_ID");
    while($row = $result->fetch_assoc()) 
    {
		array_push($data, array("ENT_ID" => $row['ENT_ID'], "ENT_NAMA" => $row['ENT_NAMA'], "ENT_LOGO" => "data:image/jpeg;base64," . base64_encode($row['ENT_LOGO'])));
    }
	echo json_encode($data);
  $con->close();
?>