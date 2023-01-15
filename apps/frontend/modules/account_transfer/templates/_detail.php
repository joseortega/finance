<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Created at')?>:</th>
      <td><?php echo $transfer->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Account from')?>:</th>
      <td><?php echo $transfer->getAccountOrigin() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Account to')?>:</th>
      <td><?php echo $transfer->getAccountDestination() ?></td>
    </tr>
    <tr>
      <th><?php echo __('User')?>:</th>
      <td><?php echo $transfer->getUser()->getUsername() ?></td>
    </tr>

    <tr>
      <th><?php echo __('Amount')?>:</th>
      <td><?php echo $transfer->getAmount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Observation')?>:</th>
      <td><?php echo $transfer->getObservation() ?></td>
    </tr>
  </tbody>

</table>
