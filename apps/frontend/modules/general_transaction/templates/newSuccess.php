

<?php include_partial('cash_page_head', array('cash'=>$cash))?>

<div class="title_actions_bar">
  <h3>
    <?php echo __('New Transaction')?>
  </h3>
  <ul class="actions">
    <li><a class="minibutton" href="<?php echo url_for('@general_transaction')?>"><span><?php echo __('Back to list')?></span></a></li>
  </ul>
</div>

<div class="rule"></div>

<div class="columns newcols clear_fix">
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <h2><?php echo __('Note:')?></h2>
      <p>
        <?php echo __('Asegure de revisar bien los datos ingresados antes de guardar, no habra forma de modificar.')?>
        <a href="<?php echo url_for('@general_transaction')?>"><?php echo __('Back to list')?></a>
      </p>
    </div>
  </div>
</div>