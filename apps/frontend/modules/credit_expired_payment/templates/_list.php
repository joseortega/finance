<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
    <div class="title_actions_bar">
      <h3><?php echo __('Expired Payments')?></h3>
      <ul class="actions">
        <li><a class="minibutton" href="<?php echo url_for('credit_expired_payment/payExpiredAll')?>"><span><?php echo __('Pay all')?></span></a></li>
      </ul>
    </div>
    <div class="rule"></div>
    <?php foreach ($pager->getResults() as $credit):?>
      <div class="credit_expired">
        <div class="credit title_actions_bar">
          <h3>
            <a href="<?php echo url_for('associate_show',$credit->getAssociate())?>"><?php echo $credit->getAssociate()->getName()?></a>
            / 
            <a href="<?php echo url_for('credit_show', $credit)?>"><?php echo $credit->getId()?></a>
            <span>
              (<?php echo __('Account to debit:')?>
              <a href="<?php echo url_for('account_show', $credit->getAccount())?>">
                  <?php echo $credit->getAccount()->getNumber()?> / <?php echo $credit->getAccount()->getAvailableBalance()?>
              </a>)
            </span>
          </h3>
          <ul class="actions">
            <li><a class="customize" href="<?php echo url_for('credit_payment', $credit) ?>"><?php echo __('Customize') ?></a></li>
            <li><a class="gobutton" href="<?php echo url_for('credit_expired_payment/payExpiredOneCredit?id='.$credit->getId())?>"><span><?php echo __('Pay')?></span></a></li>
          </ul>
        </div>
        <div class="list">
          <?php include_partial('credit_payment/list', array('amortizations' => $credit->getExpiredPayments()))?>
        </div>
      </div>
    <?php endforeach;?>
    <div class="pagination">
      <?php if ($pager->haveToPaginate()): ?>
        <?php include_partial('credit_expired_payment/pagination', array('pager' => $pager)) ?>
      <?php endif; ?>

      <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
      <?php if ($pager->haveToPaginate()): ?>
        <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
      <?php endif; ?>
    </div>
  <?php endif;?>
</div>


