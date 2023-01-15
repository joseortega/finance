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
  public function executeAjaxProvince(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $provinces = ProvincePeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($provinces));
  }
  
  public function executeAjaxAccountingAccount(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $provinces = AccountingAccountPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($provinces));
  }
}

?>
