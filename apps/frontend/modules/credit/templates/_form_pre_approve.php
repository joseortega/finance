<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="form">
  <form action="<?php echo url_for('credit/approve?id='.$credit->getId())?>" method="post">
    <input type="hidden" name="sf_method" value="put" />
    <?php include_partial('form_fieldset_temporal_table', array('form'=>$form, 'credit'=>$credit))?>
    <ul class="actions">
        <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Approve credit')?></span> </button></li>
        <li><?php echo link_to('<span>'.__('Annul request').'</span>', 'credit/annul?id='.$credit->getId(), array('confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?></li>
      </ul>
  </form>
</div>