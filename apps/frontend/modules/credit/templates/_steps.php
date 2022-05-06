<ol class="steps clear_fix">
  <li <?php if($credit->isNew()) echo 'class="current"';?>><span><?php echo __('Request credit')?></span></li>
  <li <?php if(!$credit->isNew() && $credit->isInRequest()) echo 'class="current"';?>><span><?php echo __('Approve credit')?></span></li>
  <li <?php if($credit->isApproved()) echo 'class="current"';?>><span><?php echo __('disbursement')?></span></li>
</ol>