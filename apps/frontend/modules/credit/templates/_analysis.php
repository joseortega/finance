<?php if(!$credit->isPaid()):?>
    <h4 class="section_header"><?php echo __('Economic Information')?></h4>
    <?php $associate = $credit->getAssociate()?>
    <table class="info">
      <tbody>
        <tr>
          <th><?php echo __('Monthly income')?></th>
          <td><?php echo $associate->getMonthlyIncome() ?></td>
        </tr>
        <tr>
          <th><?php echo __('Monthly expenditure')?></th>
          <td><?php echo $associate->getMonthlyExpenditure() ?></td>
        </tr>
      </tbody>
    </table>

    <div class="rule"></div>

    <h4 class="section_header"><?php echo __('Repayment Capacity')?></h4>

    <table class="info">
      <tbody>
        <tr>
          <th><?php echo __('Associate monthly liquid')?></th>
          <td><?php echo number_format($associate->getMonthlyLiquid(), 2) ?></td>
        </tr>
        <tr>
          <th><?php echo __('Average monthly payment')?></th>
          <td><?php echo number_format($credit->getAverageMonthlyFee(), 2) ?></td>
        </tr>
      </tbody>
    </table>

    <div class="rule"></div>

    <h4 class="section_header"><?php echo __('Account Balances')?></h4>
    <table class="info">
      <tbody>
        <?php foreach ($associate->getAccounts() as $account)?>
        <tr>
          <th><?php echo $account->getNumber()?></th>
          <td><?php echo $account->getBalance() ?></td>
        </tr>
      </tbody>
    </table>

    <div class="rule"></div>

    <h4 class="section_header"><?php echo __('Outstanding Credits')?></h4>
    <table class="info">
      <tbody>
        <?php if($associate->countCreditsCurrent() == 0):?>
          <?php echo __('It has no outstanding loans')?>
        <?php else:?>
          <?php foreach ($associate->getCreditsCurrent() as $creditCurrent):?>
            <tr>
              <th><?php echo __('Credit #%id%', array('%id%' => $creditCurrent->getId()))?></th>
              <td><?php echo __('%number% outstanding payments', array('%number%' => $creditCurrent->CountPaymentsPending())) ?></td>
            </tr>
          <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    <div class="rule"></div>
<?php endif;?>

<h4 class="section_header"><?php echo __('Credit Committee')?></h4>
<?php include_partial('credit_committee_member/detail', array('credit'=>$credit))?>
