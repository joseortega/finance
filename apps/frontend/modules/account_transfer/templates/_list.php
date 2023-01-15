<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="accounts" cellspacing="0">
    <thead>
        <tr>
          <th class="data"><?php echo __('Id')?></th>
          <th class="data"><?php echo __('Origin')?></th>
          <th class="data"><?php echo __('Destination')?></th>
          <th class="data"><?php echo __('Amount')?></th>
          <th class="data"><?php echo __('Date')?></th>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
      </thead>
    <tfoot>
      <tr>
        <th colspan="5">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('account_transfer/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$transfer): ?>
      <tr class="row">
        <td class="data">
            <a href="<?php echo url_for('account_transfer_show', $transfer)?>"># <?php echo $transfer->getId()?></a>       
        </td>
        <td class="data">
            <a href="<?php echo url_for('account_show', $transfer->getAccountOrigin())?>"><?php echo $transfer->getAccountOrigin()->getNumber()?></a> / 
            <a href="<?php echo url_for('associate_show',$transfer->getAccountOrigin()->getAssociate())?>"><?php echo $transfer->getAccountOrigin()->getAssociate()->getName()?></a>
        </td>
        <td class="data">
            <a href="<?php echo url_for('account_show', $transfer->getAccountDestination())?>"><?php echo $transfer->getAccountDestination()->getNumber()?></a> / 
            <a href="<?php echo url_for('associate_show',$transfer->getAccountDestination()->getAssociate())?>"><?php echo $transfer->getAccountDestination()->getAssociate()->getName()?></a>
        </td>
        <td class="data"><?php echo $transfer->getAmount()?></td>
        <td class="data"><?php echo $transfer->getCreatedAt('Y-m-d')?></td>
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
