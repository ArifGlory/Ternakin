
<div class="section">
    <div class="container">
        <div class="row">

            <div class="col-md-12" style="text-align: center">
                <div class="row">
                    <img src="<?php echo base_url(); ?>assets2/kandang.png">
                </div>
            </div>

            <br>
            <?php
            function rupiah($angka){
                $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                return $hasil_rupiah;}
            ?>

            <?php foreach ($data_proyek as $b) { ?>
            <div class="col-sm-4">
                <!-- Product -->
                <div class="shop-item">
                    <!-- Product Image -->
                    <div class="image">
                        <a href="<?php echo base_url();?>Utama/detailProyek/<?php echo $b->id_proyek; ?>"><img src="<?php echo base_url();?>foto/<?php echo $b->foto_usaha;?>" alt="Item Name"></a>
                    </div>
                    <!-- Product Title -->
                    <div class="title">
                        <h3><a href="<?php echo base_url();?>Utama/detailProyek/<?php echo $b->id_proyek; ?>"><?php echo $b->namaProyek;?></a></h3>
                    </div>
                    <!-- Product Available Colors-->

                    <!-- Product Price-->
                    <div class="price">
                        <span class="price-was"></span> <?php echo rupiah($b->target_dana);?>
                    </div>
                    <!-- Product Description-->
                    <div class="description">
                        <p><?php echo $b->deskripsi;?></p>
                    </div>
                    <!-- Add to Cart Button -->
                    <div class="actions">
                    </div>
                </div>
                <!-- End Product -->
            </div>
            <?php } ?>

            </div>

        <div class="row">
            <div class="pagination-wrapper ">
                <ul class="pagination pagination-lg">
                    <li class="disabled"><a href="#">Previous</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">8</a></li>
                    <li><a href="#">9</a></li>
                    <li><a href="#">10</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>