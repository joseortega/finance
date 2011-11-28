<?php if($credit->isInRequest()):?>
  <ul class="actions">
    <li><?php echo link_to('<span>'.__('Approve request').'</span>', 'credit/approve?id='.$credit->getId(), array('confirm' => 'Are you sure?', 'class'=>'button classy')) ?></li>
    <li><?php echo link_to('<span>'.__('Annul request').'</span>', 'credit/annul?id='.$credit->getId(), array('confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?></li>
  </ul>
<?php elseif($credit->isApproved()):?>
  <ul class="actions">
    <li><a class="button classy" onclick="return confirm('Are you sure?');" href="<?php echo url_for('credit/disburse?id='.$credit->getId())?>"><span><?php echo __('Disburse credit')?></span></a></li>
  </ul>
<?php elseif($credit->isAnnulled()):?>
  <ul class="actions">
    <li><?php echo link_to('<span>'.__('Delete this request').'</span>', 'credit/delete?id='.$credit->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?></li>
  </ul>
<?php endif; ?>
