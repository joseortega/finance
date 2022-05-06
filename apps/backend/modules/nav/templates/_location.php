<div class="nav">
  <ul>
    <li><a <?php if($sf_context->getModuleName()=='country' ) echo 'class="selected"';?> href="<?php echo url_for('@country') ?>"><?php echo __('Countries') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='province') echo 'class="selected"';?> href="<?php echo url_for('@province') ?>"><?php echo __('Provinces') ?></a></li>
    <li><a <?php if($sf_context->getModuleName()=='city') echo 'class="selected"';?> href="<?php echo url_for('@city') ?>"><?php echo __('Cities') ?></a></li>
  </ul>
</div>