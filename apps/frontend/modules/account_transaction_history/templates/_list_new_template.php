
  <div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="payments" cellspacing="0">
    <thead>
      <tr>
        <th><?php echo __('Date')?></th>
        <th><?php echo __('Transaction')?></th>
        <th class="data"><?php echo __('Number')?></th>
        <th class="data"><?php echo __('Type')?></th>
        <th class="data"><?php echo __('Amount')?></th>
        <th class="data"><?php echo __('Balance')?></th>
        <th class="payment"><?php echo __('User')?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="9">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('pagination', array('pager' => $pager, 'account'=> $account)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$transaction): ?>
      <tr class="row <?php echo fmod($key, 2) ? 'even' : 'odd' ?>">
        <tr>
           <td class="">#<?php echo $transaction->getCreatedAt()?></td>
           <td><a class="ajax_link" href="<?php echo url_for('account_transaction_history/show?id='.$account->getId().'&transaction_id='.$transaction->getId())?>"><?php echo $transaction->getTransactionType()?></a></td>
           <td class="data">#<?php echo $transaction->getId()?></td>
           <td class="data"><?php echo $transaction->getTransactionType()->getNature()?></td>
           <td class="data"><?php echo $transaction->getAmount()?></td>
           <td class="data"><?php echo $transaction->getAccountBalance()?></td>
           <td class="payment"><?php echo $transaction->getUser()?></td>
        </tr>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>
