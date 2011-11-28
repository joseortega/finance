<?php

/*
* This file is part of the symfony package.
* (c) Fabien Potencier <fabien.potencier@symfony-project.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

/**
 * Displays plain text inside of a form.
 *
 * Here's an example usage:
 *
 *    $this->setWidget('updated_at',
 *      new sfWidgetFormPlain(array('value'=>$this->getObject()->updated_at)
 *    ));
 *    unset($this->validatorSchema['updated_at']);
 *
 * @package    sfFormExtraPlugin
 * @subpackage widget
 * @author     Joshua <joshua@enradia.com>
 * @author     Stephen Ostrow <contact@stephenostrow.com>
 * @version    SVN: $Id$
 */
class sfWidgetFormPlain extends sfWidgetForm
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * type: The widget type
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
      $this->addOption('value');
  }

/**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $attributes = array_merge(array('class'=>'frozen'), $attributes);

    return $this->renderContentTag('div', $this->getOption('value'), $attributes);
  }
} 