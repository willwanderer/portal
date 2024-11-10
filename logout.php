<?php
    session_start();
    $_SESSION['portalnipbaru'] = "";
    $_SESSION['portalniplama'] = "";
    $_SESSION['portalemail'] = "";
    $_SESSION['portaljeniskelamin'] = "";
    $_SESSION['portalnama'] = "";
    $_SESSION['portalunitkerja'] = "";
    $_SESSION['portaljabatan'] = "";
    $_SESSION['portalfoto'] = "";
    $_SESSION['portalidunitkerja'] = "";


    header("location: login.php");
?>