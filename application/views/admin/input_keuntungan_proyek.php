<link rel="stylesheet" href="<?php echo base_url(); ?>assets3/Gallery/css/blueimp-gallery.min.css">
<script src="<?php echo base_url(); ?>assets3/Gallery/js/blueimp-gallery.min.js"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58eb107c9c504492"></script>
<script src="<?php echo base_url();?>/assets1/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>/assets4/plugins/jquery-1.10.2.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />

<div id="page-wrapper">
<div class="row">
    <br><br>
    <h2>Proyek Selesai - Masukkan jumlah keuntungan proyek</h2>
    <h3>Pembagian Keuntungan Proyek</h3>
    <p>
        60% Keuntungan untuk Investor
        <br>
        40% Keuntungan untuk Peternak
        <br>
        Proses pembagian kepada Investor akan dilakukan otomatis setelah anda menekan tombol simpan
    </p>
    <br><br>
    <?php
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;}
    ?>

    <div class="col-md-12">
        <?php echo form_open_multipart('Admin/simpanProyekBerakhir')?>
        <form role="form">
            <div class="form-group">
                <input class="form-control" id="txt_id" name="txt_id" type="hidden" placeholder="" required
                       value="<?php echo $idProyek;?>">

                <label for="register-username"><i class="icon-book"></i> <b>Keuntungan Proyek</b></label>
                <input class="form-control" onkeypress="return hanyaAngka(event)"  id="txt_untungProyek" name="txt_untungProyek" type="text" placeholder=""
                         required    value="<?php echo set_value('txt_untungProyek')?>">
            </div>
            <br>
            <div class="form-group" align="center">
                <button type="submit" id="simpanProyekberakhir" name="simpanProyekberakhir" class="btn btn-lg btn-success">Simpan</button>
                <div class="clearfix"></div>
            </div>
        </form>
        <?php echo form_close();?>
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




        </script>

    </div>
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