<?php if($credit->getAccount()):?>
    <table class="info">
        <tbody>
            <tr>
            <th><?php echo __('Account')?>:</th>
            <td><a href="<?php echo url_for('account/show?id='.$credit->getAccountId())?>"><?php echo $credit->getAccount()->getNumber()." / ".$credit->getAccount()->getProduct() ?></a></td>
            </tr>
        </tbody>
    </table>
<?php else:?>
    <?php if($credit->isInRequest() || $credit->isApproved() || $credit->isCurrent()):?>
          <ul>
            <li><a href="<?php echo url_for('credit_account_edit', $credit)?>"><span><?php echo __('Vincular una cuenta para el desembolso y el cobro respectivo')?></span></a> </li>
          </ul>
        <?php endif;?>
<?php endif; ?>
