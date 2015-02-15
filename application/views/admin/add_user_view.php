</br></br></br>
<?php echo validation_errors(); ?>
<?php echo form_open('user_controller/add_user'); ?>
<div id="user-register-form">
    <div class="form-item form-item-username">
        <label for="username" style="display:inline-block; min-width: 150px;">User name:</label>
        <input type="text" id="username" name="username"/>
    </div>
    <div class="form-item form-item-email">
        <label for="email" style="display:inline-block;min-width: 150px;">Email:</label>
        <input type="email" id="email" name="email"/>
    </div>
    <div class="form-item form-item-password">
        <label for="password" style="display:inline-block;min-width: 150px;">Password:</label>
        <input type="password" id="password" name="password"/>
    </div>
    <div class="form-item form-item-password-confirm">
        <label for="password-confirm" style="display:inline-block;min-width: 150px;">Confirm password:</label>
        <input type="password" id="password-confirm" name="password_confirm"/>
    </div>
    <div class="form-actions">
        <input type="submit" name="submit" value="Add"/>
    </div>
</div>