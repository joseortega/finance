<div id="page_head" class="info">
  <div class="title_actions_bar clear_fix">
    <h1>
      <a href="<?php echo url_for('associate_show',$credit->getAssociate())?>"><?php echo $credit->getAssociate()->getName()?></a> 
      / 
      <strong><a href="<?php echo url_for('credit/show?id='.$credit->getId())?>"><?php echo $credit->getId() ?></a></strong>
      <em>(<?php echo __($credit->getStatusText())?>)</em>
    </h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('credit/show?id='.$credit->getId())?>"><span><?php echo __('Back')?></span></a> </li>
    </ul>
  </div>
  <p class="breadcrumb"> 
    <a href="<?php echo url_for('credit/show?id='.$credit->getId())?>"><?php echo $credit?></a>
    <span class="separator"></span>
    <?php echo __('Edit')?>
  </p>
</div>