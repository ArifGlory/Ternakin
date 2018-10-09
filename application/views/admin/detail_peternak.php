<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php
    $no = 1;
    ?>
    <?php
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;}
    ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Peternak
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <?php foreach ($peternak as $a) { $id_peternak = $a->idPeternak; ?>
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Nama</th>
                            <th align="center" colspan="2"><?php cetak($a->namaPeternak); ?></th>
                        </tr>
                        <tbody>
                        <tr>
                            <td>Email</td>
                            <td align="center" colspan="2"><?php cetak($a->email); ?></td>
                        </tr>
                        <tr>
                            <td>No. telepon</td>
                            <td align="center" colspan="2"> <?php cetak($a->no_telp); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td align="center" colspan="2"><?php cetak($a->alamat); ?></td>
                        </tr>
                        <tr>
                            <td>Saldo Wallet</td>
                            <td align="center" colspan="2"><?php cetak(rupiah($a->saldo_wallet)); ?></td>
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
              <!--  <div class="col-md-12">
                    <div align="center">
                        <a onclick="return confirm('Apakah Anda Ingin Menghapus Data Pelanggan Ini ?')" href="<//?php echo base_url();?>Admin/Hapus_Customer/<//?php echo $id_peternak; ?>"
                           class="btn btn-warning btn-lg" >Hapus Data Pelanggan</a>
                    </div>
                </div> -->

            </div>
        </div>



    </div>
</div>
</div>