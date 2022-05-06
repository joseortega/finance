<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
  <?php foreach ($pager->getResults() as $key=>$transaction): ?>
    <div class="alert <?php echo $transaction->getTypeOperationText()?>">
      <div class="body">
        <div class="title">
          <a href="<?php echo url_for('credit_transaction_history/show?id='.$credit->getId().'&transaction_id='.$transaction->getId())?>"><?php echo $transaction->getTransactionType()?></a>
          <?php echo __('type')?>
          <span><?php echo $transaction->getTransactionType()->getNature()?></span>
          
          <?php echo __('amount')?>
          <span><?php echo $transaction->getAmount()?></span>
          
          <?php echo __('Created at')?>
          <?php echo $transaction->getCreatedAt()?>
        </div>
        <div class="detail">
          <div class="message">
            <?php echo __('By user')?> <?php echo $transaction->getUser()?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('pagination', array('pager' => $pager, 'credit'=>$credit)) ?>
  <?php endif; ?>

  <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
  <?php if ($pager->haveToPaginate()): ?>
    <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
  <?php endif; ?>

<?php endif;?>
