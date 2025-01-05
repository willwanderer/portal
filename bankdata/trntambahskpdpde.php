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
                            <li><a href="#tab-lima" role="tab" data-toggle="tab">Rekap</a></li>
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
                                                    <input type="text" class="form-control" id="txtnippejabat" name="txtnippejabat" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Nama</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="password" class="form-control" id="txtnamapejabat" name="txtnamapejabat" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Jabatan</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" id="txtkabatanpejabat" name="txtjabatanpejabat" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">NIP Pejabat</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" id="txtnippejabat" name="txtnippejabat" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Nama Pejabat</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="password" class="form-control" id="txtnamapejabat" name="txtnamapejabat" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Jabatan</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" class="form-control" id="txtkabatanpejabat" name="txtjabatanpejabat" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="tab-pane" id="tab-empat">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum dolor sem, quis pharetra dui ultricies vel. Cras non pulvinar tellus, vel bibendum magna. Morbi tellus nulla, cursus non nisi sed, porttitor dignissim erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis commodo lectus. Vivamus vel tincidunt enim, non vulputate ipsum. Ut pellentesque consectetur arcu sit amet scelerisque. Fusce commodo leo eros, ut eleifend massa congue at.</p>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nama Dinas/Badan/Kantor</label>
                                    <div class="col-md-6 col-xs-12">
                                        <input type="text" class="form-control" value="John"/>                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Second Name</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <input type="text" class="form-control" value="Doe"/>
                                    </div>
                                </div>
                                
                        
                                <div class="form-group">                                        
                                    <label class="col-md-3 col-xs-12 control-label">Date of birth</label>
                                    <div class="col-md-2">
                                        <select class="form-control select">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option selected="selected">04</option>
                                            <option>05</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control select">
                                            <option>01</option>
                                            <option selected="selected">02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control select">
                                            <option>1985</option>
                                            <option>1986</option>
                                            <option>1987</option>
                                            <option>1988</option>
                                            <option selected="selected">1989</option>                                                        
                                        </select>
                                    </div>                                                
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">About</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <textarea class="form-control" rows="5">Morbi tellus nulla, cursus non nisi sed, porttitor dignissim erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis commodo lectus. Vivamus vel tincidunt enim, non vulputate ipsum. Ut pellentesque consectetur arcu sit amet scelerisque. Fusce commodo leo eros, ut eleifend massa congue at.</textarea>
                                        <span class="help-block">Somethink about your life</span>
                                    </div>
                                </div>                                           

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">E-mail</label>
                                    <div class="col-md-6 col-xs-12">                                                                                                                                        
                                        <label class="check"><input type="checkbox" class="icheckbox" checked="checked"/> I want to get emails</label>
                                        <span class="help-block">If you wish of course</span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane" id="tab-lima">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum dolor sem, quis pharetra dui ultricies vel. Cras non pulvinar tellus, vel bibendum magna. Morbi tellus nulla, cursus non nisi sed, porttitor dignissim erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis commodo lectus. Vivamus vel tincidunt enim, non vulputate ipsum. Ut pellentesque consectetur arcu sit amet scelerisque. Fusce commodo leo eros, ut eleifend massa congue at.</p>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nama Dinas/Badan/Kantor</label>
                                    <div class="col-md-6 col-xs-12">
                                        <input type="text" class="form-control" value="John"/>                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Second Name</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <input type="text" class="form-control" value="Doe"/>
                                    </div>
                                </div>

                                <div class="form-group">                                        
                                    <label class="col-md-3 col-xs-12 control-label">Date of birth</label>
                                    <div class="col-md-2">
                                        <select class="form-control select">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option selected="selected">04</option>
                                            <option>05</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control select">
                                            <option>01</option>
                                            <option selected="selected">02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control select">
                                            <option>1985</option>
                                            <option>1986</option>
                                            <option>1987</option>
                                            <option>1988</option>
                                            <option selected="selected">1989</option>                                                        
                                        </select>
                                    </div>                                                
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">About</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <textarea class="form-control" rows="5">Morbi tellus nulla, cursus non nisi sed, porttitor dignissim erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis commodo lectus. Vivamus vel tincidunt enim, non vulputate ipsum. Ut pellentesque consectetur arcu sit amet scelerisque. Fusce commodo leo eros, ut eleifend massa congue at.</textarea>
                                        <span class="help-block">Somethink about your life</span>
                                    </div>
                                </div>                                           

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">E-mail</label>
                                    <div class="col-md-6 col-xs-12">                                                                                                                                        
                                        <label class="check"><input type="checkbox" class="icheckbox" checked="checked"/> I want to get emails</label>
                                        <span class="help-block">If you wish of course</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="panel-footer">                                                                        
                            <button class="btn btn-primary pull-right">Save Changes <span class="fa fa-floppy-o fa-right"></span></button>
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

            function isinamadinas()
            {
                $('[name="spnnamadinas"]').html($("#txtnamadinas").val());                
            }

            
        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>