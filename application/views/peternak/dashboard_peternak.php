<!-- Aambil dari assest3 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets3/Gallery/css/blueimp-gallery.min.css">
<script src="<?php echo base_url(); ?>assets3/Gallery/js/blueimp-gallery.min.js"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58eb107c9c504492"></script>
<script src="<?php echo base_url();?>/assets1/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>/assets4/plugins/jquery-1.10.2.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />

<div>

</div>

<div class="section">
	        <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center"><h3>Halo, Selamat Datang Di</h3></div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center"><h1>Dashboard Peternak</h1></div>
                </div>
                <br>
				<div class="row">
        			<div class="col-md-2">
                        <div class="col-md-12 panel text-center" style="padding-top:10px">
        					<a href="<?php echo base_url(); ?>Peternak/buatProyek"><img src="<?php echo base_url();?>assets1/img/list_beli.png"><h4>Buat Proyek</h4></a>
        				</div>
                        <div class="col-md-12 panel text-center" style="padding-top:10px">
        					<a href="<?php echo base_url(); ?>Peternak/profil"><img src="<?php echo base_url();?>assets1/img/ubah-Profil.png"><h4>Profil</h4></a>
        				</div>
        			</div>
        			<div class="col-md-10">
    					<div class="shop-item panel text-center">
                            <div class="panel-body">
                                <h3>Proyek Anda</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Proyek</th>
                                            <th>Target Dana</th>
                                            <th>Batas Penggalangan</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <?php $no = $this->uri->segment(3)+1;
                                        ?>
                                        <tbody>
                                        <?php foreach ($proyek as $b) {?>
                                            <tr>
                                                <td><?php echo $no++;?></td>
                                                <td><?php cetak($b->namaProyek) ?></td>
                                                <td>Rp. <?php cetak(number_format($b->target_dana,0,',','.')); ?></td>
                                                <td><?php echo date("d-F-Y",strtotime($b->batas_galang)); ?></td>
                                                <td><?php cetak($b->kategori) ?></td>
                                                <td style="width: 190px;" align="center">
                                                    <div>
                                                        <a href="<?php echo base_url();?>Peternak/detailProyek/<?php cetak($b->id_proyek) ?>" class="btn btn-success btn-xs">Lihat</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    				</div>
				</div>
            </div>
</div>