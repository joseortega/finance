<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
    <ul class="list">
      <?php foreach ($pager->getResults() as $key=>$investment): ?>
      <li class="simple public">
        <ul class="balances">
          <li>
            <span><?php echo __($investment->getStatusText()) ?></span>
          </li>
          <li>
            <?php echo __('Amount') ?>
            <span><?php echo $investment->getAmount() ?></span>
            
          </li>
          <li>
            <?php echo __('Term in days') ?>
            <span><?php echo $investment->getTimeDays() ?></span>
          </li>
        </ul>
        <h3>
          <a href="<?php echo url_for('investment_show', $investment)?>">
            <?php echo $investment->getId() ?> 
            / 
            <?php echo $investment->getProduct() ?>
          </a>
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
  
