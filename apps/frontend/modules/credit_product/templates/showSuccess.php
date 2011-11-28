<div id="page_head">
  <h1><?php echo __('Products')?></h1>
  <?php include_partial('nav/credits') ?>
</div>

<table class="info product">
  <tbody>
    <tr>
      <th><?php echo __('Name')?></th>
      <td><?php echo $product->getName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Credits linked')?></th>
      <td><?php echo $product->countCredits() ?></td>
    </tr>
    <?php if($product->getInterestRateCurrent()):?>
      <tr>
        <th><?php echo __('Interest rate')?></th>
        <td><?php echo $product->getInterestRateCurrent() ?></td>
      </tr>
    <?php endif;?>
      <?php if($product->getArrearRateCurrent()):?>
      <tr>
        <th><?php echo __('Arrear rate')?></th>
        <td><?php echo $product->getArrearRateCurrent() ?></td>
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
  <li><a class="minibutton" href="<?php echo url_for('@credit_product') ?>"><span><?php echo __('Back to List')?><span></a></li>
</ul>

