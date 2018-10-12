<!-- navbar side -->
<nav class="navbar-default navbar-static-side" role="navigation">
    <!-- sidebar-collapse -->
    <div class="sidebar-collapse">
        <!-- side-menu -->
        <ul class="nav" id="side-menu">
            <li>
                <!-- user image section-->
                <div class="user-section" style="margin-top:10px">
                    <div class="user-section-inner">
                        <img src="<?php echo base_url();?>assets3/img/user.jpg" alt="">
                    </div>
                    <div class="user-info">
                        <div>
                            <?php
                                echo "Admin";
                             ?>
                        </div>
                        <div class="user-text-online">
                            <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                        </div>
                    </div>
                </div>
                <!--end user image section-->
            </li>
            <li>
                <a href="<?php echo base_url();?>Admin"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>Admin/listWaiting"><i class="fa fa-list fa-fw"></i>Waiting list</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>Admin/listProyek"><i class="fa fa-clipboard fa-fw"></i>Proyek</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>Admin/listTopup"><i class="fa fa-shopping-cart fa-fw"></i>List Topup</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>Admin/listTopupVerified"><i class="fa fa-shopping-cart fa-fw"></i>Riwayat Topup</a>
            </li>
         <!--   <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Data Pengguna<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i>Peternak</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i>Investor</a>
                    </li>
                </ul>
                <!-- second-level-items --
            </li> -->
            <li>
                <a href="<?php echo base_url();?>Login/logout"><i class="fa fa-clipboard fa-fw"></i>Logout</a>
            </li>
        </ul>
        <!-- end side-menu -->
    </div>
    <!-- end sidebar-collapse -->
</nav>
<!-- end navbar side -->