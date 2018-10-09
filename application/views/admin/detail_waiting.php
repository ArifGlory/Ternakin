<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php
    $no = 1;
    foreach ($gambar_utama as $c){
        $namaGambarUtama = $c->namaGambar;
    }
    ?>
    <?php
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;}
    ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Waiting list Proyek
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Nama Proyek</th>
                            <th align="center"><?php echo $temporary['namaProyek'];?></th>
                        </tr>
                        <tbody>
                        <tr>
                            <td>Target Dana</td>
                            <td align="center"><?php echo rupiah($temporary['target_dana']);?></td>
                        </tr>
                        <tr>
                            <td>Minimal Dana</td>
                            <td align="center"><?php echo rupiah($temporary['minimal_dana']);?> </td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td align="center"><?php echo $temporary['lokasi'];?> </td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td align="center"><?php echo $temporary['deskripsi'];?> </td>
                        </tr>
                        <tr>
                            <td>Batas Penggalangan Dana</td>
                                <td align="center"><?php echo date('d-F-Y',strtotime($temporary['batas_galang']));?> </td>
                        </tr>
                        <tr>
                            <td>Mulai proyek</td>
                            <td align="center"><?php echo date('d-F-Y',strtotime($temporary['mulai_proyek']));?> </td>
                        </tr>
                        <tr>
                            <td>Akhir proyek</td>
                            <td align="center"><?php echo date('d-F-Y',strtotime($temporary['akhir_proyek']));?> </td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <?php if ($temporary['kategori'] == 0){ ?>
                            <td align="center">Mamalia</td>
                            <?php } else { ?>
                            <td align="center">Unggas</td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Foto Surat Usaha</td>
                            <td align="center">
                                <img src="<?php echo base_url();?>/foto/<?php echo $temporary['foto_siup'];?>" width="300" height="300">
                            </td>
                        </tr>
                        <tr>
                            <td>Foto Usaha</td>
                            <td align="center">
                                <img src="<?php echo base_url();?>/foto/<?php cetak($namaGambarUtama); ?>" width="300" height="300">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <script>
                    function hanyaAngka(evt) {
                        var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))

                            return false;
                        return true;
                    }
                </script>

                <div class="col-md-12">
                    <?php echo validation_errors();?>
                    <?php echo form_open_multipart('Admin/lakukanVerifikasi')?>
                    <div class="form-group col-md-9">
                        <label for="register-username"><i class="icon-user"></i> <b>Estimasi Profit (Isi jika menerima Proyek ini)</b></label>
                        <input class="form-control" id="txt_estimasi" name="txt_estimasi" type="text" placeholder=""
                        onkeypress="return hanyaAngka(event)">
                        <input class="form-control" id="txt_id_temp" name="txt_id_temp" value="<?php echo $temporary['id']; ?>" type="hidden" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <br>
                        <button type="submit" id="verifikasi" name="verifikasi" class="btn btn-success">Verifikasi</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <br>

                <div class="col-md-12">
                    <?php echo validation_errors();?>
                    <?php echo form_open_multipart('Admin/tolakVerifikasi')?>
                    <div class="form-group col-md-9">
                        <label for="register-username"><i class="icon-user"></i> <b>Alasan Menolak (Isi jika Menolak Proyek ini)</b></label>
                        <input class="form-control" id="txt_alasan" name="txt_alasan" type="text" placeholder="">
                        <input class="form-control" id="txt_id_temp" name="txt_id_temp" value="<?php echo $temporary['id']; ?>" type="hidden" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <br>
                        <button type="submit" id="tolak" name="tolak" class="btn btn-danger">Tolak</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>


        </div>
    </div>
</div>
</div>