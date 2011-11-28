  
<div class="subnav-bar">
  <ul class="clear_fix">
    <li><a <?php if($sf_context->getModuleName()=='investment') echo 'class="selected"';?> href="<?php echo url_for('@investment') ?>"><?php echo __('All') ?> (<?php echo InvestmentPeer::doCount(new Criteria())?>)</a></li>
    <li><a <?php if($sf_context->getModuleName()=='investment_expired') echo 'class="selected"';?> href="<?php echo url_for('@investment_expired') ?>"><?php echo __('Expired') ?> (<?php echo InvestmentPeer::doCountCurrentExpired()?>)</a></li>
  </ul>
</div>