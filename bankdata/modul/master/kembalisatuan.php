<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    if($_POST['kembali'] == "tampildetailpegawai")
    {
		$result = $con->query("SELECT p.*, u.UO_NAMA as 'PEG_UNIT_ORGANISASI' FROM PEGAWAI p, UNIT_ORGANISASI u where p.UO_ID=u.UO_ID and p.PEG_NIP_LAMA='".$_POST['nip']."'");
		while($row = $result->fetch_assoc()) 
		{
			$foto = "assets/images/users/usercowo.png";
			if($row['PEG_FOTO']!="")
			{
				$foto = "data:image/jpeg;base64," . base64_encode($row['PEG_FOTO']);
			}
			else
			{
				if($row['PEG_JENIS_KELAMIN'] == "Wanita")
				{
					$foto = "assets/images/users/usercewe.png";   
				}
			}

			$data['foto'] = $foto;
			$data['unit'] = $row['PEG_UNIT_ORGANISASI'];
		}
    }

	echo json_encode($data);
	$con->close();
?>