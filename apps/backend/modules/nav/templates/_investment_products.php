<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='investment_product') echo 'class="selected"';?> href="<?php echo url_for('@investment_product') ?>"><?php echo __('Products') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='investment_transaction_type_configuration') echo 'class="selected"';?> href="<?php echo url_for('investment_transaction_type_configuration/index?operation_type='.TransactionType::INVESTMENT_TRANSFER_FROM_ACCOUNT) ?>"><?php echo __('Transaction Types') ?></a></li>
  </ul>
</div>