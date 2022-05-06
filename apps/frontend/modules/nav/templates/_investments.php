<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='investment' ||
                    $sf_context->getModuleName()=='investment_expired') echo 'class="selected"';?> href="<?php echo url_for('@investment') ?>"><?php echo __('Investments') ?></a></li> 
    <li><a <?php if($sf_context->getModuleName()=='investment_transaction') echo 'class="selected"';?> href="<?php echo url_for('@investment_transaction') ?>"><?php echo __('Movements') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='investment_product') echo 'class="selected"';?> href="<?php echo url_for('@investment_product')?>"><?php echo __('Products') ?></a></li>
  </ul>
</div>