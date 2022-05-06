<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="investments" cellspacing="0">
    <tfoot>
      <tr>
        <th colspan="5">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('investment/pagination', array('pager' => $pager)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$investment): ?>
      <tr class="row">
        <td class="gravatar" rowspan="2">
          <?php if ($investment->getAssociate()->getPicture()): ?>
          <img src="/uploads/pictures/thumb_<?php echo $investment->getAssociate()->getPicture()?>"alt="<?php echo $associate ?>" width="36" height="36"/>
          <?php else: ?>
            <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $investment->getAssociate()->getPicture() ?>" width="36" height="36" />
          <?php endif; ?>
        </td>
        <td class="title">
          <a href="<?php echo url_for('associate_show',$investment->getAssociate())?>"><?php echo $investment->getAssociate()->getName()?></a>
          / 
          <a href="<?php echo url_for('investment_show', $investment)?>"><?php echo $investment->getId()?></a>
        </td>
        <td><?php echo $investment->getProduct()?></td>
        <td><?php echo $investment->getAmount()?></td>
        <td> 
          <?php echo $investment->getTimeDays()?>
          <?php echo __('days')?>
        </td>
        
      </tr>
      <tr>
        <td colspan="4">
          <?php echo __('Created at')?> <?php echo $investment->getCreatedAt('Y-m-d')?>
          <em>(<?php echo __($investment->getStatusText())?>)</em>
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

