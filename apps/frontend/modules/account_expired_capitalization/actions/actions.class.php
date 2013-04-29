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
  private $transactionType = null;
  private $user = null;

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
    
    $this->user  = $this->getUser()->getGuardUser();
    $this->transactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_INTEREST_CAPITALIZATION);
    
    if(!$this->transactionType){
      $this->getUser()->setFlash('error', 'Account transaction type, not contfiguration.');
      $this->redirect('@account_expired_capitalization', $credit);
    }
    
    try{
      
     $this->capitalizeInterest($account);
      
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
    $this->user  = $this->getUser()->getGuardUser();
    $this->transactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_INTEREST_CAPITALIZATION);
    
    if(!$this->transactionType){
      $this->getUser()->setFlash('error', 'Account transaction type, not contfiguration.');
      $this->redirect('@account_expired_capitalization', $credit);
    }
    
    try{
      
      $accounts = AccountPeer::doSelectExpiredCapitalization();
      
      foreach ($accounts as $account){
        $this->capitalizeInterest($account);
      }
      
    }catch(Exception $e){
      
      $this->getUser()->setFlash('error', 'A persistence error occurred.');
    }
    
    $this->getUser()->setFlash('notice', 'The operation was successful.');
    
    $this->redirect('@account_expired_capitalization');
  }
  
  /**
   * Capitalize interest
   * 
   * @param Cash $connection
   * @param sfGuardUser $user
   * @param TransactionType $actTransactionType
   * @param PropelPDO $con 
   */
  private function capitalizeInterest(Account $account, PropelPDO $con = null)
  {
    if($con == null){
      $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
    
    $amount = $account->getInterestAccumulated();
    
    $con->beginTransaction();
    try
    {      
      $accountTransaction = new Transaction($this->user, $this->transactionType, $amount);
      $accountTransaction->setAccount($account);
      $accountTransaction->save($con);
     
      $account->accredit($amount, $con);
      
      $accountTransaction->updateAccountBalance($account->getBalance(), $con);
      
      $account->setLastCapitalization(time());
      $account->updateNextCapitalization($con);
      $account->save($con);
      
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }
}

?>
