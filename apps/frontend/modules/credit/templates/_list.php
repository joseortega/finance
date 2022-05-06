<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
    <table class="credits" cellspacing="0">
      <thead>
        <tr>
          <th colspan="2"><?php echo __('Credit')?></th>
          <th class="data"><?php echo __('Product')?></th>
          <th class="data"><?php echo __('Amount')?></th>
          <th class="data"><?php echo __('Term')?></th>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
      </thead>
    <tfoot>
      <tr>
        <th colspan="5">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('credit/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$credit): ?>
      <tr class="row">
        <td class="gravatar" rowspan="2">
          <?php if ($credit->getAssociate()->getPicture()): ?>
            <img src="/uploads/pictures/thumb_<?php echo $credit->getAssociate()->getPicture()?>"alt="<?php echo $credit->getAssociate() ?>" width="36" height="36"/>
          <?php else: ?>
            <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $credit->getAssociate() ?>" width="36" height="36" />
          <?php endif; ?>
        </td>
        <td class="title">
          <a href="<?php echo url_for('associate_show',$credit->getAssociate())?>"><?php echo $credit->getAssociate()->getName()?></a>
          / 
          <a href="<?php echo url_for('credit_show', $credit)?>"><?php echo $credit->getId()?></a>
        </td>
        <td class="data"><?php echo $credit->getProduct() ?></td>
        <td class="data"><?php echo $credit->getAmount() ?></td>
        <td class="data"><?php echo $credit->getTimeInMonths() ?></td>
      </tr>
      <tr>
        <td colspan="4">
          <?php echo __('Created at')?> <?php echo $credit->getCreatedAt('Y-m-d')?>
            <span class="label"><?php echo __($credit->getStatusText())?></span>
        </td>
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

