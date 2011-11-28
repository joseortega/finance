<?php use_helper('I18N', 'Date') ?>
<?php include_partial('investment_product/assets') ?>

<?php include_partial('investment_product/edit_page_head', array('product' => $product)) ?>

<div class="htabs investment_product clear_fix">
  
   <div class="sidebar">
    <?php include_partial('investment_product/configuration', array('product'=>$form->getObject()))?>
  </div>
  
  <div class="main">
    <?php include_partial('investment_product/flashes') ?>
    <?php include_partial('investment_product/form', array('product' => $product, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>
</div>
