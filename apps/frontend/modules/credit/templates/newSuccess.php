<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('New Credit')?></h1>
  </div>
</div>

<?php include_partial('credit/steps', array('credit'=>$form->getObject()))?>

<div class="columns newcols clear_fix">
  <div  class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <h2><?php echo __('Note')?>:</h2>
      <p>
        <?php echo __('These basic data to create a credit, later you can add more features individuals.')?>
        <a href="<?php echo url_for('@credit')?>"><span><?php echo __('Credit list')?></span></a>
      </p>
    </div>
  </div>
</div>


