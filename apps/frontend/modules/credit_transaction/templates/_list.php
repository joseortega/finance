<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
  <?php foreach ($pager->getResults() as $key=>$transaction): ?>
  <div class="alert <?php echo $transaction->getTypeOperationText()?>">
    <div class="body">
      <div class="title">
        <a href="<?php echo url_for('credit_transaction/show?id='.$transaction->getId())?>"># <?php echo $transaction->getId()?> <?php echo $transaction->getTransactionType()?></a>
        <span><?php echo __($transaction->getTransactionType()->getNature())?></span>
        
        <?php echo __('amount')?>
        <span><?php echo $transaction->getAmount()?></span>
        
        <?php echo __('on')?>
        <a href="<?php echo url_for('credit_show', $transaction->getCredit())?>"><?php echo $transaction->getCredit()->getId()?></a>
        /
        <a href="<?php echo url_for('associate_show',$transaction->getCredit()->getAssociate())?>"><?php echo $transaction->getCredit()->getAssociate()->getName()?></a>
      </div>
      <div class="detail">
        <div class="message">
          <blockquote><?php echo __('Created at')?> <?php echo $transaction->getCreatedAt()?></blockquote>
          <?php echo __('By user')?> <?php echo $transaction->getUser()?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>

  <?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('credit_transaction/pagination', array('pager' => $pager)) ?>
  <?php endif; ?>
  <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
  <?php if ($pager->haveToPaginate()): ?>
    <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
  <?php endif; ?>
<?php endif;?>