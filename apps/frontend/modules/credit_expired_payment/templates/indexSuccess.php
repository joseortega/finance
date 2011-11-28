<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<div id="page_head" class="with_sub_nav">
  <h1><?php echo __('Expired Payments')?></h1>
  <?php include_partial('nav/credits') ?>  
</div>

<div class="columns clear_fix">
  
  <?php include_partial('util/flashes') ?>
  
  <div class="main">
    <?php include_partial('credit_expired_payment/list', array('pager' => $pager)) ?>
  </div>
</div>
