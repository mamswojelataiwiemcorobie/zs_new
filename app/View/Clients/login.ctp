<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Client'); ?>
    <fieldset>
        <legend>
            <?php echo __('Proszę wprowadzić login i hasło'); ?>
        </legend>
        <?php echo $this->Form->input('login');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
<p> lub </p>
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
</div>