<ul class="actions">
  <li>
    <span><?php echo __('Total')?></span>
    <strong><?php echo $credit->countPayments()?></strong> 
  </li>
  <li>
    <span><?php echo __('Effected')?></span>
    <strong><?php echo $credit->countPaymentsEffected()?></strong>
  </li>
  <li>
    <span><?php echo __('Pending')?></span>
    <strong><?php echo $credit->CountPaymentsPending()?></strong>
  </li>
  <li>
    <a href="<?php echo url_for('credit_amortization/pdf?id='.$credit->getId())?>">
      <span><?php echo __('Print table')?>
     </span>
    </a>
  </li>
</ul>

