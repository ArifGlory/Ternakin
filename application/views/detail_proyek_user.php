<link rel="stylesheet" href="<?php echo base_url(); ?>assets3/Gallery/css/blueimp-gallery.min.css">
<script src="<?php echo base_url(); ?>assets3/Gallery/js/blueimp-gallery.min.js"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58eb107c9c504492"></script>
<script src="<?php echo base_url();?>/assets1/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>/assets4/plugins/jquery-1.10.2.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />

<?php
foreach ($gambar_utama as $d){
    $namaGambarUtama = $d->namaGambar;
}

foreach ($proyek as $c){
    $idProyek = $c->id_proyek;
    $saldoProyek = $c->saldo_proyek;
    $targetDana = $c->target_dana;
}
?>

<div class="section">
    <div class="container">
        <?php 
            foreach ($proyek as $b){
        ?>
        <div class="row">
            <!-- Product Image & Available Colors -->
            <div class="col-sm-6">
                <div class="product-image-large">
                    <img src="<?php echo base_url();?>foto/<?php cetak($namaGambarUtama); ?>" alt="Item Name"
                         height="400" width="600">
                    <br>
                </div>
                <h4>Foto lainnya dari Proyek ini</h4>
                <div id="myAlert">
                    <div id="links">
                        <?php
                        foreach ($gambar as $c){
                            ?>
                            <a href="<?php echo base_url();?>foto/<?php cetak($c->namaGambar); ?>" title="Produk">
                                <img src="<?php echo base_url();?>foto/<?php cetak($c->namaGambar); ?>" width="70" height="70" alt="aa">
                            </a>
                        <?php } ?>
                    </div>
                </div>


            </div>
            <!-- End Product Image & Available Colors -->
            <!-- Product Summary & Options -->
            <div class="col-sm-6 product-details">
                <h3> <?php echo($b->namaProyek) ?></h3>
                <br>
                <table class="shop-item-selections">
                    <!-- Color Selector -->
                    <tr>
                        <td> <b>Jenis :</b></td>
                        <td>
                            <?php cetak($b->kategori); ?>
                        </td>
                    </tr>
                    <tr>
                        <td> <b>Hasil Ternak</b></td>
                        <td>
                            <?php cetak($b->hasil_ternak); ?>
                        </td>
                    </tr>
                    <tr>
                        <td> <b>Batas Penggalangan</b></td>
                        <td><?php echo date("d-F-Y",strtotime($b->batas_galang)); ?></td>
                    </tr>
                    <tr>
                        <td> <b>Mulai Proyek</b></td>
                        <td><?php echo date("d-F-Y",strtotime($b->mulai_proyek)); ?></td>
                    </tr>
                    <tr>
                        <td> <b>Akhir Proyek</b></td>
                        <td><?php echo date("d-F-Y",strtotime($b->akhir_proyek)); ?></td>
                    </tr>
                    <tr>
                        <td><b>Dana Terkumpul :</b></td>
                        <td>
                            Rp. <?php echo(number_format($b->saldo_proyek,0,',','.')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Target Dana :</b></td>
                        <td>
                            Rp. <?php echo(number_format($b->target_dana,0,',','.')); ?>
                        </td>
                    </tr>
                    <!-- Size Selector -->
                    <tr>
                        <td><b>Investor saat ini :</b></td>
                        <td>
                           <?php echo $jmlInvestor; ?> Orang
                        </td>
                    </tr>
                    <!-- Quantity -->
                </table>
                <br>
                <div class="section">
                <h3>Progres Penggalangan Dana</h3>

                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php cetak($persentase); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php cetak($persentase); ?>%">
                        <?php cetak($persentase); ?>%
                    </div>
                </div>
                <div class="col-sm-12 product-image-large">
                    <h4>
                        <?php echo($b->deskripsi) ?>
                    </h4>
                </div>
                <br><br>

                <!-- skill bar disini-->




                <div class="col-sm-4">
                    <br>
                </div>
                <?php if ($saldoProyek != $targetDana){ ?>
                <?php echo form_open_multipart('Investor/lakukanInvestasi/'.$idProyek)?>
                <input type="hidden" value="<?php echo($b->id_proyek) ?>" id="txt_id" name="txt_id">
                <button class="btn btn-green btn-lg" type="submit">Investasi di Proyek ini</button>
                <?php  echo form_close() ;?>
                <?php } ?>

                <script>
                    function sweet (){
                        swal("Good job!", "You clicked the button!", "success");
                    }
                    function biasa() {
                        swal("Your message");
                    }
                    function withTime() {
                        swal({
                            title: "Alert dengan waktu",
                            text: "Pesan ini akan hilang dalam 2 detik",
                            timer: 2000
                        });
                    }
                    function stokHabis() {
                        swal("Stok Habis!", "Anda tidak bisa membeli barang ini karena stoknya telah habis", "error");
                    }
                </script>

            </div>


            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
            <div id="blueimp-gallery" class="blueimp-gallery">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>

            <!-- The Gallery as inline carousel, can be positioned anywhere on the page -->
            <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<script>
    window.baseUrl = '<?php echo base_url() ?>';

    document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };

    $( document ).ajaxComplete(function( event, xhr, settings ) {
        console.log(settings);
    });

    function myAlert(Aclass, text) {
        html = '<div class="alert ' + Aclass + ' alert-dismissible fade show" role="alert" style="margin-top: 25px">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button>'+
            ''+text+'.'+
            '</div>';
        $("#myAlert").html(html).show();
    }
</script>