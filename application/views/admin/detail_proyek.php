<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php
    $no = 1;
    foreach ($peternak as $c){
        $idPeternak = $c->idPeternak;
        $namaPeternak = $c->namaPeternak;
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
				<li class="active">Halaman Detail Proyek</li>
			</ol>
		</div><!--/.row-->
		
		
		
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Proyek
            </div>
            <div class="panel-body">
                <div class="table-responsive">

                    <div class="col-md-12">

                        <div class="col-md-6">
                        <a href="<?php echo base_url();?>Admin/detailPeternak/<?php cetak($idPeternak); ?>">
                            <h2>Proyek Oleh : <?php cetak($namaPeternak); ?></h2>
                        </a>
                        <h3> Investor saat ini : <?php cetak($jml_investor); ?></h3>
                        </div>

                        <div class="col-md-6" align="center">
                            <img src="<?php echo base_url();?>foto/<?php echo $foto_usaha;?>" width="400" height="300">
                            <br><br>
                        </div>

                        <br>
                        <br>
                    </div>

                     <?php 
                            foreach ($proyek as $b){
                        ?>

                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Nama Proyek</th>
                            <th align="center" colspan="2"><?php cetak($b->namaProyek) ?></th>
                        </tr>
                       
                        <tbody>
                        <tr>
                            <td>Kategori</td>
                            <td align="center" colspan="2"> <?php cetak($b->kategori) ?></td>
                        </tr>
                        <tr>
                            <td>Target Dana</td>
                            <td align="center" colspan="2">Rp. <?php cetak(number_format($b->target_dana,0,',','.')); ?></td>
                        </tr>
                        <tr>
                            <td>Saldo Proyek</td>
                            <td align="center" colspan="2">Rp. <?php cetak(number_format($b->saldo_proyek,0,',','.')); ?></td>
                        </tr>
                        <tr>
                            <td>Batas Penggalangan Dana</td>
                            <td align="center" colspan="2"><?php echo date("d-F-Y",strtotime($b->batas_galang)); ?> </td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai Proyek</td>
                            <td align="center" colspan="2"><?php echo date("d-F-Y",strtotime($b->mulai_proyek)); ?> </td>
                        </tr>
                        <tr>
                            <td>Tanggal Akhir Proyek</td>
                            <td align="center" colspan="2"><?php echo date("d-F-Y",strtotime($b->akhir_proyek)); ?>  </td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td align="center" colspan="2"><?php cetak($b->deskripsi); ?></td>
                        </tr>
                        <tr>
                            <td>Surat Izin Usaha<?php  ?></td>
                            <td align="center">
                                <img src="<?php echo base_url();?>foto/<?php echo $b->foto_siup;?>" width="300" height="300">
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <?php }?>
                </div>
                <script>
                    function hanyaAngka(evt) {
                        var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))

                            return false;
                        return true;
                    }
                </script>
                <br>
                <?php if ($status == 0){ ?>
                <div class="col-md-12">

                    <div class="col-md-6">
                        <a href="<?php echo base_url();?>Admin/terimaProyek/<?php cetak($id_proyek); ?>" class="btn btn-success btn-lg" >Terima Proyek</a>
                    </div>

                    <div class="col-md-6" align="center">
                        <a onclick="return confirm('Apakah anda ingin menolak proyek ini ?')" href="<?php echo base_url();?>Admin/tolakProyek/<?php cetak($id_proyek); ?>"
                           class="btn btn-warning btn-lg" >Tolak Proyek</a>
                    </div>

                </div>
                <?php } ?>

            </div>


        </div>
    </div>
</div>
</div>