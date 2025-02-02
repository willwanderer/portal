<?php
	@session_start();
    //Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = "bankdata_" . $_POST['tahunpde'];
    include("../../../modul/pengaturan/KoneksiDB.php");  

    if($_POST['namaform']=="frmdetailprofil")
    {
        $sql="update entitas set ENT_GAMBARAN_UMUM = ?, ENT_GEOGRAFIS = ?, ENT_BATAS_WILAYAH = ? where ENT_ID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $_POST['txtgambaranumum'], $_POST['txtgeografis'], $_POST['txtbataswilayah'], $_POST['identitas']);

        if ($stmt->execute()) {
            echo 0;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $con->close();
?>