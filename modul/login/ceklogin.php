<?php 
    @session_start();
    //Koneksi Database
    include("../pengaturan/listDB.php");
    $database = $portaldb;
    include("../pengaturan/KoneksiDB.php");

    $email = strtolower($_POST['txtuser']) . "@bpk.go.id";
    $pass = $_POST['txtpassword'];

    $stmt = $con->prepare("CALL validasilogin(?, ?)");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['portalnipbaru'] = $row['PEG_NIP_BARU'];
            $_SESSION['portalniplama'] = $row['PEG_NIP_LAMA'];
            $_SESSION['portalemail'] = $row['PEG_EMAIL_BPK'];
            $_SESSION['portaljeniskelamin'] = $row['PEG_JENIS_KELAMIN'];
            $_SESSION['portalnama'] = $row['PEG_NAMA'];
            $_SESSION['portalunitkerja'] = $row['UO_NAMA'];
            $_SESSION['portaljabatan'] = $row['PEG_JABATAN'];
            $_SESSION['portalfoto'] = $row['PEG_FOTO'];
            $_SESSION['portalidunitkerja'] = $row['UO_ID'];
        }
    } 
    else {
        echo 1;
    }
?>