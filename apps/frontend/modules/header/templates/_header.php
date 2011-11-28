<div id="header">
  <div class="site">
    <?php include_partial('logo')?>
    <?php if ($sf_user->isAuthenticated()): ?>
      <?php include_partial('userbox')?>
      <?php include_partial('nav')?>
    <?php else:?>
      <?php include_partial('userbox_logged_out')?>
    <?php endif;?>
  </div>
</div>