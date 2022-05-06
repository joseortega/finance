<td class="text list_td_concept">
  <?php echo link_to($transactionType->getConcept(), 'transaction_type_edit', $transactionType) ?>
</td>
<td class="text list_td_nature">
  <?php echo __($transactionType->getNature()) ?>
</td>
<td class="boolean list_td_cash_balance_is_affect">
  <?php echo get_partial('account_transaction_type/list_field_boolean', array('value' => $transactionType->getCashBalanceIsAffect())) ?>
</td>
<td class="text list_td_initials">
  <?php echo $transactionType->getInitials() ?>
</td>
