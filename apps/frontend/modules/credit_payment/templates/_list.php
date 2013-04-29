<table class="payments">
  <thead>
    <tr>
      <th colspan="2"></th>
      <th><?php echo __('Payment date')?></th>
      <th class="data"><?php echo __('Days in arrear')?></th>
      <th class="data"><?php echo __('Capital')?></th>
      <th class="data"><?php echo __('Interest')?></th>
      <th class="data"><?php echo __('Arrear')?></th>
      <th class="data"><?php echo __('Discount')?></th>
      <th class="payment"><?php echo __('Amount payable')?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($amortizations as $payment):?>
      <tr>
        <td class="status <?php echo $payment->getStatusText()?>"></td>
        <td class="number">#<?php echo $payment->getNumber()?></td>
        <td><?php echo $payment->getDate()?></td>
        <td class="data"><?php echo $payment->getDaysInArrear()?></td>
        <td class="data"><?php echo $payment->getCapital()?></td>
        <td class="data"><?php echo $payment->getInterest()?></td>
        <td class="data"><?php echo $payment->getArrear()?></td>
        <td class="data"><?php echo $payment->getDiscount()?></td>
        <td class="payment"><?php echo $payment->getTotal()?></td>
      </tr>
    <?php endforeach;?>
    <tr class="total">
      <td colspan="4"><?php echo __('Total')?></td>
      <td class="data"><?php echo PaymentPeer::sumCapital($amortizations)?></td>
      <td class="data"><?php echo PaymentPeer::sumInterest($amortizations)?></td>
      <td class="data"><?php echo PaymentPeer::sumArrear($amortizations)?></td>
      <td class="data"><?php echo PaymentPeer::sumDiscount($amortizations)?></td>
      <td class="payment"><strong><?php echo PaymentPeer::sumAll($amortizations)?></strong></td>
    </tr>
  </tbody>
</table>
