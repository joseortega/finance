<ul class="sidetabs">
    <li><a <?php if($sf_context->getModuleName()=='account_product') echo 'class="selected"';?> href="<?php echo url_for('account_product_edit', $product) ?>"><?php echo __('Basic Information')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_product_interest_rate') echo 'class="selected"';?> href="<?php echo url_for('account_product_interest_rate', $product) ?>"><?php echo __('Interest Rates')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_product_transaction_type') echo 'class="selected"';?> href="<?php echo url_for('account_product_transaction_type_edit', $product) ?>"><?php echo __('Transaction Types')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='account_product_manage') echo 'class="selected"';?> href="<?php echo url_for('account_product_manage', $product) ?>"><?php echo __('Product Manage')?></a></li>
</ul>

