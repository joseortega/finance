<ul class="sidetabs">
  <li><a <?php if($operationType==TransactionType::ACCOUNT_TRANSFER_FROM_INVESTMENT) echo 'class="selected"';?> href="<?php echo url_for('account_transaction_type_configuration/index?operation_type='.TransactionType::ACCOUNT_TRANSFER_FROM_INVESTMENT) ?>"><?php echo __('Expiry of Investment')?></a></li>
  <li><a <?php if($operationType==TransactionType::ACCOUNT_TRANSFER_TO_INVESTMENT) echo 'class="selected"';?> href="<?php echo url_for('account_transaction_type_configuration/index?operation_type='.TransactionType::ACCOUNT_TRANSFER_TO_INVESTMENT) ?>"><?php echo __('Transfer to Investment')?></a></li>
  <li><a <?php if($operationType==TransactionType::ACCOUNT_DISBURSEMENT_CREDIT) echo 'class="selected"';?> href="<?php echo url_for('account_transaction_type_configuration/index?operation_type='.TransactionType::ACCOUNT_DISBURSEMENT_CREDIT) ?>"><?php echo __('Credit Disbursement')?></a></li>
  <li><a <?php if($operationType==TransactionType::ACCOUNT_PAYMENT_CREDIT) echo 'class="selected"';?> href="<?php echo url_for('account_transaction_type_configuration/index?operation_type='.TransactionType::ACCOUNT_PAYMENT_CREDIT) ?>"><?php echo __('Credit Payment')?></a></li>
  <li><a <?php if($operationType==TransactionType::ACCOUNT_INTEREST_CAPITALIZATION) echo 'class="selected"';?> href="<?php echo url_for('account_transaction_type_configuration/index?operation_type='.TransactionType::ACCOUNT_INTEREST_CAPITALIZATION) ?>"><?php echo __('Interest Capitalization')?></a></li>
</ul>

