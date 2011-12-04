<?php

/**
 * investment_expired actions.
 *
 * @package    finance
 * @subpackage investment_expired
 * @author     Jose Ortega
 */
class investment_expiredActions extends sfActions
{
  /**
   * Execute list investment-expired
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager('Investment',20);
    $this->pager->setCriteria(InvestmentPeer::addCriteriaExpired());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
  
   /**
   * Execute repay investment
   * 
   * @param sfWebRequest $request 
   */
  public function executeRepay(sfWebRequest $request)
  {
    $investment = InvestmentPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($investment);
    $this->forward404If(!$investment->isExpired());

     //get investment transaction type
    $invTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_TRANSFER_TO_ACCOUNT);
    
    if(!$invTransactionType){
      $this->getUser()->setFlash('error', 'Investment: Transaction type is not configured, Admin.');
      $this->redirect('investment_show', $investment);
    }
    
    //get Account transaction type
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_TRANSFER_FROM_INVESTMENT);
    
    if(!$actTransactionType){
      $this->getUser()->setFlash('error', 'Account: Transaction type is not configured, Admin.');
      $this->redirect('investment_show', $investment);
    }
    
    //get investment transaction type
    $invTransactionTypeCapt = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_INTEREST_CAPITALIZATION);
    
    if(!$invTransactionTypeCapt){
      $this->getUser()->setFlash('error', 'Investment: Transaction type is not configured, Admin.');
      $this->redirect('investment_show', $investment);
    }
    
    //get investment transaction type
    $invTransactionTypeWith = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_WITHHOLDING_TAX);
    
    if(!$invTransactionTypeWith){
      $this->getUser()->setFlash('error', 'Investment: Transaction type is not configured, Admin.');
      $this->redirect('investment_show', $investment);
    }
    
    $user  = $this->getUser()->getGuardUser();
    

    $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
 
   
    $con->beginTransaction();
    
    try
    {    
      $investment->interestCapitalization($user, $invTransactionTypeCapt, $con);
      $investment->withholdingTax($user, $invTransactionTypeWith, $con);
      $investment->accreditToAccount($user, $invTransactionType, $actTransactionType, $con);
      
      $con->commit();
    }
    
    catch (Exception $e)
    {
      $con->rollBack();
      
      $this->getUser()->setFlash('error', 'A persistence error occurred.');
      $this->redirect('investment_show', $investment);
    }
     $this->getUser()->setFlash('notice', 'Was executed successfully.');
     $this->redirect('investment_show', $investment);  
  }
  
  /**
   * Execute all repay
   * 
   * @param sfWebRequest $request 
   */
  public function executeAllRepay(sfWebRequest $request)
  {
    //get investment transaction type
    $invTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_TRANSFER_TO_ACCOUNT);
    
    if(!$invTransactionType){
      $this->getUser()->setFlash('error', 'Investment: Transaction type is not configured, Admin.');
      $this->redirect('@investment_expired');
    }
    
    //get Account transaction type
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_TRANSFER_FROM_INVESTMENT);
    
    if(!$actTransactionType){
      $this->getUser()->setFlash('error', 'Account: Transaction type is not configured, Admin.');
      $this->redirect('@investment_expired');
    }
    
    //get investment transaction type
    $invTransactionTypeCapt = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_INTEREST_CAPITALIZATION);
    
    if(!$invTransactionTypeCapt){
      $this->getUser()->setFlash('error', 'Investment: Transaction type is not configured, Admin.');
      $this->redirect('@investment_expired');
    }
    
    //get investment transaction type
    $invTransactionTypeWith = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_WITHHOLDING_TAX);
    
    if(!$invTransactionTypeWith){
      $this->getUser()->setFlash('error', 'Investment: Transaction type is not configured, Admin.');
      $this->redirect('@investment_expired');
    }
    
    $user  = $this->getUser()->getGuardUser();
    

    $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
 
   
    $con->beginTransaction();
    
    try
    {
      foreach (InvestmentPeer::doSelectCurrentsExpired() as $investment){
        
        $investment->interestCapitalization($user, $invTransactionTypeCapt, $con);
        $investment->withholdingTax($user, $invTransactionTypeWith, $con);
        $investment->accreditToAccount($user, $invTransactionType, $actTransactionType, $con);
      }

      $con->commit();
    }
    
    catch (Exception $e)
    {
      $con->rollBack();
      
      $this->getUser()->setFlash('error', 'A persistence error occurred.');
      $this->redirect('@investment_expired');
    }
    
     $this->getUser()->setFlash('notice', 'Was executed successfully.');
     $this->redirect('@investment_expired');
  }
}
