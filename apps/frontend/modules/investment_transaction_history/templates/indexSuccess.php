<?php use_helper('I18N', 'Date') ?>

<?php echo include_partial('investment/investment_page_head', array('investment'=>$investment))?>

<div class=" columns clear_fix">
  <div class="news">
    <?php include_partial('list', array('pager' => $pager, 'investment'=> $investment)) ?>
  </div>
</div>