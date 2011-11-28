<table class="associates" cellspacing="0">
  <tbody>
    <?php foreach ($associates as $associate): ?>
      <tr class="row">
        <td class="gravatar" rowspan="2">
          <?php if ($associate->getPicture()): ?>
          <img src="/uploads/pictures/thumb_<?php echo $associate->getPicture()?>"alt="<?php echo $associate ?>" width="36" height="36"/>
          <?php else: ?>
            <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $associate ?>" width="36" height="36" />
          <?php endif; ?>
        </td>
        <td class="title"><a href="<?php echo url_for('associate_show',$associate)?>"><?php echo $associate?></a></td>
        <td class="data"><?php echo __(ucfirst($associate->getType())) ?></td>
        <td class="data"><?php echo $associate->getIdentification() ?></td>
        <td class="data"><?php echo $associate->getCategory() ?></td>
        <td class="data"><?php echo __('Created at') ?> <?php echo $associate->getCreatedAt('Y-m-d') ?></td>
      </tr>
      <tr>
        <td colspan="4">
          <?php echo __('Updated at') ?> <?php echo $associate->getUpdatedAt() ?>
        </td>
      </tr>
      <tr class="sep">
        <td></td>
        <td class="border" colspan="4"></td>
      </tr>
      <tr class="sep">
        <td colspan="5"></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

