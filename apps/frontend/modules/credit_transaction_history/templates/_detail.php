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
