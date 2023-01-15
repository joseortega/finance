<?php include_partial('page_head')?>

<div class="columns infocols clear_fix">
  
  <div class="title_actions_bar">
    <h3><?php echo __('Detail Transfer')?></h3>
    <ul class="actions"> 
      <li><a class="minibutton" href="<?php echo url_for('account_transfer/printDetail?id='.$transfer->getId())?>"><span><?php echo __('Document print')?></span></a></li>
      <li><a  class="minibutton" href="<?php echo url_for('@account_transfer')?>"><span><?php echo __('Back to list')?></span></a> </li>
    </ul> 
  </div>
  
  <div class="rule"></div>
  
  <?php include_partial('util/flashes')?>
  
  <div class="main">
    <?php include_partial('detail', array('transfer' => $transfer)) ?>
  </div>
  <div class="sidebar"> 
  </div>
</div>