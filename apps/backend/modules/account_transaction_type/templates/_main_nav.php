<?php use_stylesheet('/css/main_nav.css')?>

<ul class="main_nav">
  <li <?php if($sf_context->getModuleName()=='account_transaction_type' && $sf_context->getActionName()=='index') echo 'class="selected"';?>><a href="<?php echo url_for('@account_transaction_type') ?>"><?php echo __('Custom Types') ?></a></li>
  <li <?php if($sf_context->getModuleName()=='account_transaction_type_configuration') echo 'class="selected"';?>><a href="<?php echo url_for('account_transaction_type_configuration/index?operation_type='.TransactionType::ACCOUNT_TRANSFER_ORIGIN_ACCOUNT) ?>"><?php echo __('Specific Types') ?></a></li>
</ul>