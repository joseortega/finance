<?php include_partial('associate/associate_page_head', array('associate' => $associate))?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice">
    <a href="<?php echo url_for('associate_organization_edit', $associate)?>"><?php echo __('Edit other options')?></a>
    <?php echo __($sf_user->getFlash('notice')) ?>
  </div>
<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo __($sf_user->getFlash('error')) ?></div>
<?php endif ?>
<div class="columns infocols clear_fix">
  <div class="first">
    <?php echo include_partial('associate_organization/detail', array('associate'=>$associate))?>
  </div>
  <div class="last">
    <?php echo include_partial('associate/stats', array('associate'=>$associate))?>
  </div>
</div>
