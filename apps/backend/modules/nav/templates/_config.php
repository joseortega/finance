<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='agency') echo 'class="selected"';?> href="<?php echo url_for('@agency') ?>"><?php echo __('Agencies') ?></a></li> 
    <li><a <?php if($sf_context->getModuleName()=='cash') echo 'class="selected"';?> href="<?php echo url_for('@cash') ?>"><?php echo __('Cash') ?></a></li> 
    <li><a <?php if($sf_context->getModuleName()=='general_transaction_type') echo 'class="selected"';?> href="<?php echo url_for('general_transaction_type') ?>"><?php echo __('General Transaction Types') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='configuration') echo 'class="selected"';?> href="<?php echo url_for('configuration/index/?name='.Configuration::TITLE_REPORT) ?>"><?php echo __('Configuration') ?></a></li>
  </ul>
</div>