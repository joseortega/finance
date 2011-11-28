<?php use_javascript('/js/jquery-1.5.min.js') ?>

<table class="info">
  <tbody>
    <tr>
      <th class="label"><?php echo __('Mortgages')?>:</th>
      <td class="data">
        <?php if(count($credit->getGuaranteeReals())==0):?>
        <?php echo __('No tiene ningun garante hipotecario')?>
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
      </td>
    </tr>
  </tbody>
</table>
   
