<ul class="sidetabs">
  <li><a <?php if($operationType==TransactionType::INVESTMENT_TRANSFER_FROM_ACCOUNT) echo 'class="selected"';?> href="<?php echo url_for('investment_transaction_type_configuration/index?operation_type='.TransactionType::INVESTMENT_TRANSFER_FROM_ACCOUNT) ?>"><?php echo __('Debit from Account')?></a></li>
  <li><a <?php if($operationType==TransactionType::INVESTMENT_TRANSFER_TO_ACCOUNT) echo 'class="selected"';?> href="<?php echo url_for('investment_transaction_type_configuration/index?operation_type='.TransactionType::INVESTMENT_TRANSFER_TO_ACCOUNT) ?>"><?php echo __('Transfer to Account')?></a></li>
  <li><a <?php if($operationType==TransactionType::INVESTMENT_INTEREST_CAPITALIZATION) echo 'class="selected"';?> href="<?php echo url_for('investment_transaction_type_configuration/index?operation_type='.TransactionType::INVESTMENT_INTEREST_CAPITALIZATION) ?>"><?php echo __('Interest Capitalization')?></a></li>
  <li><a <?php if($operationType==TransactionType::INVESTMENT_WITHHOLDING_TAX) echo 'class="selected"';?> href="<?php echo url_for('investment_transaction_type_configuration/index?operation_type='.TransactionType::INVESTMENT_WITHHOLDING_TAX) ?>"><?php echo __('Withholding Tax')?></a></li>
</ul>

