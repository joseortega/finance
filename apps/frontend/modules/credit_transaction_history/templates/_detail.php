<?php $payments = $transaction->getPayments()?>

<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Created at')?>:</th>
      <td><?php echo $transaction->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('User')?>:</th>
      <td><?php echo $transaction->getUser()->getUsername() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Credit')?>:</th>
      <td><?php echo $transaction->getCredit()->getId()?></td>
    </tr>
    <tr>
      <th><?php echo __('Transaction nature')?>:</th>
      <td><?php echo __($transaction->getTransactionType()->getNature()) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Transaction concept')?>:</th>
      <td><?php echo $transaction->getTransactionType() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Payments')?>:</th>
      <td>
        <?php foreach ($payments as $key => $payment): ?>
          <?php if($key!=0):?>
            <?php echo ','?>
          <?php endif;?>
          <?php echo $payment->getNumber()?>
        <?php endforeach;?>
      </td>
    </tr>
    <tr>
      <th><?php echo __('Capital')?>:</th>
      <td><?php echo PaymentPeer::sumCapital($payments) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Interest')?>:</th>
      <td><?php echo PaymentPeer::sumInterest($payments) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Arrear')?>:</th>
      <td><?php echo PaymentPeer::sumArrear($payments) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Discount')?>:</th>
      <td><?php echo PaymentPeer::sumDiscount($payments) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Amount')?>:</th>
      <td><?php echo $transaction->getAmount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Observation')?>:</th>
      <td><?php echo $transaction->getObservation() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Transaction id')?>:</th>
      <td><?php echo $transaction->getId() ?></td>
    </tr>
  </tbody>
</table>
