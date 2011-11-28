<?php use_helper('I18N', 'Date') ?>

<div id="page_head" class="info account_settings">
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('Settings')?></h1>
  </div>
  <p class="breadcrumb"> 
    <?php echo __('Change your Password')?>
  </p>
</div>

<div class="columns newcols clear_fix">
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <p><?php echo __("Make sure it's something easy to remember, but difficult for others to guess. Try to include both letters and numbers or punctuation.")?></p>
    </div>
  </div>
</div>