<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Account')?>:</th>
      <td><a href="<?php echo url_for('account/show?id='.$credit->getAccountId())?>"><?php echo $credit->getAccount()->getNumber() ?></a></td>
    </tr>
</table>