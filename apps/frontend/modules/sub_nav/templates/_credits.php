<?php $filters = $sf_user->getAttribute('credit.filters'); ?>
    
<div class="subnav-bar">
  <ul class="clear_fix">
    <li><a <?php if($filters['status'] == Credit::STATUS_CURRENT) echo 'class="selected"';?> href="<?php echo url_for('credit/statusFilter?status='.Credit::STATUS_CURRENT) ?>"><?php echo __('Currents') ?> (<?php echo CreditPeer::doCountCurrent()?>)</a></li>
    <li><a <?php if($filters['status'] == Credit::STATUS_APPROVED) echo 'class="selected"';?> href="<?php echo url_for('credit/statusFilter?status='.Credit::STATUS_APPROVED) ?>"><?php echo __('Approved') ?> (<?php echo CreditPeer::doCountApproved()?>)</a></li>
    <li><a <?php if($filters['status'] == Credit::STATUS_IN_REQUEST) echo 'class="selected"';?> href="<?php echo url_for('credit/statusFilter?status='.Credit::STATUS_IN_REQUEST) ?>"><?php echo __('In request') ?> (<?php echo CreditPeer::doCountInRequest()?>)</a></li>
    <li><a <?php if($filters['status'] == Credit::STATUS_PAID) echo 'class="selected"';?> href="<?php echo url_for('credit/statusFilter?status='.Credit::STATUS_PAID) ?>"><?php echo __('Paid') ?> (<?php echo CreditPeer::doCountPaid()?>)</a></li>
    <li><a <?php if($filters['status'] == Credit::STATUS_ANNULLED) echo 'class="selected"';?> href="<?php echo url_for('credit/statusFilter?status='.Credit::STATUS_ANNULLED) ?>"><?php echo __('Annulled') ?> (<?php echo CreditPeer::doCountAnnulled()?>)</a></li>
  </ul>
</div>