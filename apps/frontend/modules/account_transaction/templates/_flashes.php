<?php if ($sf_user->hasFlash('notice')): ?>
<div class="notice">
  <?php echo __($sf_user->getFlash('notice')) ?>
  <a class="confirm" href="<?php echo url_for('account/PrintPendingTransactionsInBankbook?id='.$transaction->getAccountId())?>"><span><?php echo __('Print in bankbook')?></span></a>
</div>
<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo __($sf_user->getFlash('error')) ?></div>
<?php endif ?>