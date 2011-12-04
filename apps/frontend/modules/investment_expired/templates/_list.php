<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <h3><?php echo __('No result') ?></h3>
  <?php else: ?>
    
  <div class="title_actions_bar">
    <h3><?php echo __('Investments Expired')?></h3>
    <ul class="actions">
      <li><a href="<?php echo url_for('@investment')?>"><span><?php echo __('All investment')?></span></a></li>
    </ul>
  </div>
  <div class="rule"></div>
  
  <table class="investments" cellspacing="0">
    <thead>
      <tr>
        <th colspan="2"><?php echo __('Investment')?></th>
        <th class="data"><?php echo __('Product')?></th>
        <th class="data"><?php echo __('Term')?></th>
        <th class="data"><?php echo __('Amount')?></th>
        <th class="data"><?php echo __('Interest')?></th>
        <th class="data"><?php echo __('Tax')?></th>
        <th class="data"><?php echo __('Total')?></th>
        <th class="actions"><a class="button black" onclick="return confirm('Are you sure?')" href="<?php echo url_for('investment/allRepay')?>"><span><?php echo __('Repay')?></span></a></th>
      </tr>
      <tr class="sep">
        <td colspan="9"></td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="6">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('investment_expired/pagination', array('pager' => $pager)) ?>
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
        <td class="data"><?php echo $investment->getProduct()?></td>
        <td class="data"><?php echo $investment->getTimeDays()?> <?php echo __('days')?></td>
        <td class="data"><?php echo $investment->getAmount()?></td>
        <td class="data"><?php echo $investment->getInterestAmount()?></td>
        <td class="data"><?php echo $investment->getTaxAmount()?></td>
        <td class="data"><?php echo $investment->getFinalAmount()?></td>
        <td class="td_actions">
          <a class="minibutton" onclick="return confirm('Are you sure?')" href="<?php echo url_for('investment_expired/repay?id='.$investment->getId())?>"><span><?php echo __('Repay')?></span></a>
        </td>
      </tr>
      <tr>
        <td colspan="5">
          <?php echo __('Expiration date')?> <?php echo $investment->getExpirationDate('Y-m-d')?>
        </td>
      </tr>
      <tr class="sep">
        <td></td>
        <td class="border" colspan="5"></td>
      </tr>
      <tr class="sep">
        <td colspan="5"></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>

