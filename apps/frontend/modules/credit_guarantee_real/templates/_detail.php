<?php use_javascript('/js/jquery-1.5.min.js') ?>

<table class="info">
  <tbody>
    <tr>
      <th class="label"><?php echo __('Guarantees')?>:</th>
      <td class="data">
        <?php if(count($credit->getGuaranteeReals())==0):?>
          <?php echo __('None')?>
        <?php else:?>
        <ul>
          <?php foreach ($credit->getGuaranteeReals() as $guarantee):?>
            <li>
              <a class="guarantee_detail" href="#" onclick="$('#gurantee_detail<?php echo $guarantee->getId()?>').toggle();"><?php echo $guarantee->getName()?></a>
              <table id="gurantee_detail<?php echo $guarantee->getId()?>" class="info guarantee_detail" style="display: none">
                  <tbody>
                    <tr>
                      <th><?php echo __('Description')?></th>
                      <td><?php echo $guarantee->getDescription() ?></td>
                    </tr>
                  </tbody>
                </table>
            </li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
        <?php if($credit->isInRequest() || $credit->isApproved() || $credit->isCurrent()):?>
          <ul>
            <li><a href="<?php echo url_for('credit_guarantee_real_edit', $credit)?>"><span><?php echo __('Añadir Garantías Hipotecarias o Prendarias')?></span></a> </li>
          </ul>
        <?php endif;?>
      </td>
    </tr>
  </tbody>
</table>
   
