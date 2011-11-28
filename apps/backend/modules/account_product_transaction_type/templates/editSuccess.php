<?php include_partial('account_product/edit_page_head', array('product'=>$product))?>

<div class="htabs account_product clear_fix">
  <div class="sidebar">
    <?php include_partial('account_product/configuration', array('product'=>$product))?>
  </div>

  <div class="main">
    <?php include_partial('util/flashes')?>
    <?php include_partial('form', array('form' => $form, 'product' => $product)) ?>
  </div>
</div>