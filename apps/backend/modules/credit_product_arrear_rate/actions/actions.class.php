<?php

/**
 * account_product_interest_rate actions.
 *
 * @package    finance
 * @subpackage account_product_interest_rate
 * @author     Jose Ortega
 */
class credit_product_arrear_rateActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $criteria = new Criteria();
    $criteria->add(CreditProductArrearRatePeer::PRODUCT_ID, $this->product->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(CreditProductArrearRatePeer::RATE_UNIQUE_ID);

    $this->pager = new sfPropelPager('CreditProductArrearRate',12);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $this->form = new CreditProductEmbedArrearRateForm($this->product);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $this->form = new CreditProductEmbedArrearRateForm($this->product);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = 'The item was updated successfully.';
      
      $product = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('credit_product_arrear_rate', $product);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
