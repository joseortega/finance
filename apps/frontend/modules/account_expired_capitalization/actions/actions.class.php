<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author jose
 */
class account_expired_capitalizationActions extends sfActions
{
  /**
   * Execute list accounts pending capitalization
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager('Account',20);
    $this->pager->setCriteria(AccountPeer::addCriteriaExpiredCapitalization());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
  
  /**
   * Execute capitalize all accounts
   * 
   * @param sfWebRequest $request 
   */
  public function executeCapitalize(sfWebRequest $request)
  {
    $account = AccountPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($account);
    $this->forward404Unless($account->isCapitalizacionExpired());
    
    $user  = $this->getUser()->getGuardUser();
    $transactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_INTEREST_CAPITALIZATION);
    
    if(!$transactionType){
      $this->getUser()->setFlash('error', 'Account transaction type, not contfiguration.');
      $this->redirect('@account_expired_capitalization', $credit);
    }
    
    try{
      
     $account->capitalizeInterest($user, $transactionType);
      
    }catch(Exception $e){
      
      $this->getUser()->setFlash('error', 'A persistence error occurred.');
    }
    
    $this->getUser()->setFlash('notice', 'The operation was successful.');
    
    $this->redirect('@account_expired_capitalization');
  }
  
  /**
   * Execute capitalize all accounts
   * 
   * @param sfWebRequest $request 
   */
  public function executeAllCapitalize(sfWebRequest $request)
  {
    $user  = $this->getUser()->getGuardUser();
    $cptTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_INTEREST_CAPITALIZATION);
    
    if(!$cptTransactionType){
      $this->getUser()->setFlash('error', 'Account transaction type, not contfiguration.');
      $this->redirect('@account_expired_capitalization', $credit);
    }
    
    try{
      
      $accounts = AccountPeer::doSelectExpiredCapitalization();
      
      foreach ($accounts as $account){
        $account->capitalizeInterest($user, $cptTransactionType);
      }
      
    }catch(Exception $e){
      
      $this->getUser()->setFlash('error', 'A persistence error occurred.');
    }
    
    $this->getUser()->setFlash('notice', 'The operation was successful.');
    
    $this->redirect('@account_expired_capitalization');
  }
}

?>
