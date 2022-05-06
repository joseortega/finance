<?php use_helper('I18N', 'Date') ?>
<?php include_partial('account_product/assets') ?>

<?php include_partial('account_product/edit_page_head', array('product'=>$form->getObject()))?>

<div class="htabs account_product clear_fix">
  
  <div class="sidebar">
    <?php include_partial('account_product/configuration', array('product'=>$form->getObject()))?>
  </div>

  <div class="main">
    <?php include_partial('account_product/flashes') ?>
    <?php include_partial('account_product/form', array('product' => $product, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

</div>
