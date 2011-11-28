<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='credit_product') echo 'class="selected"';?> href="<?php echo url_for('@credit_product') ?>"><?php echo __('Products') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='credit_transaction_type_configuration') echo 'class="selected"';?> href="<?php echo url_for('credit_transaction_type_configuration/index?operation_type='.TransactionType::CREDIT_APPROVAL) ?>"><?php echo __('Transaction Types')?></a></li>
  </ul>
</div>