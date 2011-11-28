<?php

/**
 * associate_person actions.
 *
 * @package    finance
 * @subpackage associate
 * @author     Jose Ortega
 */
class associateActions extends sfActions
{
  /**
   * Associate index
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    //defaul search
    $this->associates = array();
  }

  /**
   * Execute show associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    $this->forward404If(!$this->associate->isPerson() && !$this->associate->isOrganization());
  }
  
  /**
   * Execute delete associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($associate = AssociatePeer::retrieveByPk($request->getParameter('id')), sprintf('Object associate does not exist (%s).', $request->getParameter('id')));
    $associate->delete();

    $this->redirect('@associate_person');
  }
  
  /**
   * Execute search associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'associate', 'index');

    if ($request->isXmlHttpRequest()){
      
      $size = strlen($query);
    
      if($size > 1){
        $query = substr_replace($query, '', $size-1);
      }
      
      $this->associates = AssociatePeer::getForLuceneQuery($query, 30);
      
      if ('*' == $query || !$this->associates){
        
        return $this->renderText('No results.');
      }
      
      return $this->renderPartial('associate/list', array('associates' => $this->associates));
      
    }else{
      
      $this->associates = AssociatePeer::getForLuceneQuery($query, 30);
    }

    $this->setTemplate('index');
  }
}
