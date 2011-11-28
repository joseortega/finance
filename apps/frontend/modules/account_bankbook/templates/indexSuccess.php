<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('page_head')?>

<div class="columns listcols clear_fix">
  
  <div class="title_actions_bar clear_fix">
    <h3><?php echo __('Bankbooks')?></h3>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('@account_bankbook_new')?>"><span><?php echo __('New bankbook')?></span></a> </li>
    </ul>
  </div>
  
  <div class="rule"></div>
  
  <?php include_partial('util/flashes') ?>
  
  <div class="news">
    <?php include_partial('account_bankbook/list', array('pager' => $pager)) ?>
  </div>
  <div class="sidebar">
    <?php include_partial('account_bankbook/filters', array('form' => $filters)) ?>
  </div>
</div>