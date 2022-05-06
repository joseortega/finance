<?php use_helper('I18N', 'Date') ?>

<div id="page_head">
  <h1><?php echo __('Products')?></h1>
  <?php include_partial('nav/savings') ?>
</div>

<?php include_partial('account_product/flashes') ?>
<?php include_partial('account_product/list', array('pager' => $pager)) ?>

