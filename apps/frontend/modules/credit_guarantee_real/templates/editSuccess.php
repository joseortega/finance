<?php use_javascript('/js/jquery-1.5.min.js') ?>

<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('credit/edit_page_head', array('credit'=>$credit))?>

<div class="htabs credit clear_fix">
  <div class="sidebar">
    <?php include_partial('credit/configuration', array('credit'=>$credit))?>
  </div>
  <div class="columns typical">
    <div class="main">
      <?php include_partial('util/flashes')?>
      <?php include_partial('form', array('form' => $form, 'credit' => $credit)) ?>
    </div>
    <div class="sidebar">
      <p>
        <?php echo __('Las garantias reales pueden ser de tipo hipotecaria o prendaria.')?>
      </p>
    </div>
  </div>
</div>