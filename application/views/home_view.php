<!DOCTYPE html>
<html>
<head>
    <title>User Management System | Home page</title>
</head>
<body>
<label>Authenticated user space</label>
<h1>Welcome <?php echo $user_name; ?> to home page</h1>
<a href="<?php echo base_url(); ?>index.php/login_controller/logout">Logout</a>
</body>
</html>