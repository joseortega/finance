<ul class="sidetabs">
  <li><a <?php if($sf_context->getModuleName()=='account_balance_blocked') echo 'class="selected"';?> href="<?php echo url_for('account_balance_blocked', $account)?>"><?php echo __('Blocked Values')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='account_manage') echo 'class="selected"';?> href="<?php echo url_for('account_manage', $account) ?>"><?php echo __('Manage Account')?></a></li>
</ul>
