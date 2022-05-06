<?php include_partial('investment_product/edit_page_head', array('product'=>$product)) ?>

<div class="htabs investment_product clear_fix">
  <div class="sidebar">
    <?php include_partial('investment_product/configuration', array('product'=>$product)) ?>
  </div>
  <div class="main">
    <div class="ejector">
      <h2><?php echo __('Delete Product')?></h2>
      <div class="ejector-content">
        <p><?php echo __('Once you delete an product, there is no going back. Please be certain.')?></p>
        <?php echo link_to('<span>'.__('Delete this Product').'</span>', 'investment_product_delete', $product, array('method' => 'delete', 'confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?>
      </div>
    </div>
  </div>
</div>
