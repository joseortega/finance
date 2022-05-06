<?php include_partial('cash_page_head', array('cash'=>$cash))?>

<div class="title_actions_bar">
  <h3>
    <?php echo __('Detail Transaction')?>
  </h3>
  <ul class="actions">
    <li><a class="minibutton" href="<?php echo url_for('general_transaction/printDetail?id='.$transaction->getId())?>"><span><?php echo __('Print')?></span></a></li>
    <li><a class="minibutton" href="<?php echo url_for('@general_transaction')?>"><span><?php echo __('Back to list')?></span></a></li>
  </ul>
</div>

<div class="rule"></div>

<div class="columns infocols clear_fix">
  <?php include_partial('util/flashes', array('transaction'=>$transaction))?>
  <div class="main">
    <?php include_partial('detail', array('transaction' => $transaction)) ?>
  </div>
  <div class="sidebar"> 
  </div>
</div>