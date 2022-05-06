<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='associate_person' ) echo 'class="selected"';?> href="<?php echo url_for('@associate_person') ?>"><?php echo __('Persons') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_organization') echo 'class="selected"';?> href="<?php echo url_for('@associate_organization') ?>"><?php echo __('Organizations') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate') echo 'class="selected"';?> href="<?php echo url_for('associate/index') ?>"><?php echo __('Search') ?></a></li>
  </ul>
</div>