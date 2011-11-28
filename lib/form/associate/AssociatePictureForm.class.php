<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssociatePictureForm
 *
 * @author jose
 */
class AssociatePictureForm extends BaseAssociateForm{

    public function  configure() {
        parent::configure();

        $this->useFields(array('picture'));
        
        if(!$this->getObject()->getPicture()){
          $this->widgetSchema['picture'] = new sfWidgetFormInputFileEditable(array(
            'label'     => 'Picture',
            'file_src'  => '/images/avatar/avatar_medium.jpg',
            'is_image'  => true,
            'edit_mode' => !$this->isNew(),
            'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
          ));
          
        }else{
          
          $this->widgetSchema['picture'] = new sfWidgetFormInputFileEditable(array(
            'label'     => 'Picture',
            'file_src'  => '/uploads/pictures/thumb_'.$this->getObject()->getPicture(),
            'is_image'  => true,
            'edit_mode' => !$this->isNew(),
            'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
          ));
        }

        

        $this->setValidator('picture', new sfValidatorFile(array(
            'mime_types' => 'web_images',
            'path' => sfConfig::get('sf_upload_dir').'/pictures',
            'required' => false,
            'validated_file_class' => 'sfResizedFile',
     )));

        $this->validatorSchema['picture_delete'] = new sfValidatorPass();
    }
}
?>
