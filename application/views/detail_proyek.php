<div class="container">
    <div class="col-md-12" style="margin-top:50px">
        <?php
        function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;}
        ?>
        <?php
        foreach ($proyek as $b){
        ?>
        <div class="row">
            <div class="col-md-4 form-group">
                <div class="row">
                    <div class="col-md-12" style="padding:0">
                        <img src="<?php echo base_url();?>/foto/<?php echo $b->foto_usaha;?>" style="width:380px;height:235px">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel" style="padding:10px">
                                <h4>Deskripsi Ringkas</h4>
                                <p><?php echo $proyek['deskripsi'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <h2 style="margin-top:0;margin-bottom:5"><b><?php echo $proyek['namaProyek'];?></b></h2>
                </div>
                <div class="row" style="margin-top:0">
                    <div class="col-md-12" style="text-align:center;padding:0">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-green btn">
                                    <p><b>90</b></p><b>Hari</b></a>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-green btn">
                                    <p><b>4,90%</b></p><b>Est.Profit</b></a>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-green btn">
                                    <p><b>Resiko</b></p><b>Sedang</b></a>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="col-md-12">
                    <div class="row">
                        <table border="0">
                            <tr>
                                <td>
                                    <b>Mulai dari <?php echo rupiah($proyek['minimal_dana'])?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Lokasi : <?php echo $proyek['lokasi']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Skema : Bagi Hasil</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Timeline Proyek : <?php echo date('d-F-Y',strtotime($proyek['mulai_proyek']));?>  - <?php echo date('d-F-Y',strtotime($proyek['akhir_proyek']));?></b>
                                </td>
                            </tr>
                        </table>
                    </div><br>
                    <div class="row">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">20%</div>
                        </div>
                    </div>
                    <div class="row">
                    <table border="0">
                            <tr>
                                <td>
                                    <b>*Periode Penggalangan Dana*</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Pendanaan Saat ini : <?php echo rupiah($proyek['saldo_proyek'])?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kebutuhan Dana : <?php echo rupiah($proyek['target_dana'])?> </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Akhir Penggalangan : <?php echo date('d-F-Y',strtotime($proyek['batas_galang']));?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Investor Saat ini : 2 Orang</b>
                                </td>
                            </tr>
                        </table>
                        </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="col-md-12 panel">
                   <div class="row">
                      <div class="col-md-4" style="padding-top:10px">
                          <img src="<?php echo base_url();?>assets2/user.jpg">
                      </div>
                       <div class="col-md-8" style="padding-top:10px;padding-left:0px">
                           <h3>Proyek Oleh<p><b><?php cetak($peternak['namaPeternak']) ?></b></p></h3>
                       </div>
                       <script>
                           function hanyaAngka(evt) {
                               var charCode = (evt.which) ? evt.which : event.keyCode
                               if (charCode > 31 && (charCode < 48 || charCode > 57))

                                   return false;
                               return true;
                           }
                       </script>
                    </div>
                        <h5 style="text-align:center"><b>Ayo Investasi !</b><p>diproyek ini</p></h5>
                        <h6 style="text-align:center"><b>Masukan Investasi Kamu</b><p>Masukan investasi minimal <?php echo rupiah($proyek['minimal_dana'])?></p></h6>
                      <form class="form-horizontal">

                       <div class="form-group">
                        <label></label>
                        <input type="text" class="form-control" placeholder="<?php echo rupiah($proyek['minimal_dana'])?>"
                               width="180" style="text-align:center" onkeypress="return hanyaAngka(event)" id="txt_invest" name="txt_invest">
                        <br>
                        <!--<h6 style="text-align:center;">Setelah batas waktu investasi pengembalian<p>modal + keuntungan</p></h6>
                        <h3 style="text-align:center;">
                            Rp.0,-
                        </h3>-->
                        <br>
                        <div class="row" style="text-align:center">
                            <a type="submit" href="<?php echo base_url();?>Investor/berhasilInvest" class="btn btn-green" id="invest" name="invest">Investasi Sekarang</a>
                        </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>