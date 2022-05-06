<td class="text list_td_concept">
  <?php echo link_to($transactionType->getConcept(), 'general_transaction_type_edit', $transactionType) ?>
</td>
<td class="text list_td_nature">
  <?php echo __($transactionType->getNature()) ?>
</td>
<td class="date list_td_created_at">
  <?php echo false !== strtotime($transactionType->getCreatedAt()) ? format_date($transactionType->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
