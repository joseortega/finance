<?php use_javascript('/js/jquery-1.5.min.js') ?>

<?php include_partial('investment_product/edit_page_head', array('product'=>$product))?>

<div class="htabs investment_product clear_fix">
  <div class="sidebar">
    <?php include_partial('investment_product/configuration', array('product'=>$product))?>
  </div>
  
  <div class="main">    
    <?php include_partial('util/flashes')?>
    <?php include_partial('form', array('form' => $form, 'product'=>$product)) ?>
  </div>
</div>