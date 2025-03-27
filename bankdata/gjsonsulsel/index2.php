<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sulawesi Selatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"></script>
    <script src="https://jvectormap.com/js/jquery-jvectormap-indonesia.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        #map {
            width: 800px;
            height: 500px;
            margin: 0 auto;
        }
        .tooltip {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Peta Sulawesi Selatan</h1>
    <p>Klik pada wilayah untuk informasi lebih lanjut.</p>
    <div id="map"></div>

    <script>
        $(document).ready(function () {
            $('#map').vectorMap({
                map: 'indonesia_id', // Gunakan peta Indonesia
                backgroundColor: '#a4dded', // Warna latar belakang
                regionStyle: {
                    initial: {
                        fill: '#1f77b4', // Warna awal
                        "fill-opacity": 1,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 1
                    },
                    hover: {
                        fill: '#ffcc00', // Warna saat hover
                        "fill-opacity": 0.8
                    },
                    selected: {
                        fill: '#ff0000' // Warna saat dipilih
                    }
                },
                focusOn: {
                    region: 'ID-SN' // Kode wilayah untuk Sulawesi Selatan
                },
                onRegionTipShow: function (e, el, code) {
                    // Tampilkan tooltip
                    if (code === 'ID-SN') {
                        el.html(el.html() + ' (Sulawesi Selatan)');
                    }
                },
                onRegionClick: function (e, code) {
                    // Aksi saat wilayah diklik
                    if (code === 'ID-SN') {
                        alert('Anda mengklik wilayah Sulawesi Selatan!');
                    } else {
                        alert('Wilayah lain diklik: ' + code);
                    }
                }
            });
        });
    </script>
</body>
</html>
