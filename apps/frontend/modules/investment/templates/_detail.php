<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Created at')?></th>
      <td><?php echo $investment->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Product')?>:</th>
      <td><?php echo $investment->getProduct() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Amount')?> :</th>
      <td><?php echo $investment->getAmount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Balance')?> :</th>
      <td><?php echo $investment->getBalance() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Time in days')?></th>
      <td><?php echo $investment->getTimeDays() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Expiration date')?></th>
      <td><?php echo $investment->getExpirationDate('Y-m-d') ?></td>
    </tr>
    <tr>
      <th><?php echo __('Effective rate %')?> :</th>
      <td><?php echo $investment->getInterestRate()?></td>
    </tr>
    <tr>
      <th><?php echo __('Withholding tax %')?> :</th>
      <td><?php echo $investment->getTaxRate() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Amount tax')?> :</th>
      <td><?php echo $investment->getTaxAmount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Amount interest')?> :</th>
      <td><?php echo $investment->getInterestAmount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Final amount')?></th>
      <td><?php echo $investment->getFinalAmount() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Account to accredit')?></th>
      <td><a href="<?php echo url_for('account_show', $investment->getAccount())?>"><?php echo __($investment->getAccount()->getNumber())?></a></td>
    </tr>
  </tbody>
</table>