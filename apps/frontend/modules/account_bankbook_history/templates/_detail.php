<div class="columns infocols bankbook clear_fix">
  
  <div class="title_actions_bar clear_fix">
    <h3><?php echo __('Detail Bankbook')?></h3>
    <ul class="actions"> 
      <li><a class="minibutton" href="<?php echo url_for('account_bankbook/printHeader?id='.$bankbook->getId())?>"><span><?php echo __('Print header')?></span></a></li>
      <li><a class="minibutton" href="<?php echo url_for('account_bankbook/printContent?id='.$bankbook->getId())?>"><span><?php echo __('Print content')?></span></a></li>
      <li><a class="minibutton" href="<?php echo url_for('account_bankbook/printAll?id='.$bankbook->getId())?>"><span><?php echo __('Print all')?></span></a></li>
    </ul>  
  </div>
  
  <div class="rule"></div>
  
  <div class="main">
      <?php $status = $bankbook->getIsActive()?'active':'inactive'?>
      <table class="info">
        <tbody>
          <tr>
            <th><?php echo __('Account')?>:</th>
            <td><?php echo $bankbook->getAccount() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Status')?>:</th>
            <td><?php echo __($status) ?></td>
          </tr>
          <tr>
            <th><?php echo __('Created at')?>:</th>
            <td><?php echo $bankbook->getCreatedAt() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Print row')?>:</th>
            <td><?php echo $bankbook->getPrintRow() ?></td>
          </tr>
        </tbody>
      </table>
  </div>
  <div class="sidebar"> 
  </div>
</div>
