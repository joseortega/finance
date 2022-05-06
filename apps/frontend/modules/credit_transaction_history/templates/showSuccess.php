<?php use_helper('I18N', 'Date') ?>

<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class=" columns clear_fix">
  <div class="title_actions_bar">
    <h3><?php echo __('Detail transaction')?></h3>
    <ul class="actions">
      <li><a href="<?php echo url_for('credit_transaction/printDetail?id='.$transaction->getId())?>"><span><?php echo __('Document print')?></span></a></li>
      <li><a href="<?php echo url_for('credit_transaction_history', $credit)?>"><span><?php echo __('Back to list')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  <?php include_partial('util/flashes')?>
  <?php include_partial('detail', array('transaction' => $transaction, 'credit'=> $credit)) ?>
</div>