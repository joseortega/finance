<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('index_page_head')?>

<div class="columns listcols clear_fix">
  <?php include_partial('util/flashes') ?>
  <div class="main">
    <?php include_partial('account/list', array('pager' => $pager)) ?>
  </div>
  <div class="sidebar">
    <?php if(AccountPeer::doCountExpiredCapitalization() != 0):?>
      <div class="notice_task">
        <p>
          <?php if(AccountPeer::doCountExpiredCapitalization()==1):?>
            <?php echo __('There %%number%% account with expired capitalization,', array('%%number%%' => AccountPeer::doCountExpiredCapitalization())) ?>
          <a href="<?php echo url_for('@account_expired_capitalization')?>"><?php echo __('view')?></a>
          <?php else:?>
            <?php echo __('There %%number%% accounts with expired capitalization,', array('%%number%%' => AccountPeer::doCountExpiredCapitalization())) ?>
            <a href="<?php echo url_for('@account_expired_capitalization')?>"><?php echo __('view')?></a>
          <?php endif;?>
        </p>
      </div>
    <?php endif;?>
    <?php include_partial('account/filters', array('form' => $filters)) ?>
  </div>
</div>