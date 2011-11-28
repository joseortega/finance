<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='account') echo 'class="selected"';?> href="<?php echo url_for('@account') ?>"><?php echo __('Balances') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='none') echo 'class="selected"';?> href="<?php echo url_for('@account_bankbook') ?>"><?php echo __('Manage balance') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='none') echo 'class="selected"';?> href="<?php echo url_for('@account_bankbook') ?>"><?php echo __('Transactions History') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='none') echo 'class="selected"';?> href="<?php echo url_for('@account_bankbook') ?>"><?php echo __('Bankbooks') ?></a></li>
  </ul>
</div>