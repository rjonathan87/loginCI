<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $this->session->userdata('fotografia'); ?>" alt="">
                        <?php
echo $this->session->userdata('nombre');
echo "&nbsp";
echo $this->session->userdata('ap_patern');
?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="javascript:;"> Profile</a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">Help</a> -->
                        <a href="<?php echo site_url("login/logout"); ?>" class="dropdown-item">
                            <i class="fa fa-sign-out pull-right"></i>Salir</a>
                    </div>
                </li>
                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="<?php echo base_url('/resources/img/instalador.jpg') ?>"
                                        alt="Profile Image" /></span>
                                <span>
                                    <span>Alberto Ramírez</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Reemplazar material de instalación Urgente...
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>Mostrar todas las alertas</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>