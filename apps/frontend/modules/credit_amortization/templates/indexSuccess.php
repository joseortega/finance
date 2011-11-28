<?php use_helper('I18N', 'Date') ?>

<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class="columns listcols clear_fix">
  <?php include_partial('util/flashes')?>
    <div class="title_actions_bar">
      <h3><?php echo __('Amortization table')?></h3>
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
    </div>
    
    <div class="rule"></div>
      <?php include_partial('list', array('pager' => $pager, 'credit'=>$credit)) ?>
</div>
