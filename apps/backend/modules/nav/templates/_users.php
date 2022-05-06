<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='sfGuardUser') echo 'class="selected"';?> href="<?php echo url_for('@sf_guard_user') ?>"><?php echo __('Users') ?></a></li> 
    <li><a <?php if($sf_context->getModuleName()=='sfGuardGroup') echo 'class="selected"';?> href="<?php echo url_for('@sf_guard_group') ?>"><?php echo __('Groups') ?></a></li>
  </ul>
</div>