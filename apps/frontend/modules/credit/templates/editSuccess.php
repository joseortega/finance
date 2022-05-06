<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('credit/edit_page_head', array('credit'=>$form->getObject()))?>

<div class="htabs credit clear_fix">
  <div class="sidebar">
    <?php include_partial('configuration', array('credit'=>$form->getObject()))?>
  </div>
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
</div>