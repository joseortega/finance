[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div class="filter">
  [?php if ($form->hasGlobalErrors()): ?]
    [?php echo $form->renderGlobalErrors() ?]
  [?php endif; ?]

  <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post">
 
    [?php echo $form->renderHiddenFields() ?]
       
    [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
    [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
        'name'       => $name,
        'attributes' => $field->getConfig('attributes', array()),
        'label'      => $field->getConfig('label'),
        'help'       => $field->getConfig('help'),
        'form'       => $form,
        'field'      => $field,
        'class'      => 'form_row '.strtolower($field->getType()).' filter_field_'.$name,
      )) ?]
    [?php endforeach; ?]
    
    <ul class="actions">
      <li>[?php echo link_to('<span>'.__('Reset', array(), 'sf_admin').'</span>', '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class'=>'minibutton')) ?]</li>
      <li><button class="minibutton" type="submit"><span>[?php echo __('Filter', array(), 'sf_admin') ?]</span></button></li>
    </ul>

  </form>
</div>
