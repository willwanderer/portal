<?php
	include('..\..\modul\pengaturan\KoneksiDBPorste.php');

	$kuery="SELECT * FROM branches";
	$hasil="<option placeholder='' value=''>Perwakilan</option>";

	if($_POST['jenis']=="")
	{

	}
	
	$stmt = $pdo->query($kuery);
  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  	foreach ($results as $row) 
  	{
  		$hasil = $hasil . "<option>" . $row['name'] . "</option>";
  	}
  	echo $hasil;
?>