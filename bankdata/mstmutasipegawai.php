<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php"); 
        ?>
    </head>
    <body onload="kondisiload()">
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <?php include("menusamping.php");?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content" id="divinduk">
                
                <?php include ("menuatas.php");?>                     

                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-share-square-o"></span> Mutasi Pegawai</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row" id="divisi">

                    </div>
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                               
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <?php include("audiojs.php"); ?>

        <script type="text/javascript">
            
            function kondisiload()
            {
                $.ajax({
                    url: 'modul/master/kembalikartupegawai.php',
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.pegawai);
                        displayContactsInColumns(data.pegawai);
                        $('#divinduk').css('height', 'auto');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire("Gagal","Terjadi kesalahan dalam memuat data Pegawai. Eror : "+ textStatus + ' - ' + errorThrown,"error");
                    }
                });
            }

            function displayContactsInColumns(columns) 
            {
                $('#divisi').empty();

                $.each(columns, function(index, column) {
                    const col = $('<div class="col-md-4"></div>');
                    const panel = $('<div class="panel panel-default"></div>');
                    const panelHeading = $('<div class="panel-heading"></div>').html(`
                        <div class='panel-title-box'>
                            <h3 style="min-height:37px">${column.UO_NAMA}</h3>
                            <i class="fa fa-group" data-toggle="tooltip" data-placement="top" title="Jumlah Pegawai"></i>&nbsp;${column.jumlahpegawai}&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-male" style="color:#557C55" data-toggle="tooltip" data-placement="top" title="Jumlah Pegawai Pria"></i>&nbsp;${column.jumlahpria}&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-female" style="color:#FA7070" data-toggle="tooltip" data-placement="top" title="Jumlah Pegawai Wanita"></i>&nbsp;${column.jumlahwanita}&nbsp;&nbsp;&nbsp;
                        </div>
                    `);
                    
                    // Input pencarian dengan onkeyup
                    const searchInput = $('<input type="text" class="form-control search-input" placeholder="Cari Pegawai..." onkeyup="searchContacts(this, \'' + column.UO_NAMA + '\')">');
                    panelHeading.append(searchInput);
                    
                    const panelBody = $('<div class="panel-body padding-0" style="height: 350px; overflow-y: scroll;"></div>');
                    
                    // Menambahkan kontak ke dalam panel body
                    const contactList = $('<div class="list-group list-group-contacts border-bottom push-down-10"></div>');
                    
                    // Menyimpan semua kontak untuk pencarian
                    const allContacts = column.pegawai.map(contact => {
                        const contactItem = {
                            element: $(`
                                <a href="javascript:void(0)" class="list-group-item" style="cursor:pointer;">                                 
                                    <img src="${contact.PEG_FOTO}" class="pull-left" onload="this.style.height = this.offsetWidth + 'px';" style="object-fit: cover; object-position: center;">
                                    <span class="contacts-title">${contact.PEG_NAMA} (${contact.PEG_NIP_BARU})</span>
                                    <p>${contact.PEG_JABATAN}</p>
                                    <div style="text-align: right; margin-bottom:-10px; margin-top :-10px">
                                    <i class="fa fa-${contact.PEG_JENIS_KELAMIN}" style="color:${contact.PEG_WARNAHJK}"></i>
                                    <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Ubah Pegawai" onclick="ubahpegawai('${contact.PEG_NIP_LAMA}')"></i>
                                    <i class="fa fa-share-square-o" style="color:blue" data-toggle="tooltip" data-placement="top" title="Mutasi Pegawai" onclick="mutasipegawai('${contact.PEG_NIP_LAMA}')"></i>
                                    </div>
                                </a>
                            `),
                            name: contact.PEG_NAMA.toLowerCase() // Simpan nama untuk pencarian
                        };
                        contactList.append(contactItem.element);
                        return contactItem;
                    });

                    panelBody.append(contactList);
                    panel.append(panelHeading);
                    panel.append(panelBody);
                    col.append(panel);
                    $('#divisi').append(col);

                    // Menyimpan referensi ke allContacts di dalam elemen kolom
                    col.data('allContacts', allContacts);
                });
            }

            function searchContacts(input, divisiName) {
                const searchTerm = input.value.toLowerCase(); // Ambil nilai input dan ubah menjadi huruf kecil
                const col = $(input).closest('.col-md-4'); // Temukan kolom terdekat
                const contactList = col.find('.list-group-contacts'); // Temukan daftar kontak di kolom
                const allContacts = col.data('allContacts'); // Ambil semua kontak yang disimpan

                contactList.empty(); // Kosongkan daftar kontak yang ada

                // Filter kontak berdasarkan input pencarian
                allContacts.forEach(contact => {
                    if (contact.name.includes(searchTerm)) {
                        contactList.append(contact.element); // Tambahkan kontak yang cocok
                    }
                });
            }

            function mutasipegawai(nik)
            {
                
            }

        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>