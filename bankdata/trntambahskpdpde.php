<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php 
            include("metacss.php");       
        ?>
    </head>
    <body onload="kondisiload()">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal">
                    <div class="panel panel-default tabs">                            
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#tab-satu" role="tab" data-toggle="tab">Dinas/Badan/Kantor</a></li>
                            <li><a href="#tab-dua" role="tab" data-toggle="tab">UPT/Balai</a></li>
                            <li><a href="#tab-tiga" role="tab" data-toggle="tab">Struktur Organisasi</a></li>
                            <li><a href="#tab-empat" role="tab" data-toggle="tab">Bendahara Pengeluaran/Penerimaan</a></li>
                        </ul>
                        <div class="panel-body tab-content">
                            <div class="tab-pane active" id="tab-satu">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nama Dinas/Badan/Kantor</label>
                                    <div class="col-md-6 col-xs-12">
                                        <input type="text" class="form-control" name="txtnamadinas" id="txtnamadinas" onchange="isinamadinas()" />                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nomor Telepon</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <input type="text" class="form-control" id="txtnotelskpd" name="txtnotelskpd" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Alamat</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <textarea class="form-control" rows="5" id="txtalamatskpd" name="txtalamatskpd"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <button type="button" class="btn btn-primary">Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-dua">
                                <p>Pada form ini, dilakukan pengisian data semua UPT/Balai yang ada pada <span name="spnnamadinas"></span></p>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nama UPT/Balai</label>
                                    <div class="col-md-6 col-xs-12">
                                        <input type="text" class="form-control" id="txtnamauptbalai" name="txtnamauptbalai" />                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nomor Telepon</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <input type="text" class="form-control" id="txtnoteluptbalai" name="txtnoteluptbalai" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Alamat</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <textarea class="form-control" rows="5" id="txtalamatuptbalai" name="txtalamatuptbalai"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <button type="button" class="btn btn-info">Tambah Data</button>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-hover" id="tbluptbalai">
                                    <thead>
                                        <tr>
                                            <th>Nama UPT/Balai</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                            <th width= "150px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>                                        
                            <div class="tab-pane" id="tab-tiga">
                                <p>Pada form ini, dilakukan pengisian struktur organisasi yang ada pada <span name="spnnamadinas"></span></p>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">NIP</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" class="form-control" id="txtnipso" name="txtnipso" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Nama</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" id="txtnamaso" name="txtnamaso" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Jenis Jabatan</label>
                                                <div class="col-md-5 col-xs-12">
                                                    <select class="form-control" id="txtjenisjabatanso" name="txtjenisjabatanso"></select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Nama Jabatan</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" class="form-control" id="txtnamajabatanso" name="txtnamajabatanso" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Email</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" id="txtemailso" name="txtemailso" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Telpon</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" class="form-control" id="txttlpso" name="txttlpso" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Tahun Menjabat</label>
                                                <div class="col-md-4 col-xs-12">
                                                    <input type="text" class="form-control datepicker" id="txttahunawaljabatanso" name="txttahunawaljabatanso" />
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    <input type="text" class="form-control datepicker" id="txttahunakhirjabatanbp" name="txttahunakhirjabatanbp" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Foto</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="file" class="form-control" id="txtfotoso" name="txtfotoso" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <button type="button" class="btn btn-info pull-right">Tambah Data</button>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <table class="table table-hover" id="tblstruktur">
                                            <thead>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <th>Nip</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Telpon</th>
                                                    <th width= "150px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-empat">
                                <p>Pada form ini, dilakukan pengisian bendahara pengeluaran dan bendahara penerimaan yang ada pada <span name="spnnamadinas"></span></p>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nama</label>
                                    <div class="col-md-6 col-xs-12">
                                        <input type="text" class="form-control" id="txtnamabp" name="txtnamabp" />                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nomor Telepon</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <input type="text" class="form-control" id="txtnotelbp" name="txtnotelbp" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Jenis Jabatan</label>
                                    <div class="col-md-5 col-xs-12">
                                        <select class="form-control" id="txtjenisjabatanbp" name="txtjenisjabatanbp"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nama Jabatan</label>
                                    <div class="col-md-6 col-xs-12">
                                        <select class="form-control" id="txtnamajabatanbp" name="txtnamajabatanbp">
                                            <option value="Bendahara Penerimaan">Bendahara Penerimaan</option>
                                            <option value="Bendahara Pengeluaran">Bendahara Pengeluaran</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Tahun Menjabat</label>
                                    <div class="col-md-2 col-xs-12">
                                        <input type="text" class="form-control datepicker" id="txttahunawaljabatanbp" name="txttahunawaljabatanbp" />
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <input type="text" class="form-control datepicker" id="txttahunakhirjabatanbp" name="txttahunakhirjabatanbp" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <button type="button" class="btn btn-info">Tambah Data</button>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-hover" id="tblbp">
                                    <thead>
                                        <tr>
                                            <th>Jabatan</th>
                                            <th>Nip</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th width= "150px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <div class="panel-footer">                                                                        
                            
                        </div>
                    </div>
                </form>
                
            </div>
        </div>              

        <?php include("audiojs.php"); ?>

        <script type="text/javascript">
            function kondisiload()
            {
                isidatatahunpde();
            }

            function isidataentitas()
            {
                swal.fire(
                {
                    title:"Menyimpan Data",
                    text: "Menunggu Untuk menyimpan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });
                $('#isibox').empty();
                var tahunpde = $("#txttahunpde").val();
                $.ajax({
                    type: "POST", 
                    url : "modul/pde/tampilentitas.php", 
                    data: "tahunpde=" + tahunpde,
                    dataType: "json",
                    success: function(data)
                    {
                        tampilbox(data);
                    }       
                });
                swal.close();
            }

            function simpandatadetailskpd(statussimpan)
            {
                swal.fire(
                {
                    title:"Menampilkan Data",
                    text: "Menunggu Untuk menampilkan data",
                    showConfirmButton: false,
                    imageUrl: "../js/sweetalert2/img/load.gif"
                });

                var halaman="";
                var kirimdata= {};
                if(statussimpan=="dinas/badan/kantor")
                {
                    kirimdata.txtnamadinas=$('#txtnamadinas').val();
                    kirimdata.txtnotelskpd=$('#txtnotelskpd').val();
                    kirimdata.txtalamatskpd=$('#txtalamatskpd').val();
                    halaman="modul/pde/simpandetailskpd.php";
                }

                $.ajax(
                {
                    type:"POST",
                    url:halaman,    
                    data: kirimdata,
                    cache: false,
                    success: function(data)
                    {
                        if(data==1)
                        {
                            swal.close();
                        }
                        else
                        {
                            var datakembali = JSON.parse(data);
                            txtgambaranumum.value = datakembali.ENT_GAMBARAN_UMUM;
                            txtgeografis.value = datakembali.ENT_GEOGRAFIS;
                            txtbataswilayah.value = datakembali.ENT_BATAS_WILAYAH;
                        }
                    }
                });
                swal.close();
            }

            function isinamadinas()
            {
                $('[name="spnnamadinas"]').html($("#txtnamadinas").val());                
            }

            
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>