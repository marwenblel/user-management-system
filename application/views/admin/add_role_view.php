</br></br></br>
<?php echo validation_errors(); ?>
<?php echo form_open('role_controller/add_role'); ?>
<div id="role-register-form">
    <div class="form-item form-item-rolename">
        <label for="rolename" style="display:inline-block; min-width: 150px;">Role name:</label>
        <input type="text" id="rolename" name="rolename"/>
    </div>
    <div class="form-actions">
        <input type="submit" name="submit" value="Add"/>
    </div>
</div>