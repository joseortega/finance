<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='account') echo 'class="selected"';?> href="<?php echo url_for('account_show', $account) ?>"><?php echo __('Information') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_transaction_history') echo 'class="selected"';?> href="<?php echo url_for('account_transaction_history', $account)?>"><?php echo __('Transaction History') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_bankbook_history') echo 'class="selected"';?> href="<?php echo url_for('account_bankbook_history', $account)?>"><?php echo __('Bankbook History') ?></a></li>
  </ul>
</div>