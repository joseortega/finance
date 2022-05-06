<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssociateContactForm
 *
 * @author jose
 */
class ContactForm extends BaseAssociateForm{
  
  private  $markForDeletionPhones = array();

  public function  configure() {
        parent::configure();

        $this->useFields(array('city_current_id', 'city_hometown_id', 'address', 'neighborhood', 'website'));
        
         
        $this->widgetSchema['city_hometown_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
        $this->widgetSchema['city_hometown_id']->setOption('renderer_options', array(
           'model' => 'City',
           'url'   => sfContext::getInstance()->getController()->genUrl('associate_contact/ajaxCity'),
        ));

        $this->widgetSchema['city_current_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
        $this->widgetSchema['city_current_id']->setOption('renderer_options', array(
          'model' => 'City',
          'url'   => sfContext::getInstance()->getController()->genUrl('associate_contact/ajaxCity'),
        ));

        //embed phones

        $phones = $this->getObject()->getPhones();

        if(!$phones){
            
          $phone = new Phone();
          $phone->setAssociate($this->getObject());

          $phones = array($phone); 
        }

        $forms = new sfForm();

        foreach ($phones as $key=>$phone){

            $phoneForm = new PhoneForm($phone); 
            $forms->embedForm($key, $phoneForm);
        }

        $this->embedForm('phones', $forms);
        
        $this->mergePostValidator(new AssociatePhonesValidatorSchema());
    }
    
    public function addPhone($key){

        $phone = new Phone();
        $phone->setAssociate($this->getObject());

        $phoneForm = new PhoneForm($phone);

        $this->embeddedForms['phones']->embedForm($key, $phoneForm);

        $this->embedForm('phones', $this->embeddedForms['phones']);
    }

    /**
     * @see sfForm
     */

    public function bind(array $taintedValues = null, array $taintedFiles = null){

        foreach($taintedValues['phones'] as $key=>$newPhone){

            if (!isset($this['phones'][$key])){
                
                if(!in_array($newPhone['number'], array(null, '', array()), true) && !PhonePeer::retrieveByPK($newPhone['id'])){
             
                    $this->addPhone($key);
                }
            }
            
            if(!($newPhone['number']) && PhonePeer::retrieveByPK($newPhone['id'])){
                  $this->markForDeletionPhones[$key] = $newPhone['id'];
              }
            
            if(!($newPhone['number']) && !PhonePeer::retrieveByPK($newPhone['id'])){
                  unset($taintedValues['phones'][$key]);
                  unset($this->embeddedForms['phones'][$key]);
                  
            }
        }    

        parent::bind($taintedValues, $taintedFiles);
    }

    /**
     * @see sfFormPropel
     */

    public function  doUpdateObject($values) {

        if (count($this->markForDeletionPhones)){

          foreach ($this->markForDeletionPhones as $index => $id){

            unset($values['phones'][$index]);
            unset($this->embeddedForms['phones'][$index]);

            PhonePeer::retrieveByPK($id)->delete();
            
          }
        }

        parent::doUpdateObject($values);
    }
}
?>
