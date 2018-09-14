
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">

            </div>
            <div class="col-sm-5">
                <div class="basic-login">
                    <?php echo form_open_multipart('Login/signInAdmin')?>
                    <form role="form" role="form">
                        <h3>Login Admin</h3>
                        <div class="form-group">
                            <label for="login-username"><i class="icon-user"></i> <b>Username</b></label>
                            <input class="form-control" id="txt_id" name="txt_id" type="text" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="login-password"><i class="icon-lock"></i> <b>Password</b></label>
                            <input class="form-control" id="txt_pass" name="txt_pass" type="password" placeholder="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right">Login</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-sm-5"></div>
            </div>
        </div>
    </div>
</div>