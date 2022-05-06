<?php include_partial('account/admin_page_head', array('account'=>$account)) ?>

<div class="htabs account clear_fix">
  <div class="sidebar">
    <?php include_partial('account/configuration', array('account'=>$account)) ?>
  </div>
  <div class="main">
    <div class="ejector">
      <h2><?php echo __('Delete this account')?></h2>
      <div class="ejector-content">
        <p><?php echo __('Once you delete an account, there is no going back. Please be certain.')?></p>
        <?php echo link_to('<span>'.__('Delete this account').'</span>', 'account/delete?id='.$account->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?>
      </div>
    </div>
  </div>
</div>
