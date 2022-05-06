<?php use_stylesheet('/css/login.css') ?>

<div id="login">
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <h1><?php echo __('Sign in')?></h1>
    <div class="form_body">
      <?php echo $form ?>
      <ul class="actions">
        <li><input type="submit" value="Sign in" /></li>
<!--        <li class="forgot_password"><a href="<?php echo url_for('@sf_guard_password')?>"><?php echo __('Forgot password')?></a></li>-->
      </ul>

    </div>
  </form>
</div>

