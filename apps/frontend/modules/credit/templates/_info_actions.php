<?php if($credit->isInRequest()):?>
  <div class="rule"></div>
  <ul class="actions">
    <li><?php echo link_to('<span>'.__('Approve request').'</span>', 'credit/approve?id='.$credit->getId(), array('confirm' => 'Are you sure?', 'class'=>'button classy')) ?></li>
    <li><?php echo link_to('<span>'.__('Annul request').'</span>', 'credit/annul?id='.$credit->getId(), array('confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?></li>
  </ul>
<?php elseif($credit->isApproved()):?>
  <div class="rule"></div>
  <h4 class="section_header"><?php echo __('Account to Disburse')?></h4>
  <?php include_partial('form_pre_disburse', array('credit' => $credit, 'form' => $form))?>
<?php elseif($credit->isAnnulled()):?>
  <div class="rule"></div>
  <ul class="actions">
    <li><?php echo link_to('<span>'.__('Delete this request').'</span>', 'credit/delete?id='.$credit->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?></li>
  </ul>
<?php endif; ?>
