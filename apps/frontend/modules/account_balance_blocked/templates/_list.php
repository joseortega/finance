<div class="list balance_block_details">
  <ul class="actions admin_list">
    <li><a  class="minibutton" href="<?php echo url_for('account_balance_blocked_new', $account)?>"><span><?php echo __('New block')?></span></a></li>
  </ul>
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
    <table class="" cellspacing="0">
      <thead>
        <tr>
          <th><?php echo __('Description')?></th>
          <th><?php echo __('Blocked at')?></th>
          <th><?php echo __('Amount')?></th>
          <th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="8">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('account_balance_blocked/pagination', array('pager' => $pager, 'account'=> $account)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $balanceBlockedDetail): ?>
          <tr>
            <td><?php echo $balanceBlockedDetail->getReasonBlock() ?></td>
            <td><?php echo $balanceBlockedDetail->getBlockedAt() ?></td>
            <td><?php echo $balanceBlockedDetail->getAmount() ?> </td>
            <td>
              <ul class="td_actions">
                <li><a  class="minibutton" href="<?php echo url_for('account_balance_blocked/unblock?id='.$balanceBlockedDetail->getId())?>"><span><?php echo __('Unblock')?></span></a></li>
              </ul>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif;?>
</div>

