<div id="page_head">
  <h1><?php echo __('Products')?></h1>
  <?php include_partial('nav/savings') ?>
</div>

<table class="info product">
  <tbody>
    <tr>
      <th><?php echo __('Name')?></th>
      <td><?php echo $product->getName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Accounts linked')?></th>
      <td><?php echo $product->countAccounts() ?></td>
    </tr>
    <?php if($product->getInterestRateCurrent()):?>
      <tr>
        <th><?php echo __('Interest rate')?></th>
        <td><?php echo $product->getInterestRateCurrent() ?></td>
      </tr>
    <?php endif;?>
    <tr>
      <th><?php echo __('Created at')?></th>
      <td><?php echo $product->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Updated at')?></th>
      <td><?php echo $product->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<ul class="actions">
  <li><a class="minibutton" href="<?php echo url_for('account_product') ?>"><span><?php echo __('Back to List')?><span></a></li>
</ul>

