<?php

/**
 * associate_person actions.
 *
 * @package    finance
 * @subpackage associate_person
 * @author     Jose Ortega
 */
class associate_organizationActions extends sfActions
{
  protected $request;
  protected $criteria;

  public function preExecute()
  {
    $this->request = $this->getContext()->getRequest();
    
    parent::preExecute();
  }
 
  /**
   * Execute Organization index
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->category = $this->getCategory();
    $this->categories = $this->getCategories();
    $this->pager = $this->getPager();
  }

  /**
   * Get pager
   * 
   * @return sfPropelPager 
   */
  protected function getPager()
  {
    if(!$this->criteria){
      $this->criteria = new Criteria();
    }
    //add person filter
    $this->criteria->add(AssociatePeer::TYPE, Associate::TYPE_ORGANIZATION);
    
    $pager = new sfPropelPager('Associate',20);
    $pager->setCriteria($this->criteria);
    $pager->setPage($this->request->getParameter('page', 1));
    $pager->setPeerMethod('doSelectJoinCategory');
    $pager->init();

    return $pager;
  }

  /**
   * Execute new associate type organization
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {
    $associate = new Associate();
    $associate->setType(Associate::TYPE_ORGANIZATION);
    
    $this->form = new AssociateForm($associate);
  }

  /**
   * Execute create associate-organization
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $associate = new Associate();
    $associate->setType(Associate::TYPE_ORGANIZATION);
    
    $this->form = new AssociateForm($associate);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Execute edit associate-organization
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    $this->forward404If(!$this->associate->isOrganization());
    $this->form = new AssociateForm($this->associate);
  }

  /**
   * Execute update associate-organization
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    $this->forward404If(!$this->associate->isOrganization());
    $this->form = new AssociateForm($this->associate);

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
      
      $b = $form->getObject()->isNew();
      
      $associate = $form->save();

      $this->getUser()->setFlash('notice', $notice);
      
      if($b){
        $this->redirect('associate_show', $associate);
      }else{
        $this->redirect('associate_organization_edit', $associate);
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  /**
   * Filter by category_id
   * 
   * @param sfWebRequest $request 
   */
  public function executeFilterByCategory(sfWebRequest $request)
  {
    $this->categories = $this->getCategories();
    $this->category = $this->getCategory();
    
    $this->criteria = new Criteria();

    $this->criteria->add(AssociatePeer::CATEGORY_ID, $this->category->getId());
    
    $this->pager = $this->getPager();
    
    $this->setTemplate('index');
  }
  
  /**
   * Execute search associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeSearch(sfWebRequest $request)
  {
     $this->forwardUnless($query = $request->getParameter('query'), 'associate_organization', 'index');
    
    $this->category = $this->getCategory();
    $this->categories = $this->getCategories();
    
    $this->criteria = new Criteria();
    
    $c1 = $this->criteria->getNewCriterion(AssociatePeer::NAME, '%'.$query.'%', Criteria::LIKE);
    $c2 = $this->criteria->getNewCriterion(AssociatePeer::NUMBER, '%'.$query.'%', Criteria::LIKE);
    $c3 = $this->criteria->getNewCriterion(AssociatePeer::IDENTIFICATION, '%'.$query.'%', Criteria::LIKE);
    $c1->addOr($c2);
    $c1->addOr($c3);
    $this->criteria->add($c1);
    $this->criteria->addAscendingOrderByColumn(AssociatePeer::NAME);
    
    $this->pager = $this->getPager();

    $this->setTemplate('index');
  }
  
  /**
   * Return all categories
   * 
   * @return type 
   */
  public function getCategories()
  {
    return CategoryPeer::doSelect(new Criteria());
  }
  
  /**
   * Return the current category
   * 
   * @return Category 
   */
  public function getCategory()
  {
    return CategoryPeer::retrieveByPK($this->request->getParameter('categoryId'));
  }
}
