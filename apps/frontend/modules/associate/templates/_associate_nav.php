<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='associate') echo 'class="selected"';?> href="<?php echo url_for('associate_show', $associate) ?>"><?php echo __('Information') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_account') echo 'class="selected"';?> href="<?php echo url_for('associate_account', $associate) ?>"><?php echo __('Accounts') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_credit') echo 'class="selected"';?> href="<?php echo url_for('associate_credit', $associate) ?>"><?php echo __('Credits') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_investment') echo 'class="selected"';?> href="<?php echo url_for('associate_investment', $associate) ?>"><?php echo __('Investments') ?></a></li>
  </ul>
</div>
