<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('page_head')?>

<div class="columns transactions clear_fix">
  <?php include_partial('util/flashes') ?>
  <div class="news">
    <?php include_partial('investment_transaction/list', array('pager' => $pager)) ?>
  </div>
  <div class="sidebar">
    <?php include_partial('investment_transaction/filters', array('form' => $filters)) ?>
    <div>
      <p>
        <?php echo __('Print the filtered list,')?>
        <a href="<?php echo url_for('investment_transaction/printList?orderBy='.Criteria::ASC)?>"><?php echo __('asc')?></a>
        <?php echo __('or')?>
        <a href="<?php echo url_for('investment_transaction/printList')?>"><?php echo __('desc')?></a>
      </p>
    </div>
  </div>
</div>