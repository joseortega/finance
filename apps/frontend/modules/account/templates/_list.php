<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="accounts" cellspacing="0">
    <thead>
        <tr>
          <th colspan="2"><?php echo __('Account')?></th>
          <th class="data"><?php echo __('Product')?></th>
          <th class="data"><?php echo __('Total')?></th>
          <th class="data"><?php echo __('Available')?></th>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
      </thead>
    <tfoot>
      <tr>
        <th colspan="5">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('account/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$account): ?>
      <tr class="row">
        <td class="gravatar" rowspan="2">
          <?php if ($account->getAssociate()->getPicture()): ?>
          <img src="/uploads/pictures/thumb_<?php echo $account->getAssociate()->getPicture()?>"alt="<?php echo $associate ?>" width="36" height="36"/>
          <?php else: ?>
            <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $account->getAssociate()->getPicture() ?>" width="36" height="36" />
          <?php endif; ?>
        </td>
        <td class="title">
          <a href="<?php echo url_for('associate_show',$account->getAssociate())?>"><?php echo $account->getAssociate()->getName()?></a> / 
          <a href="<?php echo url_for('account_show', $account)?>"><?php echo $account->getNumber()?></a>
        </td>
        <td class="data"><?php echo $account->getProduct()?></td>
        <td class="data"><?php echo $account->getBalance()?></td>
        <td class="data"><?php echo $account->getAvailableBalance()?></td>
      </tr>
      <tr>
        <td><?php echo __('Updated at')?> <?php echo $account->getUpdatedAt()?></td>
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

