<div id="page_head" class="info associate">
  <div class="title_actions_bar clear_fix">
    <h1>
      <span class="picture">
        <a href="<?php echo url_for('associate_picture/edit?id='.$associate->getId()) ?>">
          <?php if ($associate->getPicture()): ?>
          <img src="/uploads/pictures/thumb_<?php echo $associate->getPicture()?>"alt="<?php echo $associate ?>" width="40" height="40"/>
          <?php else: ?>
            <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $associate ?>" width="40" height="40" />
          <?php endif; ?>
        </a>
      </span>
      <a href="<?php echo url_for('associate_show', $associate)?>"><?php echo $associate ?></a>
    </h1>
    <ul class="actions">
      <?php if($associate->isPerson()):?>
        <li><a  class="minibutton" href="<?php echo url_for('associate_person_edit', $associate)?>"><span><?php echo __('Edit')?></span></a> </li>
        <li><a  class="minibutton" href="<?php echo url_for('@associate_person')?>"><span><?php echo __('Go to list')?></span></a> </li>
      <?php elseif($associate->isOrganization()):?>
        <li><a  class="minibutton" href="<?php echo url_for('associate_organization_edit', $associate)?>"><span><?php echo __('Edit')?></span></a> </li>
        <li><a  class="minibutton" href="<?php echo url_for('@associate_organization')?>"><span><?php echo __('Go to list')?></span></a> </li>
      <?php endif;?>
    </ul>
  </div>
  
  <?php echo include_partial('associate/associate_nav', array('associate'=>$associate))?>
  
</div>