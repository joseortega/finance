<div id="page_head" class="info">
  <div class="title_actions_bar clear_fix">
    <h1>
        <a href="<?php echo url_for('associate_show',$credit->getAssociate())?>"><?php echo $credit->getAssociate()->getName()?></a> 
        / 
        <strong><a href="<?php echo url_for('credit/show?id='.$credit->getId())?>"><?php echo $credit->getId()?></a></strong>
        <em>(<?php echo __($credit->getStatusText())?>)</em>
    </h1>
    <ul class="actions">
      <?php if(!$credit->isAnnulled() && !$credit->isPaid()):?>
        <?php if($credit->isInRequest()):?>
           <li><a  class="minibutton" href="<?php echo url_for('credit_edit', $credit)?>"><span><?php echo __('Admin')?></span></a> </li>
        <?php else:?>
           <li><a  class="minibutton" href="<?php echo url_for('credit_account_edit', $credit)?>"><span><?php echo __('Admin')?></span></a> </li>
        <?php endif;?>
      <?php endif;?>
      <li><a  class="minibutton" href="<?php echo url_for('@credit')?>"><span><?php echo __('Back to list')?></span></a> </li>
    </ul>
  </div>
  <?php include_partial('credit/info_bar', array('credit'=>$credit))?>
</div>