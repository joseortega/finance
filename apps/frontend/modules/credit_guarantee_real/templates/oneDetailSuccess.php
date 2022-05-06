<table class="info">
  <tbody>
    <tr>
      <th><?php echo __('Name')?></th>
      <td><?php echo $guarantee->getName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Value')?></th>
      <td><?php echo $guarantee->getValue() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Observation')?></th>
      <td><?php echo $guarantee->getDescription() ?></td>
    </tr>
  </tbody>
</table>