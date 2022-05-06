<?php include_partial('account/account_page_head', array('account' => $transaction->getAccount()))?>

<div>
  
  <div class="title_actions_bar clear_fix">
    <h3><?php echo __('Detail transaction')?></h3>
    <ul class="actions"> 
      <li><a href="<?php echo url_for('account_transaction/printDetail?id='.$transaction->getId())?>"><span><?php echo __('Document print')?></span></a></li>
      <li><a href="<?php echo url_for('account_transaction_history', $account)?>"><span><?php echo __('Back to list')?></span></a></li>
    </ul>
  </div>
  
  <div class="rule"></div>
  
  <?php include_partial('detail', array('transaction' => $transaction)) ?>

</div>