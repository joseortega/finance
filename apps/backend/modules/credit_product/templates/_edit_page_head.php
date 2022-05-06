<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><a href="<?php echo url_for('credit_product_edit', $product)?>"><?php echo $product?></a></h1>
    <ul class="actions">
      <li><a class="minibutton" href="<?php echo url_for('@credit_product')?>"><span><?php echo __('Back to list')?></span></a> </li>
    </ul>
  </div>
  <p class="breadcrumb"> 
    <?php echo __('Credit Product')?>
    <span class="separator"></span>
    <?php echo $product?>
  </p>
</div>