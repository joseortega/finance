<?php use_helper('I18N', 'Date') ?>

<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class=" columns clear_fix">
  <div class="news">
    <?php include_partial('list', array('pager' => $pager, 'credit'=> $credit)) ?>
  </div>
</div>