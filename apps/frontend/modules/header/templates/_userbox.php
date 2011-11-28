<div class="userbox">
  <div class="avatarname">
    <?php echo __('Welcome') ?> <?php echo $sf_user->getUsername()?>
  </div>
  <ul class="usernav clear_fix">
    <li><a href="<?php echo url_for('@user')?>"><?php echo __('Settings')?></a></li>
    <li><a href="<?php echo url_for('help/index')?>"><?php echo __('Help')?></a></li>
    <li><?php echo link_to(__('Log Out'), 'sf_guard_signout') ?></li>
  </ul>
</div>