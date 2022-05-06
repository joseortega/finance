<table class="info">
  <tbody>
    <tr>
      <th class="label"><?php echo __('Guarantees')?>:</th>
      <td class="data">
        <?php if(count($credit->getGuaranteePersonals())==0):?>
          <?php echo __('None')?>
        <?php else:?>
        <ul>
          <?php foreach ($credit->getGuaranteePersonals() as $guarantee):?>
          <li><a href="<?php echo url_for('associate_show', $guarantee->getAssociate())?>"><?php echo $guarantee->getAssociate() ?></a></li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
        <?php if($credit->isInRequest() || $credit->isApproved() || $credit->isCurrent()):?>
          <ul>
            <li><a href="<?php echo url_for('credit_guarantee_personal', $credit)?>"><span><?php echo __('Añadir Garantías Personales')?></span></a> </li>
          </ul>
        <?php endif;?>
      </td>
    </tr>
  </tbody>
</table>