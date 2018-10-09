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
<?php $user = $this->session->userdata('user'); ?>
<div class="section">
	        <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center"><h1>Topup   Saldo</h1></div>
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
    					<div class="shop-item panel">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-1">
                                        <img src="<?php echo base_url();?>assets1/img/money.png">
                                    </div>
                                    <div class="col-md-3">
                                        <h3>Topup saldo</h3>
                                    </div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-md-1"></div>
                                <div class="col-md-10">

                                    <div class="basic-login" align="center">
                                        <h4>Silakan lakukan Topup dalam waktu 1 x 24 jam, jika tidak maka transaksi anda akan dibatalkan  </h4>

                                        <div class="basic-login">
                                            <h5>Pastikan untuk tidak memberikan informasi Tupup anda ke pihak lain selain Ternak.in</h5>
                                        </div>

                                        <div class="basic-login">
                                            <h3>Transfer Pembayaran ke No. Rekening :</h3>
                                            <h4> Mandiri : 999-999-999-99999  </h4>
                                            <h4>a.n Ternakin</h4>
                                            <br>

                                            <h4>Topup sejumlah: Rp. <?php echo number_format($totalTopUp,0,',','.'); ?> </h4>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
    				</div>
				</div>
            </div>
</div><script type="text/javascript" src="<?php echo base_url();?>assets5/Pemisah.js"></script>