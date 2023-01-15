<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='accounting_exercise') echo 'class="selected"';?> href="<?php echo url_for('@accounting_exercise') ?>"><?php echo __('Accounting Exercise') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='accounting_account') echo 'class="selected"';?> href="<?php echo url_for('@accounting_account') ?>"><?php echo __('Account account') ?></a></li>
  </ul>
</div>