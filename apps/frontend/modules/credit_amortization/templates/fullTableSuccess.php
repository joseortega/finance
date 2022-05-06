<?php use_helper('I18N', 'Date') ?>

<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<?php include_partial('head_bar_nav', array('credit'=>$credit))?>

<div class="columns listcols clear_fix">
  <?php include_partial('util/flashes')?>
  <?php include_partial('list_full', array('pager' => $pager, 'credit'=>$credit)) ?>
</div>
