<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sfResizedFile
 *
 * @author jose
 */
class sfResizedFile extends sfValidatedFile
{
  /**
   * Save file
   * 
   * @param type $file
   * @param type $fileMode
   * @param type $create
   * @param type $dirMode
   * @return file 
   */  
  public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777)
  {
    $file = parent::save($file, $fileMode, $create, $dirMode);

    $thumbFile = $this->path.DIRECTORY_SEPARATOR.'thumb_'.$file;
    $thumbnail = new sfThumbnail(100, 100, true, true, 85);
    $thumbnail->loadFile($this->getTempName());
    $thumbnail->save($thumbFile);

    chmod($thumbFile, $fileMode);

    return $file;
  }

}
?>
