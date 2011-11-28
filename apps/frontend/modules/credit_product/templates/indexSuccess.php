<?php use_helper('I18N', 'Date') ?>

<div id="page_head">
  <h1><?php echo __('Products')?></h1>
  <?php include_partial('nav/credits') ?>
</div>

<?php include_partial('util/flashes') ?>
<?php include_partial('credit_product/list', array('pager' => $pager)) ?>

