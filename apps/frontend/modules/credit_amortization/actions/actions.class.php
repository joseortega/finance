<?php

/**
 * credit_amortization actions.
 *
 * @package    finance
 * @subpackage credit_amortization
 * @author     Jose Ortega
 */
class credit_amortizationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $criteria = new Criteria();
    $criteria->add(PaymentPeer::CREDIT_ID, $this->credit->getId(), Criteria::EQUAL);

    $this->pager = new sfPropelPager('Payment',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * Execute print pdf
   * 
   * @param sfWebRequest $request 
   */
  public function  executePdf(sfWebRequest $request)
  {
    $credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $pdf = Document::pdfAmortizationTable($credit, $this->getUser()->getCulture());
            
    $pdf->Output();

    exit();

    $this->setLayout(false);
  }

}
