<?php use_stylesheet('/css/main_nav.css')?>

<ul class="main_nav">
  <li <?php if($sf_context->getModuleName()=='credit_amortization' && $sf_context->getActionName()=='index') echo 'class="selected"';?>><a href="<?php echo url_for('credit_amortization/index?id='.$credit->getId()) ?>"><?php echo __('Origen Table') ?></a></li>
  <li <?php if($sf_context->getModuleName()=='credit_amortization' && $sf_context->getActionName()=='fullTable') echo 'class="selected"';?>><a href="<?php echo url_for('credit_amortization/fullTable?id='.$credit->getId()) ?>"><?php echo __('Current Table') ?></a></li>
</ul>