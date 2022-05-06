<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php use_helper('I18N', 'Date') ?>


<?php include_partial('associate/edit_page_head', array('associate'=>$associate)) ?>

<div class="htabs associate clear_fix">
  <div class="sidebar">
    <?php include_partial('associate/configuration', array('associate'=>$associate)) ?>
  </div>
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form, 'associate' => $associate)) ?>
  </div>
</div>