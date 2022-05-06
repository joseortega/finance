<?php use_helper('I18N', 'Date') ?>

<?php echo include_partial('investment/investment_page_head', array('investment'=>$investment))?>

<div class=" columns clear_fix">
  <div class="title_actions_bar">
    <h3><?php echo __('Detail Transaction')?></h3>
    <ul class="actions">
      <li><a href="<?php echo url_for('investment_transaction/printDetail?id='.$transaction->getId())?>"><span><?php echo __('Document print')?></span></a></li>
      <li><a href="<?php echo url_for('investment_transaction_history', $investment)?>"><span><?php echo __('Back to list')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  <?php include_partial('util/flashes')?>
  <?php include_partial('detail', array('transaction' => $transaction, 'investment'=> $investment)) ?>
</div>