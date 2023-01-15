<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="accounts" cellspacing="0">
    <thead>
        <tr>
          <th class="data"><?php echo __('Id')?></th>
          <th class="data"><?php echo __('Code')?></th>
          <th class="data"><?php echo __('Reference')?></th>
          <th class="data"><?php echo __('Date')?></th>
          <th class="data"><?php echo __('Created At')?></th>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
      </thead>
    <tfoot>
      <tr>
        <th colspan="5">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('accounting_voucher/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$accountingVoucher): ?>
      <tr class="row">
        <td class="data">
            <a href="<?php echo url_for('accounting_voucher_show', $accountingVoucher)?>"># <?php echo $accountingVoucher->getId()?></a>       
        </td>
        <td class="data"><?php echo $accountingVoucher->getCode()?></td>
        <td class="data"><?php echo $accountingVoucher->getReference()?></td>
        <td class="data"><?php echo $accountingVoucher->getDate()?></td>
        <td class="data"><?php echo $accountingVoucher->getCreatedAt('Y-m-d')?></td>
      </tr>
      <tr class="sep">
        <td></td>
        <td class="border" colspan="4"></td>
      </tr>
      <tr class="sep">
        <td colspan="5"></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>
