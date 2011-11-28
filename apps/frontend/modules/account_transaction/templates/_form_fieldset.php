<fieldset>
  <?php echo $form->renderHiddenFields(false) ?>
  <?php echo $form['account_transaction']['account_id']->renderRow() ?>
  <?php echo $form['transaction_type_id']->renderRow() ?>
  <?php echo $form['amount']->renderRow() ?>
  <?php echo $form['observation']->renderRow() ?>
</fieldset>

