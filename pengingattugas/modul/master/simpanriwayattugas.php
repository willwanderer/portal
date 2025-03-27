<?php
	@session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $pengingattugasdb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $sql="insert into riwayat_pengingat_tugas values(default,'" . $_POST['txtidtugas'] . "','" . $_POST['txtstatus'] . "','" . $_POST['txttanggal'] . "','" . $_POST['txtcatatan'] . "','" . $_POST['txtprogres'] . "')";
    if ($con->multi_query($sql) === TRUE) 
    {
        $con->multi_query("update pengingat_tugas set PT_STATUS='" . $_POST['txtstatus'] . "' where PT_ID='" . $_POST['txtidtugas'] . "'");
        echo 0;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    //echo $sql;
?>