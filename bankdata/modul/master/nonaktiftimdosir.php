<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $sql="update DOSIR set DOS_STATUS='" . $_POST['status'] . "', DOS_AKHIR_MENJABAT='" . $_POST['tglakhir'] . "' where DOS_ID='" . $_POST['idtd'] . "'";
    if ($con->multi_query($sql) === TRUE) 
    {
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $con->close();
?>