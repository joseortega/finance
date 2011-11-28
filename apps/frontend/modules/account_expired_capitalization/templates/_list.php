<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <h3><?php echo __('No result') ?></h3>
  <?php else: ?>
    
    <div class="title_actions_bar">
      <h3><?php echo __('Capitalize Interest')?></h3>
      <ul class="actions">
        <li><a href="<?php echo url_for('@account')?>"><span><?php echo __('Back')?></span></a></li>
      </ul>
    </div>

    <div class="rule"></div>

    <table class="accounts" cellspacing="0">
      <thead>
        <tr>
          <th colspan="2"><?php echo __('Account')?></th>
          <th class="data"><?php echo __('Product')?></th>
          <th class="data"><?php echo __('Balance')?></th>
          <th class="data"><?php echo __('Frequency')?></th>
          <th class="data"><?php echo __('Expiration date')?></th>
          <th class="data"><?php echo __('Interest')?></th>
          <th class="actions"><a class="button black" onclick="return confirm('Are you sure?')" href="<?php echo url_for('account/allCapitalize')?>"><span><?php echo __('Capitalize')?></span></a></th>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="8">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('account_expired_capitalization/pagination', array('pager' => $pager)) ?>
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
          <td class="data"><?php echo __(ucfirst($account->getCapitalizationFrequency()))?></td>
          <td class="data"><?php echo $account->getNextCapitalization()?></td>
          <td class="data"><?php echo $account->getInterestAccumulated()?></td>
          <td class="td_actions"><a class="minibutton" onclick="return confirm('Are you sure?')" href="<?php echo url_for('account/capitalize?id='.$account->getId())?>"><span><?php echo __('Capitalize')?></span></a></td>
        </tr>
        <tr>
          <td colspan="7"><?php echo __('Last capitalization')?> <?php echo $account->getLastCapitalization()?></td>
        </tr>
        <tr class="sep">
          <td></td>
          <td class="border" colspan="7"></td>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif;?>
</div>

