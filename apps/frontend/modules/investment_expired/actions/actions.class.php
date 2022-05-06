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
  private $invTransactionTypeTransf;
  private $actTransactionTypeTransf;
  private $invTransactionTypeCapt;
  private $invTransactionTypeWith;


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
    
    $errors = $this->validateTransacctionTypesRequiredForRepay();
    
    if(count($errors) >= 1){
      
      $this->getUser()->setFlash('errors', $errors);
      $this->redirect('investment_show', $investment);
    }
    
    $user  = $this->getUser()->getGuardUser();
    
    $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
 
    $con->beginTransaction();
    
    try
    {    
      $investment->interestCapitalization($user, $this->invTransactionTypeCapt, $con);
      $investment->withholdingTax($user, $this->invTransactionTypeWith, $con);
      $investment->accreditToAccount($user, $this->invTransactionTypeTransf, $this->actTransactionTypeTransf, $con);
      
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
    $errors = $this->validateTransacctionTypesRequiredForRepay();
    
    if(count($errors) >= 1){
      
      $this->getUser()->setFlash('errors', $errors);
      $this->redirect('@investment_expired');
    }
    
    $user  = $this->getUser()->getGuardUser();
    
    $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
 
    $con->beginTransaction();
    
    try
    {
      foreach (InvestmentPeer::doSelectCurrentsExpired() as $investment){
        
        $investment->interestCapitalization($user, $this->invTransactionTypeCapt, $con);
        $investment->withholdingTax($user, $this->invTransactionTypeWith, $con);
        $investment->accreditToAccount($user, $this->invTransactionTypeTransf, $this->actTransactionTypeTransf, $con);
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
  
  /**
   * 
   */
  private function validateTransacctionTypesRequiredForRepay()
  {
    $errors = array();
    
    //get investment transaction type
    $this->invTransactionTypeTransf = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_TRANSFER_TO_ACCOUNT);
    
    if(!$this->invTransactionTypeTransf){
      $errors[] = 'Investment-Transaction type: Transfer to Account is not configured, Admin.'; 
    }
    
    //get Account transaction type
    $this->actTransactionTypeTransf = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_TRANSFER_FROM_INVESTMENT);
    
    if(!$this->actTransactionTypeTransf){
      $errors[] = 'Account-Transaction type: Expiry of Investment is not configured, Admin.';
    }
    
    //get investment transaction type
    $this->invTransactionTypeCapt = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_INTEREST_CAPITALIZATION);
    
    if(!$this->invTransactionTypeCapt){
      $errors[] = 'Investment-Transaction type: Interest Capitalization is not configured, Admin.';
    }
    
    //get investment transaction type
    $this->invTransactionTypeWith = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_WITHHOLDING_TAX);
    
    if(!$this->invTransactionTypeWith){
      $errors[] = 'Investment-Transaction type: Withholding Tax is not configured, Admin.';
    }
    
    return $errors;
  }
}
