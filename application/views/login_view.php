<!DOCTYPE html>
<html>
<head>
    <title>User Management System | Login Page</title>
</head>
<body>
<?php echo validation_errors(); ?>
<?php echo form_open('login_controller/check_login'); ?>
 <div id="user-login-form">
   <div class="form-item form-item-username">
    <label for="username">User name:</label>
    <input type="text" id="username" name="username"/>
   </div>
   <div class="form-item form-item-password">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"/>
   </div>
    <div class="form-actions">
        <input type="submit" name="submit" value="Login"/>
    </div>
 </div>
</body>
</html>