
<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('page_head')?>

<div class="columns transactions clear_fix">
  <div class="title_actions_bar">
    <h3>
      <?php echo __('Transfers')?>
    </h3>
    <ul class="actions main_nav">
      <li><a class="minibutton" href="<?php echo url_for('@account_transfer_new')?>"><span><?php echo __('New transfer')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  <?php include_partial('util/flashes') ?>
  <div class="news">
    <?php include_partial('account_transfer/list', array('pager' => $pager)) ?>
  </div>
  <div class="sidebar">
    <?php include_partial('account_transfer/filters', array('form' => $filters)) ?>
    <div>
      <p>
        <?php // echo __('Print the filtered list,')?>
        <a href="<?php //echo url_for('account_transaction/printList?orderBy='.Criteria::ASC)?>"><?php //echo __('asc')?></a>
        <?php //echo __('or')?>
        <a href="<?php //echo url_for('account_transaction/printList')?>"><?php //echo __('desc')?></a>
      </p>
    </div>
  </div>
</div>