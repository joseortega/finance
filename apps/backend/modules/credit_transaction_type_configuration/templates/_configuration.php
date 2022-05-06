<ul class="sidetabs">
  <li><a <?php if($operationType==TransactionType::CREDIT_APPROVAL) echo 'class="selected"';?> href="<?php echo url_for('credit_transaction_type_configuration/index?operation_type='.TransactionType::CREDIT_APPROVAL) ?>"><?php echo __('Credit Approval')?></a></li>
  <li><a <?php if($operationType==TransactionType::CREDIT_DISBURSEMENT_ACCOUNT) echo 'class="selected"';?> href="<?php echo url_for('credit_transaction_type_configuration/index?operation_type='.TransactionType::CREDIT_DISBURSEMENT_ACCOUNT) ?>"><?php echo __('Credit Disbursement')?></a></li>
  <li><a <?php if($operationType==TransactionType::CREDIT_PAYMENT_ACCOUNT) echo 'class="selected"';?> href="<?php echo url_for('credit_transaction_type_configuration/index?operation_type='.TransactionType::CREDIT_PAYMENT_ACCOUNT) ?>"><?php echo __('Credit Payment')?></a></li>
</ul>

