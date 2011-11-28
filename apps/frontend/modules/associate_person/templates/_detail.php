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
      <th><?php echo __('Identification')?></th>
      <td><?php echo $associate->getIdentification() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Name')?></th>
      <td><?php echo $associate->getName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Gender')?></th>
      <td><?php echo __($associate->getGender()) ?></td>
    </tr>
    <?php if($associate->getBirthday()):?>
      <tr>
        <th><?php echo __('Birthday')?></th>
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