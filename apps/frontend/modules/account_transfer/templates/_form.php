<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="form">
  <form action="<?php echo url_for('account_transfer/create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
      <?php include_partial('form_fieldset', array('form'=>$form))?>
      <?php include_partial('form_actions', array('form'=>$form))?>
  </form>
</div>
