<?php include_partial('account_product/edit_page_head', array('product'=>$product))?>

<div class="htabs credit_product clear_fix">
  <div class="sidebar">
    <?php include_partial('account_product/configuration', array('product'=>$product))?>
  </div>
  
  <div class="main">
    
    <div class="title_actions_bar clear_fix">
      <div class="breadcrumb">
        <h3><?php echo __('Change Interest Rate')?></h3>
      </div>
      <ul class="actions">
        <li><a class="minibutton" href="<?php echo url_for('account_product_interest_rate', $product) ?>"><span><?php echo __('Cancel')?></span></a></li>
      </ul>
    </div>
    
    <div class="rule"></div>
    
    <?php include_partial('util/flashes')?>
    <?php include_partial('form', array('form' => $form, 'product'=>$product)) ?>
  </div>
  
</div>