<?php include_partial('account/admin_page_head', array('account'=>$account)) ?>

<div class="htabs account clear_fix">
  <div class="sidebar">
    <?php include_partial('account/configuration', array('account'=>$account)) ?>
  </div>
  <div class="main">
    <div class="form">
      <?php include_partial('util/flashes')?>
      <?php include_partial('form', array('form'=>$form, 'account'=> $account))?>
    </div>
  </div>
</div>
