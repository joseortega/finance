<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='investment') echo 'class="selected"';?> href="<?php echo url_for('investment_show', $investment) ?>"><?php echo __('Information') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='investment_transaction_history') echo 'class="selected"';?> href="<?php echo url_for('investment_transaction_history', $investment)?>"><?php echo __('History Movement') ?></a></li>
  </ul>
</div>