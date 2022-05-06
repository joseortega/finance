<?php

/**
 * investment_investment_product_interest_rate actions.
 *
 * @package    finance
 * @subpackage investment_investment_product_interest_rate
 * @author     Jose Ortega
 */
class investment_product_interest_rateActions extends sfActions
{
  public function executeEdit(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $this->form = new InvestmentProductEmbedRateTermForm($this->product);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $this->form = new InvestmentProductEmbedRateTermForm($this->product);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){    
      $product = $form->save();
      
      $this->getUser()->setFlash('notice', 'The item was updated successfully.');

      $this->redirect('investment_product_interest_rate_edit', $product);
      
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeAddRate(sfRequest $request)
  {
    $this->forward404unless($request->isXmlHttpRequest());
    $key = intval($request->getParameter("key"));

    $product = InvestmentProductPeer::retrieveByPk($request->getParameter('id'));
    
    $this->forward404unless($product);

    $form = new InvestmentProductEmbedRateTermForm($product);

    $form->addRateTerm($key);

    return $this->renderPartial('addRate',array('form' => $form, 'key' => $key));
  }
}
