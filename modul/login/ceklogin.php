<?php 
    @session_start();
    //Koneksi Database
    include("../pengaturan/listDB.php");
    $database = $portaldb;
    include("../pengaturan/KoneksiDB.php");

    $result = $con->query("SELECT p.*, u.UO_NAMA as 'PEG_UNIT_ORGANISASI' from PEGAWAI p, UNIT_ORGANISASI u where p.UO_ID=u.UO_ID and PEG_EMAIL_BPK='".$_POST['txtuser'] . "@bpk.go.id'");
    while($row = $result->fetch_assoc()) 
    {
        $datanya[]=$row;
    }

    $pass = explode('.', $_POST['txtuser']);
    if(count($datanya)==0)
    {
        echo 1;
    }
    else
    {
        if($_POST['txtpassword'] == $pass[0])
        {
            $_SESSION['portalnipbaru'] = $datanya[0]['PEG_NIP_BARU'];
            $_SESSION['portalniplama'] = $datanya[0]['PEG_NIP_LAMA'];
            $_SESSION['portalemail'] = $datanya[0]['PEG_EMAIL_BPK'];
            $_SESSION['portaljeniskelamin'] = $datanya[0]['PEG_JENIS_KELAMIN'];
            $_SESSION['portalnama'] = $datanya[0]['PEG_NAMA'];
            $_SESSION['portalunitkerja'] = $datanya[0]['PEG_UNIT_ORGANISASI'];
            $_SESSION['portaljabatan'] = $datanya[0]['PEG_JABATAN'];
            $_SESSION['portalfoto'] = $datanya[0]['PEG_FOTO'];
            $_SESSION['portalidunitkerja'] = $datanya[0]['UO_ID'];

            //Fill Data Pegawai, Entitas
            if(!isset($_SESSION['dtpegawai']))
            {
                $_SESSION['dtpegawai'] = array();
                $_SESSION['dtentitas'] = array();

                $result = $con->query("select r.*, u.UO_NAMA as 'PEG_UNIT_ORGANISASI' from pegawai r, unit_organisasi u WHERE r.UO_ID = u.UO_ID and r.PEG_STATUS='Aktif'");
                while($row = $result->fetch_assoc()) 
                {
                    array_push($_SESSION['dtpegawai'], $row);
                }

                $result = $con->query("SELECT * from entitas");
                while($row = $result->fetch_assoc()) 
                {
                    array_push($_SESSION['dtentitas'], $row);
                }

                

            }

            echo 0;
        }
        else
        {
            echo 1;
        }
    }
?>