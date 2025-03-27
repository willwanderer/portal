/**
 * Created by Will Wanderer on 7/19/2015.
 */
//Waktu tunggu user nonaktif
function waktudiam(detik, fungsi)
{
    idleTime = 0;
    var idleInterval = setInterval(timerIncrement, 1000);
    function timerIncrement()
    {
        idleTime++;
        if (idleTime > detik)
        {
            fungsi();
        }
    }
    $(this).mousemove(function(e){
        idleTime = 0;
    });
}

//Validasi sebuah inputan hanya memunculkan Angka
function hanyaangka(evt)
{

    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

// function kembalidate(tanggal, dicari)
// {
//     var d = new Date(tanggal);
//     var weekday = new Array(7);
//     weekday[0] = "Minggu";
//     weekday[1] = "Senin";
//     weekday[2] = "Selasa";
//     weekday[3] = "Rabu";
//     weekday[4] = "Kamis";
//     weekday[5] = "Jumat";
//     weekday[6] = "Sabtu";

//     if(dicari=="hari")
//     {
//         return weekday[d.getDay()];
//     }
// }



function toRp(angka)
{
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return rev2.split('').reverse().join('');
}

function refreshhalaman()
{
    location.reload();
}

function ceknotif()
{
    //Mengecek jumlah notif baru
    $.ajax(
        {
            type:"POST",
            url:"modul/umum/tampilpemberitahuan.php",
            data: "status=cekstatuslihat",
            cache: false,
            success: function(data)
            {
                if(data>0)
                {
                    var audio = new Audio('assets/notif/notif.mp3');
                    audio.play();
                }
            }
        });

    $.ajax(
        {
            type:"POST",
            url:"modul/umum/tampilpemberitahuan.php",
            data: "status=cekstatusbaca",
            cache: false,
            success: function(data)
            {
                $('#txtjumlahpesan').html(data);
                $('#txtjumlahpesanbaru').html(data +' Baru');
            }
        });

    $.ajax(
        {
            type:"POST",
            url:"modul/umum/tampilpemberitahuan.php",
            data: "status=tampilpemberitahuan",
            cache: false,
            success: function(data)
            {
                $('#txtisipemberitahuan').html(data);
            }
        });
}
function hapusnotif()
{
    $.ajax(
        {
            type:"POST",
            url:"modul/umum/tampilpemberitahuan.php",
            data: "status=hapusstatusbaca",
            cache: false,
            success: function(data)
            {
                $('#txtjumlahpesan').html('');
                $('#txtjumlahpesanbaru').html('0 Baru');
            }
        });
}

function wakturefreshhalaman(detik)
{
    idleTime = 0;
    var idleInterval = setInterval(timerIncrement, 1000);
    function timerIncrement()
    {
        idleTime++;
        if (idleTime > detik)
        {
            refreshhalaman();
        }
    }
    $(this).mousemove(function(e){
        idleTime = 0;
    });
}

function waktuceknotif(detik)
{
    var idleInterval = setInterval(timerIncrement, 1000);
    function timerIncrement()
    {
        ceknotif();
        cekstatusfbtw();
    }
}

function cekstatusfbtw()
{
    $.ajax(
        {
            type:"POST",
            url:"modul/umum/cekstatusloginfb.php",
            data: "status=hapusstatusbaca",
            cache: false,
            success: function(data)
            {

            }
        });
}


function daftarkeinginan(id)
{
    swal(
        {
            title: "Menambahkan Produk.",
            text: "Menambahkan Produk ke Daftar Keinginan. Harap Tunggu . . .",
            showConfirmButton: false,
            imageUrl: "images/482.gif"
        });

    var kirimdata= {};
    kirimdata.id = id;
    $.ajax({
        type:"POST",
        url:"modul/daftarkeinginan/tambahdaftarkeinginan.php",
        data: kirimdata,
        cache: false,
        success: function(data)
        {
            if(data==1)
            {
                swal(
                    {
                        title: "Berhasil",
                        text: "Berhasil ditambahkan ke Daftar keinginan! Silahkan lihat pada menu Daftar Keinginan",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#AEDEF4",
                        confirmButtonText: "Lanjutkan",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm)
                    {
                        if (isConfirm)
                        {
                            location.reload();
                        }
                    });
            }
            else if(data==2)
            {
                swal("Gagal","Maaf, Anda harus login terlebih dahulu untuk masuk ke Daftar Keinginan","error");
            }
            else
            {
                swal("Gagal","Data gagal di Simpan. Error : " +data,"error");
            }
        }
    });
}
