<div id="page_head" class="info">
  <div class="title_actions_bar clear_fix">
    <h1>
      <a href="<?php echo url_for('associate_show',$account->getAssociate())?>"><?php echo $account->getAssociate()->getName()?></a>
      / 
      <strong><a href=""><?php echo $account->getNumber()?></a></strong>
    </h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('account_show', $account)?>"><span><?php echo __('Back')?></span></a> </li>
    </ul>  
  </div>
  <p class="breadcrumb"> 
    <a href="<?php echo url_for('account_show', $account)?>"><?php echo $account?></a>
    <span class="separator"></span>
    <?php echo __('Manage')?>
  </p>
</div>

<ul class="stats_account clear_fix">
  <li class="available">
    <strong><?php echo $account->getAvailableBalance()?></strong>
    <span><?php echo __('Available balance')?></span>
  </li>
  <li class="blocked">
    <strong><?php echo $account->getBlockedBalance()?></strong>
    <span><?php echo __('Frozen balance')?></span>
  </li>
  <li class="total">
    <strong><?php echo $account->getBalance()?></strong>
    <span><?php echo __('Total balance')?></span>
  </li>
</ul>