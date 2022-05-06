<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1>
      <a href="<?php echo url_for('associate_show',$investment->getAssociate())?>"><?php echo $investment->getAssociate()->getName()?></a>
      / 
      <strong><a href=""><?php echo $investment->getId()?></a></strong>
      <em>(<?php echo __($investment->getStatusText())?>)</em>
    </h1> 
    <ul class="actions">
      <li><a class="minibutton" href="<?php echo url_for('investment/pdf?id='.$investment->getId())?>"><span><?php echo __('Document print')?></span></a></li>
      <li><a class="minibutton" href="<?php echo url_for('@investment')?>"><span><?php echo __('All investment')?></span></a></li>   
    </ul>
  </div>
  <?php include_partial('investment/investment_nav', array('investment'=> $investment))?>
</div>