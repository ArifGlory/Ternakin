<!--  page-wrapper -->
<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!--End Page Header -->
    </div>

    <div class="row">
        <!-- Welcome -->
        <div class="col-lg-12">
            <div class="alert alert-info">
                <i class="fa fa-folder-open"></i><b>&nbsp;Hallo ! </b>Selamat Datang Kembali,<b> Admin</b>
            </div>
        </div>
        <!--end  Welcome -->
    </div>


    <div class="row">
        <!--quick info section -->
        <div class="col-lg-3">
            <div class="alert alert-info text-center">
                <i class="fa fa-clipboard fa-3x"></i>&nbsp;<b><?php echo $jml_proyek;?> </b>Proyek

            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-success text-center">
                <i class="fa  fa-user fa-3x"></i>&nbsp;<b><?php echo $jml_peternak;?>  </b>Peternak
            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-success text-center">
                <i class="fa fa-user fa-3x"></i>&nbsp;<b><?php echo $jml_investor;?>  </b>Investor

            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-warning text-center">
                <i class="fa fa-sign-out fa-2x"></i>&nbsp;<b>Jangan Lupa untuk Logout</b>
            </div>
        </div>
        <!--end quick info section -->
    </div>

</div>
<!-- end page-wrapper -->

<!-- end wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="<?php echo base_url();?>assets3/plugins/jquery-1.10.2.js"></script>
<script src="<?php echo base_url();?>assets3/plugins/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets3/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>assets3/plugins/pace/pace.js"></script>
<script src="<?php echo base_url();?>assets3/scripts/siminta.js"></script>
<!-- Page-Level Plugin Scripts-->
<script src="<?php echo base_url();?>assets3/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets3/plugins/morris/morris.js"></script>
<script src="<?php echo base_url();?>assets3/scripts/dashboard-demo.js"></script>

</body>

</html>