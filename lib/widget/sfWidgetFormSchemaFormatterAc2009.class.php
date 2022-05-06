<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sfWidgetFormSchemaFormatterAc2009
 *
 * @author claudio
 */
class sfWidgetFormSchemaFormatterAc2009 extends sfWidgetFormSchemaFormatter
{
  protected
  $rowFormat       = "<div class=\"form_row%row_class%\">
                      %error%<div class=\"clear_fix\">\n%label%\n<div class=\"content\">%field%%help%</div></div>
                      %hidden_fields%\n</div>\n",
  $errorRowFormat  = "<div>%errors%</div>",
  $helpFormat      = '<div class="help">%help%</div>',
  $decoratorFormat = "<div>\n%content%</div>";

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
      $row = parent::formatRow(
        $label,
        $field,
        $errors,
        $help,
        $hiddenFields
      );

      return strtr($row, array(
        '%row_class%' => (count($errors) > 0) ? ' errors' : '',
      ));
  }
}
?>
