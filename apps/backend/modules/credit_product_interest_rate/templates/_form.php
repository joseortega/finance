<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="form">
  <form action="<?php echo url_for('credit_product_interest_rate_update', $product) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
      <input type="hidden" name="sf_method" value="put" />
      <?php include_partial('form_fieldset', array('form'=>$form))?>
      <?php include_partial('form_actions', array('form'=>$form, 'product'=>$product))?>
  </form>
</div>