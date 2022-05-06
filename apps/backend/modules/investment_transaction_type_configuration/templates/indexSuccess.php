<div id="page_head">
  
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('Investment Transaction Types')?></h1>
  </div>
  
  <?php include_partial('nav/investment_products') ?>
  
</div>

<div class="htabs investment_transaction_type clear_fix">
  
  <div class="sidebar">
    <?php include_partial('configuration', array('operationType' => $operationType))?>
  </div>

  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form, 'operationType'=> $operationType)) ?>
  </div>

</div>


