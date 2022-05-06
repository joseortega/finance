<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='credit') echo 'class="selected"';?> href="<?php echo url_for('@credit') ?>"><?php echo __('Credits') ?></a></li> 
    <li><a <?php if($sf_context->getModuleName()=='credit_transaction') echo 'class="selected"';?> href="<?php echo url_for('@credit_transaction') ?>"><?php echo __('Movements') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='credit_expired_payment') echo 'class="selected"';?> href="<?php echo url_for('@credit_expired_payment')?>"><?php echo __('Expired Payments') ?> (<?php echo CreditPeer::doCountExpired()?>)</a></li>
    <li><a <?php if($sf_context->getModuleName()=='credit_product') echo 'class="selected"';?> href="<?php echo url_for('@credit_product')?>"><?php echo __('Products') ?></a></li>
  </ul>
</div>