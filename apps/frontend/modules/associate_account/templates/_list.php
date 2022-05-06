<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
    <ul class="list">
      <?php foreach ($pager->getResults() as $key=>$account): ?>
      <li class="simple">
        <ul class="balances">
          <li>
            <?php echo __('Available') ?>
            <span><?php echo $account->getAvailableBalance() ?></span>
          </li>
          <li>
            <?php echo __('Blocked') ?>
            <span><?php echo $account->getBlockedBalance() ?></span>
          </li>
          <li>
            <?php echo __('Total') ?>
            <span><?php echo $account->getBalance() ?></span>
          </li>
        </ul>
        <h3>
          <a href="<?php echo url_for('account_show', $account)?>"><?php echo $account->getNumber() ?> / <?php echo $account->getProduct() ?></a>
        </h3>
      </li>
      <?php endforeach; ?>
    </ul>
  <div class="result">
    <?php if ($pager->haveToPaginate()): ?>
      <?php include_partial('pagination', array('pager' => $pager, 'associate'=> $associate)) ?>
    <?php endif; ?>

    <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
    <?php if ($pager->haveToPaginate()): ?>
      <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
    <?php endif; ?>
  </div>
<?php endif;?>
  
