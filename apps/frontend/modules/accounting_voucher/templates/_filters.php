<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="filter">
  <form action="<?php echo url_for('accounting_voucher_collection', array('action' => 'filter')) ?>" method="post">
    <?php echo $form ;?>
    <ul class="actions">
      <li><?php echo link_to('<span>'.__('Reset').'</span>', 'accounting_voucher_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class'=>'minibutton')) ?></li>
      <li><button type="submit" class="minibutton"><span><?php echo __('Filter')?></span></button></li>
    </ul>
  </form>
</div>
