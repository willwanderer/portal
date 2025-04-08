<!-- META SECTION -->
<title>Dashboard Bank Data SS3</title>  
<link rel="icon" href="../img/logo/SS3Logo.ico" type="image/x-icon" />          
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<!-- END META SECTION -->

<!-- CSS INCLUDE -->        
<link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
<!-- EOF CSS INCLUDE --> 

<style type="text/css">
    .fotoprofile {
        width: 100px;
        border: 3px solid #fff;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }
</style>   

<?php
    @session_start();
	//Koneksi Database
    include("../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../modul/pengaturan/KoneksiDB.php");    

    if(!isset($_SESSION['portalniplama']) || $_SESSION['portalniplama']=="")
    {
        header("location: ../login.php?app=bankdata");
    }

    function singkatjenispem($jenpem)
    {
        if($jenpem == "Laporan Keuangan Pemerintah Daerah")
        {
            return "LKPD";
        }
        elseif($jenpem == "Kinerja")
        {
            return "Kinerja";
        }
        else
        {
            return "DTT";
        }
    }

    function aturprofil($foto, $jeniskelamin)
    {
        $fotobalik = "assets/images/users/usercowo.png";
        if($foto != "")
        {
            $fotobalik = "data:image/jpeg;base64,".base64_encode($foto);

        }
        else
        {
            if($jeniskelamin == "Wanita")
            {
                $fotobalik = "assets/images/users/usercewe.png";   
            }
        }
        echo $fotobalik;
    }

    function aturlogoentitas($foto)
    {
        $fotobalik = "assets/images/users/noimgentitas.jpg";
        if($foto != "")
        {
            $fotobalik = "data:image/jpeg;base64,".base64_encode($foto);

        }
        echo $fotobalik;
    }

    function linksisdm($niplama, $nipbaru, $nama)
    {
        if($niplama != "")
        {
            echo "https://sisdm.bpk.go.id/v3/kepegawaian/pencarian/" . $niplama;
        }
        else
        {
            $kword="";
            if(substr($nipbaru,0,4) == "0000")
            {
                $kword = explode(' ', trim($nama))[0]."+".explode(' ', trim($nama))[1];
            }
            else
            {
                $kword = $nipbaru;
            }
            echo "https://sisdm.bpk.go.id/v3/kepegawaian/pencarian?q=" . $kword;
        }
    }
?>	                            