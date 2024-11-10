<?php
	include('..\..\modul\pengaturan\KoneksiDBPorste.php');

	$katacari = $_POST['katakunci'];
	$panjang = $_POST['panjang'];
	$mulai = $_POST['mulai'];

	$kuery="SELECT * FROM "public"."caseviews" where (case_name LIKE '%" . $katacari . "%' or condition LIKE '%" . $katacari . "%' or criteria LIKE '%" . $katacari . "%' or cause LIKE '%" . $katacari . "%' or effect LIKE '%" . $katacari . "%') ORDER BY signed desc LIMIT 10 OFFSET 0";

	$stmt = $pdo->query($kuery);
  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  	foreach ($results as $row) 
  	{
  		$data['judultemuan'] = $row['case_name'];
  		$data['kondisi'] = $row['kondisi'] . " . . . . .";
  	}
	
	echo json_encode($data);

?>