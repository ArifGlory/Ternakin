<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php
    $no = 1;
    foreach ($peternak as $c){
        $idPeternak = $c->idPeternak;
        $namaPeternak = $c->namaPeternak;
    }
    foreach ($gambar_utama as $c){
        $namaGambarUtama = $c->namaGambar;
    }
    foreach ($proyek as $d){
        $idProyek = $d->id_proyek;
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

    <div class="row">
        <div class="container" style="padding-left: 120px; padding-right: 140px">
            <div class="col-md-12">
                <div class="shop-item panel text-center">
                    <div class="panel-body">
                        <h3>Investor di Proyek ini</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Nominal Investasi</th>
                                </tr>
                                </thead>
                                <?php $no = 1;
                                ?>
                                <tbody>
                                <?php foreach ($investor as $c) {?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
                                        <td><?php cetak($c->namaInvestor) ?></td>
                                        <td>Rp. <?php cetak(number_format($c->jml_invest,0,',','.')); ?></td>
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
                        <h3> Investor saat ini : <?php echo($jmlInvestor); ?></h3>
                        </div>

                        <div class="col-md-6" align="center">
                            <img src="<?php echo base_url();?>foto/<?php cetak($namaGambarUtama);?>" width="400" height="300">
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
                            <td>Status</td>
                            <?php if ($b->status == 0){ ?>
                            <td align="center" colspan="2"> Menunggu Verifikasi</td>
                            <?php }else if ($b->status == 1) { ?>
                                <td align="center" colspan="2"> Proyek Aktif - Sedang Penggalangan</td>
                            <?php }else if ($b->status == 2) { ?>
                                <td align="center" colspan="2"> Proyek Non-Aktif</td>
                            <?php }else if ($b->status == 3) { ?>
                                <td align="center" colspan="2"> Proyek Sedang Dikerjakan</td>
                            <?php }else if ($b->status == 4) { ?>
                                <td align="center" colspan="2"> Proyek Selesai</td>
                            <?php } ?>
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
                <?php }else if ($status == 4){ ?>



             <?php }  else { ?>

                <div class="col-md-12">
                    <?php echo form_open_multipart('Admin/ubahStatusProyek'); ?>
                    <form>
                    <div class="form-group">
                        <input class="form-control" id="txt_id" name="txt_id" type="hidden" placeholder="" required
                               value="<?php echo $idProyek;?>">

                        <label for="register-username"><i class="icon-user"></i> <b>Ubah Status Proyek</b></label>
                        <select id="combobx_ubahStatusProyek" required name="combobx_ubahStatusProyek" class="form-control">
                            <option value="2">Nonaktifkan Proyek</option>
                            <option value="3">Pindah ke Proyek Sedang Dikerjakan</option>
                            <option value="4">Pindah ke Proyek Selesai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="edit_status" name="edit_status" class="btn btn-lg btn-success">Ubah Status Proyek</button>
                        <div class="clearfix"></div>
                    </div>
                    </form>
                    <?php echo form_close();?>
                </div>

                <?php } ?>
            </div>


        </div>
    </div>
</div>
</div>