<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('credit/index_page_head')?>

<div class="columns listcols clear_fix">
  
  <?php include_partial('util/flashes') ?>
  
  <div class="main">
    <?php include_partial('credit/list', array('pager' => $pager)) ?>
  </div>
  
  <div class="sidebar">    
    <?php include_partial('credit/filters', array('form' => $filters)) ?>
  </div>
  
</div>
