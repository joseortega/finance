<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
    <table class="interest_rates" cellspacing="0">
      <thead>
        <tr>
          <th><?php echo __('Created at')?></th>
          <th><?php echo __('Rate')?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="8">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('account_product_interest_rate/pagination', array('pager' => $pager, 'product'=> $product)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $productInterestRate): ?>
          <tr>
            <td><?php echo $productInterestRate->getRateUnique()->getCreatedAt() ?></td>
            <td><?php echo $productInterestRate->getRateUnique()->getValue() ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif;?>
</div>

