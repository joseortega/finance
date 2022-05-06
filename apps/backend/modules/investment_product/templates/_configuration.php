<ul class="sidetabs">
  <li><a <?php if($sf_context->getModuleName()=='investment_product') echo 'class="selected"';?> href="<?php echo url_for('investment_product_edit', $product) ?>"><?php echo __('Basic Information')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='investment_product_interest_rate' ) echo 'class="selected"';?> href="<?php echo url_for('investment_product_interest_rate_edit', $product) ?>"><?php echo __('Interest Rates')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='investment_product_manage') echo 'class="selected"';?> href="<?php echo url_for('investment_product_manage', $product) ?>"><?php echo __('Product Manage')?></a></li>
</ul>

