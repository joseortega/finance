<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Number')?></th>
      <td><?php echo $associate->getNumber()?></td>
    </tr>
    <tr>
      <th><?php echo __('Category')?></th>
      <td><?php echo $associate->getCategory() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Name')?></th>
      <td><?php echo $associate->getName() ?></td>
    </tr>
    <?php if($associate->getIdentification()):?>
      <tr>
        <th><?php echo __('Identification')?></th>
        <td><?php echo $associate->getIdentification() ?></td>
      </tr>
    <?php endif;?>
    <?php if($associate->getBirthday()):?>
      <tr>
        <th><?php echo __('constitution at')?></th>
        <td><?php echo $associate->getBirthday() ?></td>
      </tr>
    <?php endif;?>
    <?php if($associate->getCityCurrent()):?>
      <tr>
        <th><?php echo __('City current')?></th>
        <td><?php echo $associate->getCityCurrent() ?></td>
      </tr>
    <?php endif;?>
    <?php if($associate->getCityHomeTown()):?>
      <tr>
        <th><?php echo __('City hometown')?></th>
        <td><?php echo $associate->getCityHomeTown() ?></td>
      </tr>
    <?php endif;?>
    <?php if(count($associate->getPhones()) > 0):?>
      <tr>
        <th><?php echo __('Phones')?></th>
        <td>
          <?php foreach ($associate->getPhones() as $phone):?>
            <?php echo $phone->getNumber() ?>
          <?php endforeach;?>
        </td>
      </tr>
    <?php endif;?>
    <tr>
      <th><?php echo __('Created at')?></th>
      <td><?php echo $associate->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Updated at')?></th>
      <td><?php echo $associate->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>