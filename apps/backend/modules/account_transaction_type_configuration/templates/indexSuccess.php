<div id="page_head">

  <h1><?php echo __('Account Transaction Types')?></h1>

  <?php include_partial('nav/account_products') ?>
  
</div>

<?php include_partial('account_transaction_type/head_bar_nav')?>

<div class="htabs account_transaction_type clear_fix">
  
  <div class="sidebar">
    <?php include_partial('configuration', array('operationType' => $operationType))?>
  </div>

  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form, 'operationType'=> $operationType)) ?>
  </div>

</div>


