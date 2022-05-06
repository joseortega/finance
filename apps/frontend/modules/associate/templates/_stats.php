<ul class="stats clear_fix">
  <li>
    <a href="<?php echo url_for('associate_account', $associate)?>">
      <strong><?php echo $associate->countAccounts()?></strong>
      <span><?php echo __('Accounts')?></span>
    </a>
  </li>
  <li>
    <a href="<?php echo url_for('associate_investment', $associate)?>">
      <strong><?php echo $associate->countInvestments()?></strong>
      <span><?php echo __('Investments')?></span>
    </a>
  </li>
  <li>
    <a href="<?php echo url_for('associate_credit', $associate)?>">
      <strong><?php echo $associate->countCredits()?></strong>
      <span><?php echo __('Credits')?></span>
    </a>
  </li>
</ul>