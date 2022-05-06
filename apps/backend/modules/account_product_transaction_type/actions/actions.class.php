<?php

/**
 * account_product_transaction_type_other actions.
 *
 * @package    fynance
 * @subpackage account_product_transaction_type_other
 * @author     Your name here
 */
class account_product_transaction_typeActions extends sfActions
{
  public function executeEdit(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $this->form = new AccountProductEmbedTransactionTypeForm($this->product);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    
    $this->form = new AccountProductEmbedTransactionTypeForm($this->product);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $product = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('account_product_transaction_type/edit?id='.$product->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false); 
    }
  }
}
