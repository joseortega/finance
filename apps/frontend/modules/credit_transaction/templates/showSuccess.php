<?php include_partial('page_head')?>

<div class="title_actions_bar">
  <h3><?php echo __('Detail Transaction')?></h3>
  <ul class="actions"> 
    <li><a class="minibutton" href="<?php echo url_for('credit_transaction/printDetail?id='.$transaction->getId())?>"><span><?php echo __('Document print')?></span></a></li>
    <li><a  class="minibutton" href="<?php echo url_for('@credit_transaction')?>"><span><?php echo __('Back to list')?></span></a> </li>
  </ul> 
</div>
  
<div class="rule"></div>

<div class="columns infocols clear_fix">
  <?php include_partial('util/flashes')?>
  <div class="main">
    <?php include_partial('detail', array('transaction' => $transaction)) ?>
  </div>
  <div class="sidebar"> 
  </div>
</div>