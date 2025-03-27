<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $fotoprofil = $_FILES['txtfotoprofil']['name'];

    if ((isset($fotoprofil)) && ($fotoprofil != ""))
    {
    	$foto = addslashes(file_get_contents($_FILES['txtfotoprofil']['tmp_name']));	
    	$sql="update PEGAWAI set PEG_FOTO='" . $foto . "' where PEG_NIP_LAMA='" . $_POST['txtnip'] . "'";
	    if ($con->multi_query($sql) === TRUE) 
	    {
	        echo 0;
	    }
	    else
	    {
	        echo "Error: " . $sql . "<br>" . $con->error;
	    }
    }
    else
    {
    	echo "Foto Tidak Tersedia";
    }
	$con->close();
?>