<div id="page-wrapper">
<div class="row">
    <br><br>
    <?php
    $no = 1;
    ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Waiting list Proyek
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Proyek</th>
                            <th>Mulai proyek</th>
                            <th>Lihat</th>
                        </tr>
                        </thead>
                        <?php $no = $this->uri->segment(3)+1;
                        foreach ($data_waiting as $b) {
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $no++;?></td>
                            <td align="center"><?php echo $b->namaProyek;?> </td>
                            <td align="center"><?php echo date('d-F-Y',strtotime($b->mulai_proyek)); ?></td>
                            <td align="center">
                                <a class="btn btn-xs btn-success" href="<?php echo base_url();?>Admin/detailProyek/<?php echo $b->id; ?>">Lihat</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>