<?php include_partial('page_head')?>

<div class="columns clear_fix">
  
  <div class="title_actions_bar clear_fix">
      <h3><?php echo __('Detail Bankbook')?> # <?php echo $bankbook->getId()?></h3>
    <ul class="actions"> 
      <li><a class="minibutton" href="<?php echo url_for('account_bankbook/printHeader?id='.$bankbook->getId())?>"><span><?php echo __('Print header')?></span></a></li>
      <li><a class="minibutton" href="<?php echo url_for('account_bankbook/printContent?id='.$bankbook->getId())?>"><span><?php echo __('Print content')?></span></a></li>
      <li><a class="minibutton" href="<?php echo url_for('account_bankbook/printAll?id='.$bankbook->getId())?>"><span><?php echo __('Print all')?></span></a></li>
      <li><a class="minibutton" href="<?php echo url_for('@account_bankbook')?>"><span><?php echo __('Back to list')?></span></a> </li>
    </ul>  
  </div>
  
  <div class="rule"></div>
  
  <?php include_partial('util/flashes')?>
  
  <div class="main">
      <?php include_partial('detail', array('bankbook' => $bankbook)) ?>
  </div>
  <div>
</div>