<table class="info">
  <tbody>
    <tr>
      <th class="label"><?php echo __('Persons')?>:</th>
      <td class="data">
        <?php if(count($credit->getGuaranteePersonals())==0):?>
          <?php echo __('No tiene ningun garante personal')?>
        <?php else:?>
        <ul>
          <?php foreach ($credit->getGuaranteePersonals() as $guarantee):?>
          <li><a href="<?php echo url_for('associate_show', $guarantee->getAssociate())?>"><?php echo $guarantee->getAssociate() ?></a></li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </td>
    </tr>
  </tbody>
</table>