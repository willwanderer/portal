<?php
	@session_start();
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  


    $bankdatadb = "bankdata_" . $_POST['tahunpde'];
    $_SESSION['tahunpde'] = $_POST['tahunpde'];

    $result = $conduadb->query("select * from " . $bankdatadb . ".entitas WHERE ENT_ID = '" . $_POST['identitas'] . "'");
    while($row = $result->fetch_assoc()) 
    {
		$data = $row;
    }
    if(isset($data))
    {
        echo json_encode($data);    
    }
    else
    {
        echo "1";
    }
	
    $con->close();
?>