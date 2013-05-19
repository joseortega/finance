<?php use_helper('I18N', 'Date') ?>

<?php include_partial('account/account_page_head', array('account'=>$account))?>

<div class="">
  <div class="">
    <?php if($account->CountTransacctionsByBankbookIdNull()!=0):?>
      <div class="notice_task">
        <p>
          <?php if($account->CountTransacctionsByBankbookIdNull()==1):?>
            <?php echo __('Hay %%number%% transacción pendiente de imprimir en libreta.', array('%%number%%' => $account->CountTransacctionsByBankbookIdNull())) ?>
          <?php else:?>
            <?php echo __('Hay %%number%% Transacciones pendientes de imprimir en libreta.', array('%%number%%' => $account->CountTransacctionsByBankbookIdNull())) ?>
          <?php endif;?>
          <a class="confirm" href="<?php echo url_for('account/PrintPendingTransactionsInBankbook?id='.$account->getId())?>"><span><?php echo __('Print')?></span></a>
        </p> 
      </div>
    <?php endif;?>
  </div>
  <div class="">
    <?php include_partial('list_new_template', array('pager' => $pager, 'account'=> $account)) ?>
  </div>
  
</div>