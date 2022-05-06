<div class="pagination">
  <a href="<?php echo url_for('account_balance_blocked', $account) ?>?page=1">
    <img src="/sfPropelPlugin/images/first.png" alt="First page" title="First page" />
  </a>

  <a href="<?php echo url_for('account_balance_blocked', $account) ?>?page=<?php echo $pager->getPreviousPage() ?>">
    <img src="/sfPropelPlugin/images/previous.png" alt="Previous page" title="Previous page" />
  </a>

  <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
      <a href="<?php echo url_for('account_balance_blocked', $account) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
    <?php endif; ?>
  <?php endforeach; ?>

  <a href="<?php echo url_for('account_balance_blocked', $account) ?>?page=<?php echo $pager->getNextPage() ?>">
    <img src="/sfPropelPlugin/images/next.png" alt="Next page" title="Next page" />
  </a>

  <a href="<?php echo url_for('account_balance_blocked', $account) ?>?page=<?php echo $pager->getLastPage() ?>">
    <img src="/sfPropelPlugin/images/last.png" alt="Last page" title="Last page" />
  </a>
</div>