<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='account_product') echo 'class="selected"';?> href="<?php echo url_for('@account_product') ?>"><?php echo __('Products') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_transaction_type' || 
                    $sf_context->getModuleName()=='account_transaction_type_configuration') echo 'class="selected"';?> href="<?php echo url_for('@account_transaction_type') ?>"><?php echo __('Transaction Types') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='reason_block') echo 'class="selected"';?> href="<?php echo url_for('@reason_block') ?>"><?php echo __('Reasons Block') ?></a></li>
  </ul>
</div>