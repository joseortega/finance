<?php if($associate->isPerson()):?>
  <?php include_partial('associate_person/info', array('associate' => $associate))?>
<?php elseIf($associate->isOrganization()):?>
  <?php include_partial('associate_organization/info', array('associate' => $associate))?>
<?php endif;?>

