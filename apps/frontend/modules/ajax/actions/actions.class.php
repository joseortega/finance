<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxActions
 *
 * @author jose
 */
class ajaxActions extends sfActions
{
  /**
   * Execute ajax for find associate
   * 
   * @param type $request
   * @return type 
   */
  public function executeAjaxAssociates($request)
  {
    $this->getResponse()->setContentType('application/json');

    $associates = AssociatePeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($associates));
  }
  
  /**
   * Execute ajax for find city
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxCity(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $citys = CityPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($citys));
  }
  
  /**
   * Execute ajax for find account
   * 
   * @param type $request
   * @return type 
   */
  public function executeAjaxAccount(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $accounts = AccountPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($accounts));
  }
  
  /**
   * Execute ajax for find credit
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxCredit(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $credits = CreditPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($credits));
  }
  
  /**
   * Execute ajax for find investment
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxInvestment(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $investments = InvestmentPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($investments));
  }
  
  /**
   * Execute ajax for find cash
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxCash(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $cashs = CashPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'), $this->getUser()->getAgency());

    return $this->renderText(json_encode($cashs));
  }
  
  /**
   * Execute ajax for find agency
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxAgency(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $agencies = AgencyPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($agencies));
  }
  
  /**
   * Execute ajax for find Accounting account
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxAccountingAccount(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $agencies = AccountingAccountPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($agencies));
  }
}

?>
