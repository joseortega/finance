<?php

/**
 * credit_current actions.
 *
 * @package    fynance
 * @subpackage credit_current
 * @author     Your name here
 */
class creditActions extends sfActions
{
  /**
   * Execute index credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
  }

  /**
   * Execute filter
   * 
   * @param sfWebRequest $request 
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@credit');
    }
    
    $this->filters = new CreditFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@credit');
    }

    $this->pager = $this->getPager();

    $this->setTemplate('index');
  }

  /**
   * Get pager
   * 
   * @return sfPropelPager 
   */
  protected function getPager()
  {
    $pager = new sfPropelPager('Credit',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod('doSelectJoinAll');
    $pager->init();

    return $pager;
  }

  /**
   * Build criteria
   * 
   * @return type 
   */
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new CreditFormFilter($this->getFilters(), array(
          'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
      ));
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());

    $criteria->addDescendingOrderByColumn(CreditPeer::UPDATED_AT);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    $this->forward404Unless($this->credit);
  }

  /**
   * Execute new credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {    
    $credit = new Credit();
    
    if($request->getParameter('id')){
      
      $associate = AssociatePeer::retrieveByPK($request->getParameter('id'));
      $credit->setAssociate($associate);
    }
    
    $this->form = new CreditForm($credit, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'), 
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'))
    );
  }

  /**
   * Execute create credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $credit = new Credit();

    $this->form = new CreditForm($credit, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'), 
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'))
    );

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Execute edit credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404Unless($this->credit->isInRequest());
    
    $this->form = new CreditForm($this->credit, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'), 
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'))
    );
  }

  /**
   * Execute update credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404Unless($this->credit->isInRequest());
    
    $this->form = new CreditForm($this->credit, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'), 
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'))
    );

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * Process form
   * 
   * @param sfWebRequest $request
   * @param sfForm $form 
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $redirectAction = $form->getObject()->isNew() ? 'show' : 'edit';
      
      $credit = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);
      
      $this->redirect('credit/'.$redirectAction.'?id='.$credit->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  /**
   * Get filters
   * 
   * @return array 
   */
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('credit.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   *  
   * @param array $filters 
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('credit.filters', $filters);
  }

  /**
   * Get filters defaults
   * 
   * @return array 
   */
  public function getFilterDefaults()
  {
    $filters = $this->getUser()->getAttribute('credit.filters');
    
    if(!$filters['status']){
      $filters = array('status' => Credit::STATUS_CURRENT);
      $this->getUser()->setAttribute('credit.filters', $filters);
    }else{
      $filters = array('status' => $filters['status']);
    }
    
    return $filters;
  }

  /**
   * Set page
   * 
   * @param int $page 
   */
  protected function setPage($page)
  {
    $this->getUser()->setAttribute('credit.page', $page);
  }
  
  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('credit.page', 1);
  }
  
  /**
   * Filter by credit status
   * 
   * @param sfWebRequest $request 
   */
  public function executeStatusFilter(sfWebRequest $request)
  {
    $filters = array();
     
    $filters['status'] = $request->getParameter('status');
     
    $this->setFilters($filters);
    
    $this->redirect($this->generateUrl('credit'));
  }
  
  /**
   * Execute disburse credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeDisburse(sfWebRequest $request)
  {
    $credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($credit);
    
    $this->forward404If(!$credit->isApproved());

    $user  = $this->getUser()->getGuardUser();

    $cdtTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::CREDIT_DISBURSEMENT_ACCOUNT);
    
    if(!$cdtTransactionType){
      $this->getUser()->setFlash('error', 'Credit transaction type, not contfiguration.');
      $this->redirect('credit_show', $credit);
    }
    
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_DISBURSEMENT_CREDIT);   
    if(!$actTransactionType){
      $this->getUser()->setFlash('error', 'Account transaction type, not contfiguration.');
      $this->redirect('credit_show', $credit);
    }
    
    try{
      $credit->disbursement($user, $cdtTransactionType, $actTransactionType);
    }catch (Exception $e){
      $this->getUser()->setFlash('Error', 'Persistence error.');
      $this->redirect('credit_show', $credit);
    }

    $this->getUser()->setFlash('notice', 'Se ha ejecutado el desembolso.');
    
    $this->redirect('credit_show', $credit);
  }
  
  /**
   * Execute approve credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeApprove(sfWebRequest $request)
  {    
    $credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($credit);
    
    $this->forward404If(!$credit->isInRequest());
    
    $transactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::CREDIT_APPROVAL);
    
    if(!$transactionType){
      $this->getUser()->setFlash('error', 'Credit: Transaction type no configuration, Admin');
      $this->redirect('credit_show', $credit);
    }
    
    $interesRates = $credit->getProduct()->getArrearRates();
    
    if(!$interesRates){
      $this->getUser()->setFlash('error', 'The interest rate not configured.');
      $this->redirect('credit_show', $credit);
    }
    
    $user = $this->getUser()->getGuardUser();
    
    if($credit->isInRequest()){

      $con = Propel::getConnection(CreditPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);

      $con->beginTransaction();
      try
      {
        
        $transaction = new Transaction($user, $transactionType, $credit->getAmount());
        $transaction->save($con);
      
        $creditTransaction = new CreditTransaction($transaction, $credit);
        $creditTransaction->save($con);

        $credit->setStatus(Credit::STATUS_APPROVED);
        $credit->setInterestRate($credit->getProduct()->getInterestRateCurrent()->getValue());
        
        if($credit->getAmortizationType() == 'french'){
           $this->generateAmortizationTableMethodFrench($credit);
        }else{
           $this->generateAmortizationTableMethodGerman($credit);
        }
        
        $credit->save($con);

        $con->commit();

      }
      catch (Exception $e)
      {
        $con->rollBack();
        throw $e;
      }
      
      $this->getUser()->setFlash('notice', 'The credit was passed successfully.');
    }
    
    $this->redirect('credit_show', $credit);
   }
  
 /**
  * Execute annul credit
  * 
  * @param sfWebRequest $request 
  */
  public function executeAnnul(sfWebRequest $request)
  {
    $credit = CreditPeer::retrieveByPK($request->getParameter('id'));

    $this->forward404Unless($credit);
    $this->forward404If(!$credit->isInRequest());

    if($credit->isInRequest()){
      $credit->setStatus(Credit::STATUS_ANNULLED);
      $credit->save();
      $this->getUser()->setFlash('notice', 'The credit was canceled successfully.');
    }

    $this->redirect('credit_show', $credit);
  }
  
  /**
   * Execute delete
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($credit = CreditPeer::retrieveByPk($request->getParameter('id')), sprintf('Object credit does not exist (%s).', $request->getParameter('id')));
    
    $this->forward404If(!$credit->isAnnulled());
    
    try 
    {
      $credit->delete();
    }  
    catch (Exception $e)
    {
      $con->rollBack();
      $this->getUser()->setFlash('notice', 'A persistence error occurred.');
    }
    
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    
    $this->redirect('@credit');
  }
  
  /**
   * Generate amortization table with method french
   * 
   * @param Credit $credit 
   */
  protected function generateAmortizationTableMethodFrench(Credit $credit)
  {
    //Basic data
    $amount = $credit->getAmount();
    $payFrequencyInMonths = $credit->getPayFrequencyInMonths();
    $annualinterestRate = $credit->getInterestRate();
    $timeInMonths = $credit->getTimeInMonths();

    //To calculate the interest according to the frequency of payments in months
    $rate = $annualinterestRate/(12/$payFrequencyInMonths);
    $time = $timeInMonths/($payFrequencyInMonths);

    //calculate fee: (amount*rate)/(100*(1-(1+rate/100)^-time))
    $total = round(($amount*$rate)/(100*(1-pow(1+$rate/100,-$time))), 2);
    
    $amountPending = $amount;
    
    $numberPayments = $timeInMonths/$payFrequencyInMonths;

    $count = $payFrequencyInMonths;

    for($i=0;$i<($timeInMonths/$payFrequencyInMonths);$i++){

      $payment = new Payment();
      
      $numberPayment = $i+1;
      
      //calculate interest
      $interest = round($amountPending * ($rate/100), 2);
      
      if($numberPayment == $numberPayments){
        
        $capital = $amountPending;
        $total = $capital + $interest;
        
      }else{
        //calculate capital
        $capital = $total - $interest;
      }
      
      //calculate balance
      $balance = $amountPending - $capital;
      
      $nextMonth  = mktime(0, 0, 0, date("m")+($count), date("d"),   date("Y"));

      $count = $count +$payFrequencyInMonths;
      
      $payment->setNumber($numberPayment);
      $payment->setDate($nextMonth);
      $payment->setCreditId($credit->getId());
      $payment->setBalance($balance);
      $payment->setInterest($interest);
      $payment->setCapital($capital);
      $payment->setStatus(Payment::STATUS_UNPAID);

      $payment->save();
      
      $amountPending = $balance;
    }
  }
  
  /**
   * Generate amortization table with method german
   * 
   * @param Credit $credit 
   */
  public function generateAmortizationTableMethodGerman(Credit $credit)
  {
    //Basic data
    $amount = $credit->getAmount();
    $payFrequencyInMonths = $credit->getPayFrequencyInMonths();
    $annualinterestRate = $credit->getInterestRate();
    $timeInMonths = $credit->getTimeInMonths();

    //To calculate the interest according to the frequency of payments in months
    $rate = $annualinterestRate/(12/$payFrequencyInMonths);
    $time = $timeInMonths/($payFrequencyInMonths);

    $numberPayments = $timeInMonths/$payFrequencyInMonths;
    
    //calculate capital
    $capital = round($amount/$numberPayments, 2);
    $amountPending = $amount;
    
    $count = $payFrequencyInMonths;

    for($i=0;$i<($timeInMonths/$payFrequencyInMonths);$i++){

      $numberPayment = $i+1;
      
      if($numberPayment == $numberPayments){
        //calculate last capital
        $capital = round($amount - ($numberPayments - 1) *  $capital, 2);
      }
      
      $payment = new Payment();

      //calculate interest
      $interest = round(($amount - (($numberPayment - 1) * $capital)) * ($rate/100), 2);
      //calculate balance
      $balance = $amountPending - $capital;
      $nextMonth  = mktime(0, 0, 0, date("m")+($count), date("d"),   date("Y"));

      $count = $count + $payFrequencyInMonths;
      
      $payment->setNumber($numberPayment);
      $payment->setDate($nextMonth);
      $payment->setCredit($credit);
      $payment->setBalance($balance);
      $payment->setInterest($interest);
      $payment->setCapital($capital);
      $payment->setStatus(Payment::STATUS_UNPAID);

      $payment->save();
      
      $amountPending = $balance;
    }
  }
}
