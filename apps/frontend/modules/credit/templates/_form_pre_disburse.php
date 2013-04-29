<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="form">
  <form action="<?php echo url_for('credit/disburse?id='.$credit->getId())?>" method="post">
    <input type="hidden" name="sf_method" value="put" />
    <?php include_partial('form_fieldset', array('form'=>$form))?>
    <ul class="actions">
      <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Disburse credit')?></span> </button></li>
    </ul>
  </form>
</div>