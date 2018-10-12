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
<?php $user = $this->session->userdata('user');

foreach ($topup as $b){
    $tgl_topup = $b->tanggal_topup;
    $jml_topup = $b->jmlTopup;
    $status = $b->status;
    if ($status == 0){
        $sttusTopup = "Belum diverifikasi";
    }else{
        $sttusTopup = "Telah diverifikasi";
    }
    $buktiBayar = $b->foto_bukti;
    $idTopup = $b->idTopup;
}

?>
<div class="section">
	        <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center"><h1>Wallet Investor</h1></div>
                </div>
                <br>
				<div class="row">
        			<div class="col-md-2">
                        <div class="col-md-12 panel text-center" style="padding-top:10px">
        					<a href="<?php echo base_url(); ?>Investor/profil"><img src="<?php echo base_url();?>assets1/img/ubah-Profil.png"><h4>Profil</h4></a>
        				</div>
                        <div class="col-md-12 panel text-center" style="padding-top:10px">
                            <a href="<?php echo base_url(); ?>Investor/wallet"><img src="<?php echo base_url();?>assets1/img/wallet.png"><h4>Wallet</h4></a>
                        </div>
        			</div>
        			<div class="col-md-10">
    					<div class="shop-item panel text-center">
                            <div class="panel-body">
                                <h3>Detail Topup</h3>
                                <div class="col-md-12" align="left">
                                    <div class="col-md-1">
                                    <img src="<?php echo base_url();?>assets1/img/wallet.png">
                                    </div>
                                    <div class="col-md-5">
                                    <h4>Saldo Anda : Rp. <?php cetak(number_format($user['saldo'],0,',','.')); ?> </h4>
                                    <br><br>
                                    </div>
                                </div>



                                <h3>Top Up Tanggal : <?php echo date('d-F-Y',strtotime($tgl_topup));?></h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td><b>Jumlah Topup</b></td>
                                            <td>
                                                Rp. <?php cetak(number_format($jml_topup,0,',','.')); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                <?php cetak($sttusTopup); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Bukti bayar</b></td>
                                            <td align="center">
                                                <?php if ($buktiBayar == null) { ?>
                                                <img src="<?php echo base_url();?>foto/bukti_bayar/belum_upload.png" width="300" height="300">
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url();?>foto/bukti_bayar/<?php cetak($buktiBayar); ?>" width="300" height="300">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br>

                                <?php if ($status == 0) { ?>
                                <div class="col-md-12" align="left">

                                    <?php echo form_open_multipart('Gambar/uploadBuktiTopup')?>
                                    <div class="form-group">
                                        <label for="register-username"><i class="icon icon-book"></i> <b>Upload Foto Bukti Transfer</b></label>
                                        <input type="file" name="userfile" id="userfile" class="form-control" required>
                                    </div>

                                    <input class="form-control" id="txt_id" name="txt_id" type="hidden" placeholder=""
                                           value="<?php echo cetak($idTopup); ?>" required>

                                    <div class="form-group">
                                        <button type="submit" id="upload_bukti" name="upload_bukti" class="btn btn-lg">Simpan</button>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
    				</div>
				</div>
            </div>
</div>