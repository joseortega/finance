<ul class="sidetabs">
  <li><a <?php if($sf_context->getModuleName()=='credit_product') echo 'class="selected"';?> href="<?php echo url_for('credit_product/edit?id='.$product->getId()) ?>"><?php echo __('Basic Information')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='credit_product_interest_rate' ) echo 'class="selected"';?> href="<?php echo url_for('credit_product_interest_rate', $product) ?>"><?php echo __('Interest Rates')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='credit_product_arrear_rate') echo 'class="selected"';?> href="<?php echo url_for('credit_product_arrear_rate', $product) ?>"><?php echo __('Arrear Rates')?></a></li>
  <li><a <?php if($sf_context->getModuleName()=='credit_product_manage') echo 'class="selected"';?> href="<?php echo url_for('credit_product_manage', $product) ?>"><?php echo __('Product Manage')?></a></li>
</ul>

