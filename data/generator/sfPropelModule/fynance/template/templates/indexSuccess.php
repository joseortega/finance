[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="page_head">
  
  <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>
 
  [?php include_partial('<?php echo $this->getModuleName() ?>/nav') ?]
  
</div>

<div class="columns listcols clear_fix">
  
  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div class="main">
    <ul class="actions admin_list">
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </ul>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
<?php endif; ?>
    [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
    <ul class="actions">
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
    </ul>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    </form>
<?php endif; ?>
  </div>
  
  <?php if ($this->configuration->hasFilterForm()): ?>
  <div class="sidebar">
    [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
  </div>
<?php endif; ?>

</div>
