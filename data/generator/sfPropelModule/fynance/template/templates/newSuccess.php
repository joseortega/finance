[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="page_head">

  [?php include_partial('<?php echo $this->getModuleName() ?>/title_module') ?]
   
  [?php include_partial('<?php echo $this->getModuleName() ?>/nav') ?]
  
</div>

<div class="head_bar">
  [?php include_partial('<?php echo $this->getModuleName() ?>/new_edit_header_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  <h2>[?php echo <?php echo $this->getI18NString('new.title') ?> ?]</h2>
</div>

<div class="rule"></div>

<div class="columns newcols clear_fix">
  
  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]

</div>
