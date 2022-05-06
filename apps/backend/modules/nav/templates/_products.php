<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='account_product') echo 'class="selected"';?> href="<?php echo url_for('@account_product') ?>"><?php echo __('Account') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='investment_product') echo 'class="selected"';?> href="#"><?php echo __('Investment') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='credit_product') echo 'class="selected"';?> href="<?php echo url_for('@credit_product') ?>"><?php echo __('Credit') ?></a></li>
  </ul>
</div>