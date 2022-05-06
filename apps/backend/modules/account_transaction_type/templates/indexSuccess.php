<?php use_helper('I18N', 'Date') ?>
<?php include_partial('account_transaction_type/assets') ?>

<div id="page_head">
  
  <h1><?php echo __('Account Transaction Types')?></h1>
 
  <?php include_partial('account_transaction_type/nav') ?>
  
</div>

<?php include_partial('account_transaction_type/head_bar_nav')?>

<div class="columns listcols clear_fix">
  
  <?php include_partial('account_transaction_type/flashes') ?>

  <div class="main">
    <?php include_partial('account_transaction_type/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="actions">
      <?php include_partial('account_transaction_type/list_batch_actions', array('helper' => $helper)) ?>
    </ul>
  </div>
  
    <div class="sidebar">
    <?php include_partial('account_transaction_type/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

</div>
