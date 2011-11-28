<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('page_head')?>

<div class="columns newcols clear_fix">
  
  <div class="title_actions_bar clear_fix">
    <h3><?php echo __('New Bankbook')?></h3>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('@account_bankbook')?>"><span><?php echo __('Go to list')?></span></a> </li>
    </ul>
  </div>

  <div class="rule"></div>

  <div class="main">
    <?php include_partial('util/flashes')?>
    
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <h2><?php echo __('Note')?></h2>
      <p><?php echo __('Asegure de revisar bien los datos ingresados antes de guardar, no habra forma de modificar.')?></p>
    </div>
  </div>
</div>