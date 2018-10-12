 <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets5/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>assets5/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php
    $no = 1;
    if ($verified == "false"){
        $pesanVerifikasi = "Belum Diverifikasi";
    }else{
        $pesanVerifikasi = "Telah Diverifikasi";
    }
    ?>
    <?php
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;}
    ?>

    <div class="col-md-12">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-th-list"></em>
				</a></li>
				<li class="active">Halaman Data Topup <?php cetak($pesanVerifikasi); ?></li>
			</ol>
		</div><!--/.row-->

    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tabel_sapi">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Topup</th>
                            <th>Jumlah Topup</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <?php $no = $this->uri->segment(3)+1;
                        ?>
                        <tbody>
                        <?php 
                            foreach ($topup as $b){
                        ?>
                        <tr>
                            <td><?php echo $no++;?></td>
                            <td><?php echo date("d-F-Y",strtotime($b->tanggal_topup)); ?></td>
                            <td>Rp. <?php cetak(number_format($b->jmlTopup,0,',','.')); ?></td>
                            <td style="width: 190px;" align="center">
                                <div>
                                    <a href="<?php echo base_url();?>Admin/detailTopup/<?php cetak($b->idTopup) ?>" class="btn btn-success btn-xs">Lihat</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


  <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets5/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets5/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets5/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets5/Pemisah.js"></script>
    <script>
    $(document).ready(function() {
        $('#tabel_sapi').DataTable({
            responsive: true
        });
    });
    
    </script>