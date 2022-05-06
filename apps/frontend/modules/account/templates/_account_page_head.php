<div id="page_head" class="info">
  <div class="title_actions_bar clear_fix">
    <h1>
      <a href="<?php echo url_for('associate_show',$account->getAssociate())?>"><?php echo $account->getAssociate()->getName()?></a>
      / 
      <strong><a href=""><?php echo $account->getNumber()?></a></strong>
    </h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('account_balance_blocked', $account)?>"><span><?php echo __('admin')?></span></a> </li>
      <li><a  class="minibutton" href="<?php echo url_for('@account')?>"><span><?php echo __('List')?></span></a> </li>
    </ul>  
  </div>
  <?php include_partial('account/account_nav', array('account'=> $account))?>
</div>