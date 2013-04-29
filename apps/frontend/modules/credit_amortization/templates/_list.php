<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="payments" cellspacing="0">
    <thead>
      <tr>
        <th></th>
        <th></th>
        <th><?php echo __('Payment date')?></th>
        <th class="data"><?php echo __('Balance')?></th>
        <th class="data"><?php echo __('Capital')?></th>
        <th class="data"><?php echo __('Interest')?></th>
        <th class="payment"><?php echo __('Payment')?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="7">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('pagination', array('pager' => $pager, 'credit'=> $credit)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$payment): ?>
      <tr class="row <?php echo fmod($key, 2) ? 'even' : 'odd' ?>">
        <td class="status <?php echo $payment->getStatusText()?>"></td>
        <td class="number"><?php echo '#'?><?php echo $payment->getNumber()?></td>
        <td><?php echo $payment->getDate() ?></td>
        <td class="data"><?php echo $payment->getBalance() ?></td>
        <td class="data"><?php echo $payment->getCapital() ?></td>
        <td class="data"><?php echo $payment->getInterest() ?></td>
        <td class="payment"><?php echo $payment->getPreTotal() ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>

