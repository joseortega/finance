[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }
  
  public function linkToNew($params)
  {
    return '<li class="action_new">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', '@'.$this->getUrlForAction('new'), array('class'=>'minibutton')).'</li>';
  }

  public function linkToEdit($object, $params)
  {
    return '<li class="action_edit">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', $this->getUrlForAction('edit'), $object, array('class'=>'minibutton')).'</li>';
  }

  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return '<li class="action_delete">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'], 'class'=>'button classy danger')).'</li>';
  }
  
  public function linkToDelete1($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return '<li class="action_delete">'.link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'])).'</li>';
  }

  public function linkToList($params)
  {
    return '<li class="action_list">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', '@'.$this->getUrlForAction('list'), array('class'=>'minibutton medium')).'</li>';
  }

  public function linkToSave($object, $params)
  {
    return '<li class="action_save"><button type="submit" class="button classy" onclick="this.disabled=true; this.form.submit();"><span>'.__($params['label'], array(), 'sf_admin').'</span></button></li>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li class="action_save_and_add"><button type="submit" name="_save_and_add" class="button classy" onclick="this.disabled=true; this.form.submit();"><span>'.__($params['label'], array(), 'sf_admin').'</span></button></li>';
  }
}
