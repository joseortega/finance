<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author jose
 */
class backupActions extends sfActions
{
  /**
   * Execute index
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
  }
  
  /**
   * Execute backup the database
   * 
   * @param sfWebRequest $request 
   */
  public function executeBackup(sfWebRequest $request)
  {
    $config = Propel::getConfiguration();
    $name = Propel::getDefaultDB();
    
    $conparams = $config['datasources'][$name]['connection'];
    
    $dns = $conparams['dns'];
    $username = $conparams['user'];
    $password = $conparams['password'];
    
//    $dnsdbname = substr($dns, 0, strrpos($dns, ';'));
//    $dbname = substr($dnsdbname, 13);
    
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"finance.sql\"");
    
    $cmd = "mysqldump -u$username -p$password finance";
    passthru($cmd);
    
    exit();
    
    $this->setTemplate('index');
  }
}

?>
