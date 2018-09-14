<!DOCTYPE html>
<html>
<head>
    <title>tes</title>
</head>
<body>
<h1>tes</h1>
<form action="<?php echo base_url('Login/signInPeternak'); ?>" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="txt_id"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="txt_pass"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Login"></td>
        </tr>
    </table>
</form>
</body>
</html>