<?php
	@session_start();
	//Koneksi Database
    include("../../../modul/pengaturan/listDB.php");
    $database = $portaldb;
    include("../../../modul/pengaturan/KoneksiDB.php");  

    $pegawai = [];
    $index=0;
    $result = $con->query("select p.PEG_NIP_LAMA, p.PEG_NIP_BARU, concat(COALESCE(p.PEG_GELAR_DEPAN,''), ' ', COALESCE(p.PEG_NAMA,''), ' ', COALESCE(p.PEG_GELAR_BELAKANG,'')) as 'PEG_NAMA', p.PEG_JENIS_KELAMIN, p.PEG_FOTO, p.PEG_JABATAN, p.UO_ID, u.UO_NAMA from portal_dbv1.pegawai p, portal_dbv1.unit_organisasi u WHERE p.UO_ID=u.UO_ID and p.PEG_STATUS='Aktif' order by u.UO_NAMA asc, p.PEG_JABATAN asc");
    while($row = $result->fetch_assoc()) 
    {
        $uoid = $row['UO_ID'];
        $found = false;

        foreach ($pegawai as $value) 
        {
            if ($value['UO_ID'] === $uoid) {    
                $found = true;
                break;
            }
        }

        if($found == false){
            $pegawai[$index] = [
                'UO_ID' => $uoid,
                'UO_NAMA' => $row['UO_NAMA'],
                'jumlahpegawai' => "",
                'jumlahpria' => "",
                'jumlahwanita' => "",
                'pegawai' => []
            ];
            $index ++;
        }

        $index=0;
        foreach ($pegawai as $value) 
        {
            if ($value['UO_ID'] === $uoid) {
                $foto = "assets/images/users/usercowo.png";
                $jeniskelamin = "";
                $warnahjk = "";
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
                if($row['PEG_JENIS_KELAMIN'] == "Pria")
                {
                    $jeniskelamin = "male";   
                    $warnahjk = "#557C55";
                }
                if($row['PEG_JENIS_KELAMIN'] == "Wanita")
                {
                    $jeniskelamin = "female";  
                    $warnahjk = "#FA7070"; 
                }
                $pegawai[$index]['pegawai'][] = [
                    'PEG_NIP_LAMA' => $row['PEG_NIP_LAMA'],
                    'PEG_NIP_BARU' => $row['PEG_NIP_BARU'],
                    'PEG_NAMA' => $row['PEG_NAMA'],
                    'PEG_JABATAN' => $row['PEG_JABATAN'],
                    'PEG_JENIS_KELAMIN' => $jeniskelamin,
                    'PEG_WARNAHJK' => $warnahjk,
                    'PEG_FOTO' => $foto
                ];
            }
            $index++;
        }
    }

    $index=0;
    foreach ($pegawai as $value) 
    {
        $result = $con->query("SELECT UO_ID, SUM(CASE WHEN PEG_JENIS_KELAMIN = 'Pria' THEN 1 ELSE 0 END) AS jumlah_pria, SUM(CASE WHEN PEG_JENIS_KELAMIN = 'Wanita' THEN 1 ELSE 0 END) AS jumlah_wanita FROM portal_dbv1.pegawai where UO_ID ='" . $value['UO_ID'] . "' and PEG_STATUS='Aktif' GROUP BY UO_ID");
        while($row = $result->fetch_assoc()) 
        {
            $pegawai[$index]['jumlahpegawai'] = $row['jumlah_pria'] + $row['jumlah_wanita'];
            $pegawai[$index]['jumlahpria'] = $row['jumlah_pria'];
            $pegawai[$index]['jumlahwanita'] = $row['jumlah_wanita'];
        }
        $index++;
    }

    $data = [
        'pegawai' => array_values($pegawai)
    ];

    echo json_encode($data);
    $con->close();
?>