<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="form">
  <form action="<?php echo url_for('credit_transaction_type_configuration/update?operation_type='.$operationType) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
      <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
        <?php include_partial('form_fieldset', array('form'=>$form))?>
        <?php include_partial('form_actions', array('form'=>$form))?>
    </form>
</div>