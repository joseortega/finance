<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='account' ||
                    $sf_context->getModuleName()=='account_expired_capitalization') echo 'class="selected"';?> href="<?php echo url_for('@account') ?>"><?php echo __('Accounts') ?></a></li> 
    <li><a <?php if($sf_context->getModuleName()=='account_transaction') echo 'class="selected"';?> href="<?php echo url_for('@account_transaction') ?>"><?php echo __('Transactions') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_transfer') echo 'class="selected"';?> href="<?php echo url_for('@account_transfer') ?>"><?php echo __('Transferencias') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_bankbook') echo 'class="selected"';?> href="<?php echo url_for('@account_bankbook') ?>"><?php echo __('Bankbooks') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_product') echo 'class="selected"';?> href="<?php echo url_for('@account_product')?>"><?php echo __('Products') ?></a></li>
  </ul>
</div>