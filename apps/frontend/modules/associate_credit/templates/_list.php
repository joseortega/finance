<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
    <ul class="list">
      <?php foreach ($pager->getResults() as $key=>$credit): ?>
      <li class="simple public">
        <ul class="balances">
          <li>
            <span><?php echo __($credit->getStatusText()) ?></span>
          </li>
          <li>
            <?php echo __('Amount') ?>
            <span><?php echo $credit->getAmount() ?></span>
          </li>
          <li>
            <?php echo __('Time in months') ?>
            <span><?php echo $credit->getTimeInMonths() ?></span>
          </li>
        </ul>
        <h3>
          <a href="<?php echo url_for('credit_show', $credit)?>"><?php echo $credit->getId() ?> / <?php echo $credit->getProduct() ?></a>
        </h3>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('pagination', array('pager' => $pager, 'associate'=> $associate)) ?>
  <?php endif; ?>

  <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
  <?php if ($pager->haveToPaginate()): ?>
    <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
  <?php endif; ?>
<?php endif;?>
  
