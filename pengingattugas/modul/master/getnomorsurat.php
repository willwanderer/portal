<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $tanggal=strtotime($_POST['tanggal']);
	$newformat = date('m',$tanggal);
	
	$nomorid = "01";
	$idunitkerja = 0;
	$kodeterakhir = "";
	$tanggalterakhir = "";

	if($_SESSION['portalunitkerja'] == "Subauditorat Sulawesi Selatan III")
	{
		$idunitkerja = 4;
	}

	$result = $con->query("SELECT * from register_surat_keluar where UO_ID='" . $_SESSION['portalidunitkerja']  . "' order by RSK_TANGGAL desc limit 1");
    while($row = $result->fetch_assoc()) 
    {
    	$kodeterakhir = $row['RSK_NOMOR_SURAT'];
    	$tanggalterakhir = strtotime($row['RSK_TANGGAL']);
    }
    //echo $kodeterakhir;

    if($kodeterakhir!="")
    {
    	if($tanggalterakhir > $tanggal)
    	{
    		$result = $con->query("SELECT * from register_surat_keluar where UO_ID='" . $_SESSION['portalidunitkerja']  . "' and RSK_TANGGAL <= date('" . date('Y-m-d',$tanggal) . "') order by RSK_ID desc limit 1");
		    while($row = $result->fetch_assoc()) 
		    {
		    	$kodeterakhir = $row['RSK_NOMOR_SURAT'];
		    }
		    $nomorid = explode("/", $kodeterakhir)[0];
    		$nomorid = incnomora($nomorid);
    	}
    	else
    	{
    		$nomorid = intval(explode("/", $kodeterakhir)[0]) + 1;
    		if(strlen($nomorid) == 1)
    		{
    			$nomorid = "0" . $nomorid;
    		}
    	}
    }

    echo $nomorid . "/ND/XIX.MKS." . $idunitkerja . "/" . date('m',$tanggal) . "/" . date('Y',$tanggal);  


    function incnomora($nomorlama)
    {
    	if(strlen($nomorlama) == 2)
    	{
    		return $nomorlama . "A";	
    	}
    	else
    	{
    		if(substr($nomorlama, 2) == "A")
    		{
    			return substr($nomorlama,0,2) . "B";	
    		}
    		else if(substr($nomorlama, 2) == "B")
    		{
    			return substr($nomorlama,0,2) . "C";	
    		}
    		else if(substr($nomorlama, 2) == "C")
    		{
    			return substr($nomorlama,0,2) . "D";	
    		}
    		else if(substr($nomorlama, 2) == "D")
    		{
    			return substr($nomorlama,0,2) . "E";	
    		}
    		else if(substr($nomorlama, 2) == "E")
    		{
    			return substr($nomorlama,0,2) . "F";	
    		}
    		else if(substr($nomorlama, 2) == "F")
    		{
    			return substr($nomorlama,0,2) . "G";	
    		}
    		else if(substr($nomorlama, 2) == "G")
    		{
    			return substr($nomorlama,0,2) . "H";	
    		}
    		else if(substr($nomorlama, 2) == "H")
    		{
    			return substr($nomorlama,0,2) . "I";	
    		}
    	}
    	
    }
?>