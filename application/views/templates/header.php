<!DOCTYPE>
<html>
<head>
<title>User management System | Administration</title>
    <style>
        .nav li {
            list-style: none;
            float: left;
            margin-left: 20px;
        }
        #secondary-menu ul li {
            float: right;
        }
    </style>
</head>
<body>
<div id="secondary-menu">
    <ul id="secondary-menu-links" class="nav">
        <li><a href="<?php echo base_url(); ?>index.php/user_controller/get_user_account/<?php echo $user_id;?>"><?php echo $user_name;?></a></li>
        <li><a href="<?php echo base_url(); ?>index.php/login_controller/logout">Logout</a></li>
    </ul>
</div>
<div id="main-menu">
    <ul id="main-menu-links" class="nav">
        <li><a href="<?php echo base_url(); ?>index.php/user_controller/list_users">Users</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/role_controller/list_roles">Roles</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/user_controller">Add new user</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/role_controller">Add new role</a></li>
    </ul>
</div>
</body>
</html>