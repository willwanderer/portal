<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="index.php" class="logo icon">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <img src="../img/logo/PengingatTugas.png" width="80px">
        
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <?php
            if(!empty($_SESSION['portalnipbaru']))
            {   
                ?>
                    <!-- Sidebar toggle button-->
                    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                <?php
            }
        ?>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <?php
                    if(empty($_SESSION['portalnipbaru']))
                    {
                        ?>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="kelogin()">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <span>Masuk Aplikasi</span>
                                </a>
                            </li>
                        <?php
                    }
                    else
                    {
                        ?>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <span><?php echo $_SESSION['portalnama'] ?> <i class="caret"></i></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header bg-light-blue">
                                        <img src="<?php echo aturprofil($_SESSION['portalfoto'], $_SESSION['portaljeniskelamin']);?>" class="img-circle" style="object-fit: cover; object-position: center;"/>
                                        <p>
                                            <?php echo $_SESSION['portalnama'] ?> - <?php echo $_SESSION['portaljabatan'] ?>
                                            <small><?php echo $_SESSION['portalunitkerja'] ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
            <!--                             <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div> -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a onclick="cekkeluar()" class="btn btn-default btn-flat">Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </nav>
</header>