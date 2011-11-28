<?php if($associate->isPerson()):?>
  <ul class="sidetabs">
    <li><a <?php if($sf_context->getModuleName()=='associate_person') echo 'class="selected"';?> href="<?php echo url_for('associate_person_edit', $associate) ?>"><?php echo __('Basic Information')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_picture') echo 'class="selected"';?> href="<?php echo url_for('associate_picture_edit', $associate) ?>"><?php echo __('Profile Picture')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_contact') echo 'class="selected"';?> href="<?php echo url_for('associate_contact_edit', $associate) ?>"><?php echo __('Contact Information')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='email') echo 'class="selected"';?> href="<?php echo url_for('email', $associate) ?>"><?php echo __('Email Addresses')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_relationship') echo 'class="selected"';?> href="<?php echo url_for('associate_relationship_edit', $associate) ?>"><?php echo __('Family References')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_manage') echo 'class="selected"';?> href="<?php echo url_for('associate_manage', $associate) ?>"><?php echo __('Manage Associate')?></a></li>
  </ul>
<?php elseif($associate->isOrganization()):?>
  <ul class="sidetabs">
    <li><a <?php if($sf_context->getModuleName()=='associate_organization') echo 'class="selected"';?> href="<?php echo url_for('associate_organization_edit', $associate) ?>"><?php echo __('Basic Information')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_picture') echo 'class="selected"';?> href="<?php echo url_for('associate_picture_edit', $associate) ?>"><?php echo __('Profile Picture')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_contact') echo 'class="selected"';?> href="<?php echo url_for('associate_contact_edit', $associate) ?>"><?php echo __('Contact Information')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='email') echo 'class="selected"';?> href="<?php echo url_for('email', $associate) ?>"><?php echo __('Email Addresses')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_relationship') echo 'class="selected"';?> href="<?php echo url_for('associate_relationship_edit', $associate) ?>"><?php echo __('Members')?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='associate_manage') echo 'class="selected"';?> href="<?php echo url_for('associate_manage', $associate) ?>"><?php echo __('Manage Associate')?></a></li>
  </ul>
<?php endif;?>