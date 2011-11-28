<?php use_helper('I18N', 'Date') ?>

<?php if($cash):?>
  <?php include_partial('cash_page_head', array('cash'=>$cash))?>
  <div class="title_actions_bar">
    <h3>
      <?php echo __('General Transactions')?>
    </h3>
    <ul class="actions">
      <li><a class="minibutton" href="<?php echo url_for('general_transaction_new')?>"><span><?php echo __('New transaction')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  <div class="columns transactions clear_fix">
    <?php include_partial('util/flashes') ?>
    <div class="news">
      <?php include_partial('general_transaction/list', array('pager' => $pager)) ?>
    </div>
    <div class="sidebar">
      <?php include_partial('general_transaction/filters', array('form' => $filters)) ?>
    </div>
  </div>
<?php else:?>
  <div id="page_head">
    <p class="notice_task"><a href="<?php echo url_for('connection/index')?>"><?php echo __('Open cash')?></a></p>
  </div>
<?php endif; ?>
