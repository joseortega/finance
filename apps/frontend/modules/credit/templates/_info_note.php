<?php if($credit->isInRequest()):?>
  <div class="note">
    <h2><?php echo __('Note')?></h2>
    <p><?php echo __('Once annulled or approved the credit, there is no going back. Please be certain.')?></p>
  </div>
<?php elseif($credit->isApproved()):?>
  <div class="note">
    <h2><?php echo __('Note')?></h2>
    <p><?php echo __('The credit is ready to disburse, run the action to complete the process.')?></p>
  </div>
<?php elseif($credit->isAnnulled()):?>
  <div class="note">
    <h2><?php echo __('Note')?></h2>
    <p><?php echo __('Once you delete an credit, there is no going back. Please be certain.')?></p>
  </div>
<?php endif; ?>
