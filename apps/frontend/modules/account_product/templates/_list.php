<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
    <table class="products" cellspacing="0">
    <tfoot>
      <tr>
        <th colspan="4">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('account_product/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$product): ?>
      <tr class="row">
        <td class="title"><a href="<?php echo url_for('account_product_show', $product)?>"><?php echo $product->getName() ?></a></td>   
        <td class="count_accounts">
          <?php echo __('Accounts')?>
          <?php echo $product->countAccounts()?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>

