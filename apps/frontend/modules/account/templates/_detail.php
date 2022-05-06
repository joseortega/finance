<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Product')?>:</th>
      <td><?php echo $account->getProduct() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Total balance')?> :</th>
      <td><?php echo $account->getBalance() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Frozen balance')?></th>
      <td><?php echo $account->getBlockedBalance() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Available balance')?></th>
      <td><?php echo $account->getAvailableBalance() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Capitalization frequency')?></th>
      <td><?php echo __(ucfirst($account->getCapitalizationFrequency())) ?></td>
    </tr>
    <?php if($account->getLastCapitalization()):?>
      <tr>
        <th><?php echo __('Last capitalization')?></th>
        <td><?php echo $account->getLastCapitalization() ?></td>
      </tr>
    <?php endif;?>
    <tr>
      <th><?php echo __('Next capitalization')?></th>
      <td><?php echo $account->getNextCapitalization() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Created at')?></th>
      <td><?php echo $account->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Updated at')?></th>
      <td><?php echo $account->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>