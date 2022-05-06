<div id="detail">
  <h4 class="section_header"><?php echo __('Credit Detail')?></h4>  
  <table class="info">
    <tbody>
      <tr>
        <th><?php echo __('Number')?></th>
        <td><?php echo $credit->getId() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Credit product')?></th>
        <td><?php echo $credit->getProduct() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Credit amount')?></th>
        <td><?php echo $credit->getAmount() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Balance in credit')?></th>
        <td><?php echo $credit->getBalance() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Time in months')?></th>
        <td><?php echo $credit->getTimeInMonths() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Pay frequency in months')?></th>
        <td><?php echo $credit->getPayFrequencyInMonths() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Purpose')?></th>
        <td><?php echo $credit->getPurpose() ?></td>
      </tr>
      <tr>
        <th><?php echo __('Amortization type')?></th>
        <td><?php echo __(ucfirst($credit->getAmortizationType())) ?></td>
      </tr>
      <tr>
        <th><?php echo __('Interest rate')?></th>
        <?php if($credit->isInRequest()):?>
          <td><?php echo $credit->getProduct()->getInterestRateCurrent() ? $credit->getProduct()->getInterestRateCurrent()->getValue() : __('Not defined') ?></td>
        <?php else:?>
          <td><?php echo $credit->getProduct()->getInterestRateCurrent() ?></td>
        <?php endif;?>
      </tr>
      <tr>
        <th><?php echo __('Created at')?></th>
        <td><?php echo $credit->getCreatedAt() ?></td>
      </tr>
      <?php if($credit->getIssuedAt() != null):?>
      <tr>
        <th><?php echo __('Issued at')?></th>
        <td><?php echo $credit->getIssuedAt() ?></td>
      </tr>
      <?php endif;?>
      <?php if($credit->getDisbursedAt() != null):?>
      <tr>
        <th><?php echo __('Disbursed at')?></th>
        <td><?php echo $credit->getDisbursedAt() ?></td>
      </tr>
      <?php endif;?>
    </tbody>
  </table>
  
  <div class="rule"></div>
  
  <h4 class="section_header"><?php echo __('Linked Account')?></h4>
  <?php include_partial('credit_account/detail', array('credit'=>$credit))?>
  
  <div class="rule"></div>
  
  <h4 class="section_header"><?php echo __('Personal Guarantees')?></h4>
  <?php include_partial('credit_guarantee_personal/detail', array('credit'=>$credit))?>
  
  <div class="rule"></div>
  
  <h4 class="section_header"><?php echo __('Real Guarantees')?></h4>
  <?php include_partial('credit_guarantee_real/detail', array('credit'=>$credit))?>
</div>