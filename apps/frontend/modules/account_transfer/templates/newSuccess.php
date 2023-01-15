<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('page_head')?>

<div class="columns newcols clear_fix">
  <div class="title_actions_bar">
    <h3>
      <?php echo __('New Transfer')?>
    </h3>
    <ul class="actions">
      <li><a class="minibutton" href="<?php echo url_for('@account_transfer')?>"><span><?php echo __('Back to list')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <h2><?php echo __('Note:')?></h2>
      <p>
        <?php echo __('Asegure de revisar bien los datos ingresados antes de guardar, no habra forma de modificar.')?>
        <a href="<?php echo url_for('@account_transfer')?>"><?php echo __('Back to list')?></a>
      </p>
    </div>
  </div>
</div>

