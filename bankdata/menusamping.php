<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="index.php">BANK DATA</a>
            <a href="index.php" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?php echo aturprofil($_SESSION['portalfoto'], $_SESSION['portaljeniskelamin']); ?>" height="35px" style="object-fit: cover; object-position: center;"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo aturprofil($_SESSION['portalfoto'], $_SESSION['portaljeniskelamin']); ?>" height="100px" style="object-fit: cover; object-position: center;"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $_SESSION['portalnama']; ?></div>
                    <div class="profile-data-title"><?php echo $_SESSION['portalunitkerja']; ?></div>
                </div>
                <div class="profile-controls">
                    <a href="mstdetailpegawai.php?nip=<?php echo $_SESSION['portalniplama']; ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
        <li class="xn-title">Dashboard Section</li>
        <li>
            <a href="index.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
        </li>
        <li class="xn-title">Master Section</li>                    
        <li class="xn-openable">
            <a href="#"><span class="fa fa-table"></span> <span class="xn-text">Master</span></a>
            <ul>
                <li><a href="mstentitas.php"><span class="fa fa-university"></span> Entitas</a></li>
                <li><a href="mstbezettingpegawai.php"><span class="fa fa-users"></span> Bezetting Pegawai</a></li>
                <li><a href="mstpenanggungjawab.php"><span class="fa fa-tags"></span> Penanggung Jawab (LO)</a></li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Pemeriksaan</span></a>
            <ul>
                <li><a href="mstriwayatpemeriksaan.php"><span class="fa fa-university"></span> Riwayat Pemeriksaan</a></li>
                <!-- <li><a href="msttimdosir.php"><span class="fa fa-users"></span> Tim Dosir</a></li> -->
            </ul>
        </li>
        <li class="xn-title">Transaction Section</li>
        <li><a href="trnpde.php"><span class="fa fa-desktop"></span> <span class="xn-text"> Pembaharuan Entitas</span></a></li>
         <!--<li class="xn-openable">
            <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">UI Kits</span></a>                        
            <ul>
                <li><a href="ui-widgets.html"><span class="fa fa-heart"></span> Widgets</a></li>                            
                <li><a href="ui-elements.html"><span class="fa fa-cogs"></span> Elements</a></li>
                <li><a href="ui-buttons.html"><span class="fa fa-square-o"></span> Buttons</a></li>                            
                <li><a href="ui-panels.html"><span class="fa fa-pencil-square-o"></span> Panels</a></li>
                <li><a href="ui-icons.html"><span class="fa fa-magic"></span> Icons</a><div class="informer informer-warning">+679</div></li>
                <li><a href="ui-typography.html"><span class="fa fa-pencil"></span> Typography</a></li>
                <li><a href="ui-portlet.html"><span class="fa fa-th"></span> Portlet</a></li>
                <li><a href="ui-sliders.html"><span class="fa fa-arrows-h"></span> Sliders</a></li>
                <li><a href="ui-alerts-popups.html"><span class="fa fa-warning"></span> Alerts & Popups</a></li>                            
                <li><a href="ui-lists.html"><span class="fa fa-list-ul"></span> Lists</a></li>
                <li><a href="ui-tour.html"><span class="fa fa-random"></span> Tour</a></li>
            </ul>
        </li>  -->                  
        
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->