<?php use_helper('I18N', 'Date') ?>
<?php include_partial('account_transaction_type/assets') ?>

<div id="page_head">

  <h1><?php echo __('Account Transaction Types')?></h1>
   
  <?php include_partial('account_transaction_type/nav') ?>
  
</div>

<?php include_partial('account_transaction_type/new_head_bar_nav')?>

<div class="columns newcols clear_fix">
  
  <?php include_partial('account_transaction_type/flashes') ?>

  <?php include_partial('account_transaction_type/form', array('transactionType' => $transactionType, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

</div>
