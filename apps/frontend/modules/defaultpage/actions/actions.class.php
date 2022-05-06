<?php

/**
 * default actions.
 *
 * @package    finance
 * @subpackage defaultpage
 * @author     Jose Ortega
 */
class defaultpageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  /**
   * Error page for page not found (404) error
   *
   */
  public function executeError404()
  {
  }
}
