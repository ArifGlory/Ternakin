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
    $estimasiProfit = $c->estimasi;
    $idProyek = $c->id_proyek;
}
?>
<?php
$pesan = $this->session->flashdata('error');
$warning =  $this->session->flashdata('warning');
?>
<?php
if (isset($pesan)){ ?>
    <script>
        window.addEventListener("load", function(){
            // ....
            saldoTidakCukup();
        });
    </script>
<?php   } ?>
<?php
if (isset($warning)){ ?>
    <script>
        window.addEventListener("load", function(){
            // ....
            investMelebihiBatas();
        });
    </script>
<?php   } ?>

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
                    function saldoTidakCukup() {
                        swal("Saldo tidak cukup!", "Saldo anda tidak cukup untuk berinvestasi di proyek ini", "error");
                    }
                    function investMelebihiBatas() {
                        swal("Investasi melebihi batas!", "Investasi anda melebihi batas target dana", "error");
                    }

                    window.addEventListener("load", function(){
                        // ....

                    });
                </script>


            </div>
            <!-- End Product Image & Available Colors -->
            <!-- Product Summary & Options -->
            <div class="col-sm-6 product-details">
                <h3> <?php echo($b->namaProyek) ?></h3>
                <br>
                <div class="basic-login">
                    <script>
                        var txtEstimasi = document.getElementById('txt_estimasi');
                        var txtJmlInvest = document.getElementById('txt_jmlInvest');
                        var separator = ".";
                        var a = txtJmlInvest.value;
                        var b = a.replace(/[^\d]/g,"");
                        var c = "";
                        var  panjang = b.length;
                        var j = 0;

                        function hanyaAngka(evt) {
                            var charCode = (evt.which) ? evt.which : event.keyCode
                            if (charCode > 31 && (charCode < 48 || charCode > 57)){
                                return false;
                            }else {
                               return true;
                            }
                        }

                        function convertToRupiah(angka)
                        {
                            var rupiah = '';
                            var angkarev = angka.toString().split('').reverse().join('');
                            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
                        }

                        function hitungEstimasi(evt) {
                           // sweet();
                            var i = <?php echo $estimasiProfit?>;
                            var jmlInvest = document.getElementById('txt_jmlInvest').value;
                            jmlInvest = parseInt(jmlInvest);
                            var  untung = i * jmlInvest / 100 ;
                            var hasil = untung + jmlInvest;

                            document.getElementById("txt_estimasi").value ="Rp. " +hasil;

                            return true;
                        }


                    </script>

                    <?php echo form_open_multipart('Investor/simpanInvestasi')?>
                    <form role="form">
                    <div class="form-group">
                        <input class="form-control" id="txt_id" name="txt_id" type="hidden" placeholder="" required
                               value="<?php echo $idProyek;?>">

                        <label for="register-username"><i class="icon-book"></i> <b>Jumlah Investasi</b></label>
                        <input class="form-control" onkeypress="return hanyaAngka(event)"  id="txt_jmlInvest" name="txt_jmlInvest" type="text" placeholder=""
                           onkeyup="return hitungEstimasi(event)"   required    value="<?php echo set_value('txt_jmlInvest')?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="register-username"><i class="icon-dribbble"></i> <b>Ekspektasi Pengembalian (Modal+Keuntungan)</b></label>
                        <input class="form-control" onkeypress="return hanyaAngka(event)" id="txt_estimasi" name="txt_estimasi" type="text" placeholder=""
                             disabled  value="<?php echo set_value('txt_estimasi')?>">
                    </div>
                    <div class="form-group" align="center">
                        <button type="submit" id="do_investasi" name="do_investasi" class="btn btn-lg">Investasikan</button>
                        <div class="clearfix"></div>
                    </div>
                    </form>
                    <?php echo form_close();?>

                </div>



                <div class="col-sm-4">
                    <br>
                </div>


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
<script type="text/javascript" src="<?php echo base_url();?>assets5/Pemisah.js"></script>