<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="payments" cellspacing="0">
    <thead>
      <tr>
        <th colspan="2"><?php echo __('Number')?></th>
        <th><?php echo __('Payment date')?></th>
        <th class="data"><?php echo __('Days in arrear')?></th>
        <th class="data"><?php echo __('Capital')?></th>
        <th class="data"><?php echo __('Interest')?></th>
        <th class="data"><?php echo __('Arrear')?></th>
        <th class="data"><?php echo __('Discount')?></th>
        <th class="payment"><?php echo __('Payment')?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="9">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('pagination_now', array('pager' => $pager, 'credit'=> $credit)) ?>
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
        <tr>
           <td class="status <?php echo $payment->getStatusText()?>"></td>
           <td class="number">#<?php echo $payment->getNumber()?></td>
           <td><?php echo $payment->getDate()?></td>
           <td class="data"><?php echo $payment->getDaysInArrear()?></td>
           <td class="data"><?php echo $payment->getCapital()?></td>
           <td class="data"><?php echo $payment->getInterest()?></td>
           <td class="data"><?php echo $payment->getArrear()?></td>
           <td class="data"><?php echo $payment->getDiscount()?></td>
           <td class="payment"><?php echo $payment->getTotal()?></td>
        </tr>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>

