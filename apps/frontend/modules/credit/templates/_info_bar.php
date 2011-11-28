<?php if($credit->isCurrent()):?>
  <div class="nav">
    <ul>
      <li><a <?php if($sf_context->getModuleName()=='credit') echo 'class="selected"';?> href="<?php echo url_for('credit_show', $credit) ?>"><?php echo __('Information') ?></a></li> 
      <li><a <?php if($sf_context->getModuleName()=='credit_amortization') echo 'class="selected"';?> href="<?php echo url_for('credit_amortization/index?id='.$credit->getId()) ?>"><?php echo __('Payment Plan') ?></a></li>
      <li><a <?php if($sf_context->getModuleName()=='credit_payment') echo 'class="selected"';?> href="<?php echo url_for('credit_payment', $credit) ?>"><?php echo __('Make Payments') ?></a></li>
      <li><a <?php if($sf_context->getModuleName()=='credit_transaction_history') echo 'class="selected"';?> href="<?php echo url_for('credit_transaction_history/index?id='.$credit->getId()) ?>"><?php echo __('Movements History') ?></a></li>
    </ul>
  </div>
<?php elseif($credit->isPaid()):?>
  <div class="nav">
    <ul>
      <li><a <?php if($sf_context->getModuleName()=='credit') echo 'class="selected"';?> href="<?php echo url_for('credit_show', $credit) ?>"><?php echo __('Information') ?></a></li> 
      <li><a <?php if($sf_context->getModuleName()=='credit_amortization') echo 'class="selected"';?> href="<?php echo url_for('credit_amortization/index?id='.$credit->getId()) ?>"><?php echo __('Payment Plan') ?></a></li>
      <li><a <?php if($sf_context->getModuleName()=='credit_transaction_history') echo 'class="selected"';?> href="<?php echo url_for('credit_transaction_history/index?id='.$credit->getId()) ?>"><?php echo __('Movements History') ?></a></li>
    </ul>
  </div>
<?php elseif($credit->isAnnulled()):?>
  <div class="rule"></div>
<?php else:?>
  <?php include_partial('steps', array('credit' => $credit))?>
<?php endif;?>