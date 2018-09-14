<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-5">
                <img src="<?php echo base_url();?>assets2/akunbaru2.png">
                <?php echo validation_errors();?>
                <div class="basic-login">
                    <?php echo form_open_multipart('Utama/simpanPeternak')?>
                    <form role="form">
                        <h3>Daftar Peternak</h3>
                        <br>
                        <div class="form-group">
                            <label for="register-username"><i class="icon-user"></i> <b>Nama</b></label>
                            <input class="form-control" id="txt_name" name="txt_name" type="text" placeholder=""
                            value="<?php echo set_value('txt_name')?>" required>
                        </div>
                        <div class="form-group">
                            <label for="register-username"><i class="icon-user"></i> <b>Email</b></label>
                            <input class="form-control" id="txt_email" name="txt_email" type="text" placeholder=""
                                   value="<?php echo set_value('txt_email')?>" required>
                        </div>
                        <script>
                            function hanyaAngka(evt) {
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))

                                    return false;
                                return true;
                            }
                        </script>
                        <div class="form-group">
                            <label for="register-username"><i class="icon-user"></i> <b>No. Telepon</b></label>
                            <input class="form-control" onkeypress="return hanyaAngka(event)" id="txt_notelp" name="txt_notelp" type="text" placeholder=""
                                   value="<?php echo set_value('txt_notelp')?>" required>
                        </div>
                        <div class="form-group">
                            <label for="register-username"><i class="icon-user"></i> <b>No. Rekening</b></label>
                            <input class="form-control" onkeypress="return hanyaAngka(event)" id="txt_norek" name="txt_norek" type="text" placeholder=""
                                   value="<?php echo set_value('txt_norek')?>" required>
                        </div>
                        <div class="form-group">
                            <label for="register-username"><i class="icon-user"></i> <b>Alamat</b></label>
                            <textarea id="txt_alamat" class="form-control" name="txt_alamat" rows="7" value="<?php echo set_value('txt_alamat')?>" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="register-password"><i class="icon-lock"></i> <b>Password</b></label>
                            <input class="form-control" id="txt_password" name="txt_password" required type="password" placeholder="" value="<?php echo set_value('txt_password')?>">
                        </div>
                        <div class="form-group">
                            <label for="register-password2"><i class="icon-lock"></i> <b>Re-enter Password</b></label>
                            <input class="form-control" id="txt_konfir_psw" name="txt_konfir_psw" required type="password" placeholder="" value="<?php echo set_value('txt_konfir_psw')?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" id="register_peternak" name="register_peternak" class="btn pull-right">Daftar</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <?php echo  form_close(); ?>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-1 social-login">

            </div>
        </div>
    </div>
</div>