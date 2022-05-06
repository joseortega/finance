<?php

/**
 * associate_organization actions.
 *
 * @package    finance
 * @subpackage associate_organization
 * @author     Jose Ortega
 */
class associate_organizationActions extends sfActions
{
  protected $request;
  protected $criteria = null;

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
    $this->buildCriteria();

    $pager = new sfPropelPager('Associate',20);
    $pager->setCriteria($this->criteria);
    $pager->setPage($this->getPage());
    $pager->setPeerMethod('doSelectJoinCategory');
    $pager->init();

    return $pager;
  }
  
  /**
   * build criteria
   */
  public function buildCriteria()
  {
    if($this->criteria == null){
      $this->criteria = new Criteria();
    }
    //type organization
    $this->criteria->add(AssociatePeer::TYPE, Associate::TYPE_ORGANIZATION);
    
    //by category
    if($this->getCategory()){
      $this->criteria->add(AssociatePeer::CATEGORY_ID, $this->getCategory()->getId());
    }
    
    //by query
    if($query = $this->request->getParameter('query')){
      $c1 = $this->criteria->getNewCriterion(AssociatePeer::NAME, '%'.$query.'%', Criteria::LIKE);
      $c2 = $this->criteria->getNewCriterion(AssociatePeer::NUMBER, '%'.$query.'%', Criteria::LIKE);
      $c3 = $this->criteria->getNewCriterion(AssociatePeer::IDENTIFICATION, '%'.$query.'%', Criteria::LIKE);
      $c1->addOr($c2);
      $c1->addOr($c3);
      $this->criteria->add($c1);
    }
    
    //order by
    $this->criteria->addDescendingOrderByColumn(AssociatePeer::UPDATED_AT);
    $this->criteria->addAscendingOrderByColumn(AssociatePeer::NAME);
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

    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

    if ($this->form->isValid()){
      
      $associate = $this->form->updateObject();  
      
      $con = Propel::getConnection(AssociatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
      $con->beginTransaction();
      
      try{
          $associate->setNumber(AssociatePeer::generateNumber($con));
          $associate->save();
          
          $con->commit();
          
      }  catch (Exception $e){
          
          $con->rollBack();
          $this->getUser()->setFlash('error', 'A persistence error occurred.');
      }

      $this->getUser()->setFlash('notice', 'The item was created successfully.');
      
      $this->redirect('associate_show', $associate);
      
    }else{
      
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }

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

    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    
    if ($this->form->isValid()){
                  
      $this->associate = $this->form->save();

      $this->getUser()->setFlash('notice', 'The item was updated successfully.');
      
      $this->redirect('associate_organization_edit', $this->associate);
      
    }else{
      
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }

    $this->setTemplate('edit');
  }
  
  /**
   * Print list in pdf
   * 
   * @param sfWebRequest $request 
   */
  public function executePrintInPdf(sfWebRequest $request)
  {
    $this->buildCriteria();
    
    $associates = AssociatePeer::doSelect($this->criteria);
   
    $pdf = Document::pdfAssociates($associates, $this->getUser()->getCulture());
    
    $pdf->Output();

    exit();

    $this->setLayout(false);
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
  
  /**
   * Return the page
   * 
   * @return int
   */
  public function getPage()
  {
    return $this->request->getParameter('page', 1);
  }
}
