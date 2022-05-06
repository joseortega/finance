<?php use_helper('I18N', 'Date') ?>

<?php include_partial('credit_product/edit_page_head', array('product' => $product))?>

<div class="htabs credit_product clear_fix">
 
  <div class="sidebar">
    <?php include_partial('credit_product/configuration', array('product'=>$product))?>
  </div>
  
  <div class="main">
    <div class="change_interest_rate clear_fix">
      <h3>
        <?php echo __('Interest Rates')?>
        <?php if($product->getInterestRateCurrent()):?>
          <em>(<?php echo __('Current')?> <?php echo $product->getInterestRateCurrent()?>)</em>
        <?php endif;?>
      </h3>
      <ul class="actions">
        <li><a class="minibutton" href="<?php echo url_for('credit_product_interest_rate_edit', $product) ?>"><span><?php echo __('Change')?></span></a></li>
      </ul>
    </div>
    
    <div class="rule"></div>
    <?php include_partial('util/flashes') ?> 
    <?php include_partial('credit_product_interest_rate/list', array('pager'=>$pager, 'product'=>$product))?>
  </div>
</div>