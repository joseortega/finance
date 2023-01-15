<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('page_head')?>

<div class="columns clear_fix">
  <div class="title_actions_bar">
    <h3>
      <?php echo __('New Accounting Voucher')?>
    </h3>
    <ul class="actions">
      <li><a class="minibutton" href="<?php echo url_for('@accounting_voucher')?>"><span><?php echo __('Back to list')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>  
  </div>
</div>

