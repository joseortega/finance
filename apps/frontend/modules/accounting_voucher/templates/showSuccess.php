<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $AccountingVoucher->getId() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $AccountingVoucher->getCode() ?></td>
    </tr>
    <tr>
      <th>Reference:</th>
      <td><?php echo $AccountingVoucher->getReference() ?></td>
    </tr>
    <tr>
      <th>Date:</th>
      <td><?php echo $AccountingVoucher->getDate() ?></td>
    </tr>
    <tr>
      <th>Observation:</th>
      <td><?php echo $AccountingVoucher->getObservation() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $AccountingVoucher->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $AccountingVoucher->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('accounting_voucher/edit?id='.$AccountingVoucher->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('accounting_voucher/index') ?>">List</a>
