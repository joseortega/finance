<table class="info">
  <tbody>
    <tr>
      <th class="label"><?php echo __('Members')?>:</th>
      <td class="data">
        <?php if(count($credit->getCommitteeMembers())==0):?>
          <?php echo __('None')?>
        <?php else:?>
        <ul>
          <?php foreach ($credit->getCommitteeMembers() as $member):?>
          <li><?php echo $member->getName() ?></li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </td>
    </tr>
  </tbody>
</table>