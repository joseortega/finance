<?php $status = $bankbook->getIsActive()?'active':'inactive'?>

<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Account')?>:</th>
      <td><?php echo $bankbook->getAccount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Status')?>:</th>
      <td><?php echo __($status) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Created at')?>:</th>
      <td><?php echo $bankbook->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Print row')?>:</th>
      <td><?php echo $bankbook->getPrintRow() ?></td>
    </tr>
  </tbody>
</table>
