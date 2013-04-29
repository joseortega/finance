<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="payments" cellspacing="0">
    <thead>
      <tr>
        <th><?php echo __('Date')?></th>
        <th class="data"><?php echo __('Id')?></th>
        <th class="data"><?php echo __('Transaction')?></th>
        <th class="data"><?php echo __('Amount')?></th>
        <th class="data"><?php echo __('Cash balance')?></th>
        <th class="payment"><?php echo __('User')?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="7">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('general_transaction/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>
          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$transaction): ?>
      <tr class="row <?php echo fmod($key, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $transaction->getCreatedAt() ?></td>
        <td class="number"><?php echo '#'?><?php echo $transaction->getId()?></td>
        <td class="data"><?php echo $transaction->getTransactionType()->getConcept() ?></td>
        <td class="data"><?php echo $transaction->getAmount() ?></td>
        <td class="data"><?php echo $transaction->getCashBalance() ?></td>
        <td class="data"><?php echo $transaction->getUser() ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>

