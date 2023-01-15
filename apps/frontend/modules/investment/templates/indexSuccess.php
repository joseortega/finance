<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('index_page_head')?>

<?php if(InvestmentPeer::doCountCurrentExpired() != 0):?>
  <div class="notice_task">
    <p>
      <?php if(InvestmentPeer::doCountCurrentExpired()==1):?>
        <?php echo __('Hay %%number%% inversión expirada.', array('%%number%%' => InvestmentPeer::doCountCurrentExpired())) ?>
      <a href="<?php echo url_for('@investment_expired')?>"><?php echo __('View')?></a>
      <?php else:?>
        <?php echo __('Hay %%number%% inversiones expiradas.', array('%%number%%' => InvestmentPeer::doCountCurrentExpired())) ?>
        <a href="<?php echo url_for('@investment_expired')?>"><?php echo __('View')?></a>
      <?php endif;?>
    </p>
  </div>
<?php endif;?>

<div class="columns listcols clear_fix">
  <?php include_partial('util/flashes') ?>
  <div class="main">
    <?php include_partial('investment/list', array('pager' => $pager)) ?>
  </div>
  <div class="sidebar">
    <?php include_partial('investment/filters', array('form' => $filters)) ?>
    <div>
      <p>
        <?php echo __('Print the filtered list,')?>
        <a href="<?php echo url_for('investment/printList?orderBy='.Criteria::ASC)?>"><?php echo __('asc')?></a>
        <?php echo __('or')?>
        <a href="<?php echo url_for('investment/printList')?>"><?php echo __('desc')?></a>
      </p>
    </div>
  </div>
</div>