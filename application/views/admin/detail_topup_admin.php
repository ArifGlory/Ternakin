<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php $user = $this->session->userdata('user'); ?>
    <?php
    $no = 1;
    ?>
    <?php
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;}

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

     foreach ($investor as $c){
        $idInvestor = $c->idInvestor;
        $namaInvestor = $c->namaInvestor;

    }
    ?>

    <div class="col-md-12">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-th-list"></em>
				</a></li>
				<li class="active">Halaman Detail Topup</li>
			</ol>
		</div><!--/.row-->
		
		
		
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Topup
            </div>
            <div class="panel-body">
                <div class="table-responsive">

                    <div class="col-md-12">

                        <div class="col-md-6">
                        <a href="<?php echo base_url();?>Admin/detailInvestor/<?php cetak($idInvestor); ?>">
                            <h2>Nama Investor : <?php cetak($namaInvestor); ?></h2>
                        </a>
                            <br>
                        </div>
                        <br>
                        <br>
                    </div>

                     <?php 
                            foreach ($topup as $b){
                        ?>

                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td>Jumlah Topup</td>
                            <td align="center" colspan="2">Rp. <?php cetak(number_format($b->jmlTopup,0,',','.')); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Topup</td>
                            <td align="center" colspan="2"><?php echo date("d-F-Y",strtotime($b->tanggal_topup)); ?> </td>
                        </tr>
                        <tr>
                            <td>Foto Bukti Transfer<?php  ?></td>
                            <td align="center">
                                <img src="<?php echo base_url();?>foto/bukti_bayar/<?php echo $b->foto_bukti;?>" width="300" height="300">
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
                        <a href="<?php echo base_url();?>Admin/terimaTopup/<?php cetak($idTopup); ?>" class="btn btn-success btn-lg" >Verifikasi Topup</a>
                    </div>

                    <div class="col-md-6" align="center">
                        <a onclick="return confirm('Apakah anda ingin menolak topup ini ?')" href="<?php echo base_url();?>Admin/tolakTopup/<?php cetak($idTopup); ?>"
                           class="btn btn-warning btn-lg" >Tolak Topup</a>
                    </div>

                </div>
                <?php } ?>

            </div>


        </div>
    </div>
</div>
</div>