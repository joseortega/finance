<ul class="sidetabs">
  <?php if($credit->isInRequest()):?>
    <li><a <?php if($sf_context->getModuleName()=='credit') echo 'class="selected"';?> href="<?php echo url_for('credit_edit', $credit) ?>"><?php echo __('Basic Data')?></a></li>
  <?php endif;?>
  <li><a <?php if($sf_context->getModuleName()=='credit_account') echo 'class="selected"';?> href="<?php echo url_for('credit_account_edit',$credit) ?>"><?php echo __('Linked Account')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='credit_guarantee_personal') echo 'class="selected"';?> href="<?php echo url_for('credit_guarantee_personal', $credit) ?>"><?php echo __('Personal Guarantees')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='credit_guarantee_real') echo 'class="selected"';?> href="<?php echo url_for('credit_guarantee_real_edit', $credit) ?>"><?php echo __('Real Guarantees')?></a></li>
</ul>