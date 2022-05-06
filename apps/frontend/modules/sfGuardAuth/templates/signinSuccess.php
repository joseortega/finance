<?php use_stylesheet('/css/login.css') ?>

<div id="login">
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <h1><?php echo __('Sign in')?></h1>
    <div class="form_body">
      <?php echo $form->renderHiddenFields(false) ?>
      <?php echo $form->renderGlobalErrors() ?>
      <div class="form_row">
        <?php echo $form['username']->renderError() ?>
        <?php echo $form['username']->renderLabel() ?>
        <?php echo $form['username'] ?>
      </div>
      <div class="form_row">
        <?php echo $form['password']->renderError() ?>
        <?php echo $form['password']->renderLabel() ?>
        <?php echo $form['password'] ?>
      </div>
      <div class="form_row remeber clear_fix">
        <?php echo $form['remember']->renderError() ?>
        <?php echo $form['remember'] ?>
        <?php echo $form['remember']->renderLabel() ?>
      </div> 
      <ul class="actions">
        <li><input type="submit" value="<?php echo __('Sign in')?>" /></li>
      </ul>
    </div>
  </form>
</div>

