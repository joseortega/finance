<div id="page_head">
  <h1><?php echo __('Products')?></h1>
  <?php include_partial('nav/investments') ?>
</div>

<table class="info product">
  <tbody>
    <tr>
      <th><?php echo __('Name')?></th>
      <td><?php echo $product->getName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Investments linked')?></th>
      <td><?php echo $product->countInvestments() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Tax rate')?></th>
      <td><?php echo $product->getTaxRate() ?></td>
    </tr>
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
  <li><a class="minibutton" href="<?php echo url_for('@investment_product') ?>"><span><?php echo __('Back to List')?><span></a></li>
</ul>

