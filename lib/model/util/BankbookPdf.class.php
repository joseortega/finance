<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BankbookPdf
 *
 * @author jose
 */
class BankbookPdf 
{  
  const pageOrientation = 'P';
  
  const pageUnit = 'mm';
  
  const fontSize = 7;
  
  const fontFamily = 'Arial';
  
  const fontStyle ='';

  const w = 28;
  
  const h = 4;
  
  //space header logo
  const spaceHeaderlogo = 24;
    
  //space header content
  const spaceHeaderContent = 23;
    
  //margin content header
  const marginTopContent = 17;
    
   //space table header
  const spaceTableHeader = 10;
  
  const rowsByPage = 30;
  
  /**
   *
   * @return FPDF 
   */
  public static function buildBasic() 
  {
    $pdf = new FPDF(self::pageOrientation, self::pageUnit);
    
    $pdf->SetMargins(0, 0, 0);
    
    $pdf->SetAutoPageBreak(true, 10);
//    $pdf->AddPage();

    $pdf->SetFont(self::fontFamily, self::fontStyle,  self::fontSize);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    return $pdf;
  }
  
  /**
   *
   * @param Bankbook $bankbook
   * @param FPDF $pdf
   * @param Agency $agency
   * @return FPDF 
   */
  public static function buildHeader(Bankbook $bankbook, FPDF $pdf, Agency $agency = null) 
  {
    $pdf->SetFont(self::fontFamily, 'B',  self::fontSize);
    
    if($agency){
      //data
      $pdf->Cell(100, 7,'',0,0,'L');
      $pdf->Cell(self::w, 7,$agency->getName(),0,1,'L');
    }else{
      
      $pdf->Cell(self::w, 7,'',0,0,'L');
      $pdf->Cell(self::w, 7,'',0,1,'L');
    }
    //space
    $pdf->Cell(self::w, 2,'',0,1,'L');
    
    //data
    $pdf->Cell(self::w, 7,'',0,0,'L');
    $pdf->Cell(self::w, 7,$bankbook->getAccount()->getAssociate(),0,1,'L');
    
    $pdf->Cell(self::w, 7,'',0,0,'L');
    $pdf->Cell(self::w, 7,$bankbook->getAccount()->getNumber(),0,0,'L');
    
    $pdf->Cell(20, 7, 'Lib.id',0,0,'L');
    $pdf->Cell(self::w, 7,$bankbook->getId(),0,1,'L');

    if(!$bankbook->getWasPrintedHeader()){
      $bankbook->setWasPrintedHeader(true);
      $bankbook->save(); 
    }
    
    // set default font
    $pdf->SetFont(self::fontFamily, self::fontStyle,  self::fontSize);
    
    return $pdf;
  }
  
  /**
   *
   * @param Bankbook $bankbook
   * @param FPDF $pdf
   * @return FPDF 
   */
  public static function buildContent(Bankbook $bankbook, FPDF $pdf) 
  {
    $transactions = $bankbook->getAccountTransactions();
    
    //print table content
    foreach ($transactions as $key=>$transaction){
      
      $pdf->Cell(self::w, self::h, $transaction->getCreatedAt('Y-m-d'),0,0,'C',1);
      $pdf->Cell(self::w, self::h, $transaction->getTransactionType()->getInitials(),0,0,'C',1);
      
      if($transaction->isCredit()){
        $pdf->Cell(self::w, self::h, $transaction->getAmount(),0,0,'C',1);
        $pdf->Cell(self::w, self::h, '',0,0,'R',1);
      }else{
        $pdf->Cell(self::w, self::h, '',0,0,'R',1);
        $pdf->Cell(self::w, self::h, $transaction->getAmount(),0,0,'C',1);
      }
      
      $pdf->Cell(self::w, self::h, $transaction->getAccountBalance(),0,1,'C',1);

      if(self::rowsByPage==$key+1){
        $pdf->AddPage();
        $pdf->Ln(self::spaceHeaderlogo);
        $pdf->Ln(self::spaceHeaderContent);
        $pdf->ln(self::marginTopContent);
        $pdf->Ln(self::spaceTableHeader);
      }
    }
    
    return $pdf;
  }
  
  /**
   *
   * @param Bankbook $bankbook
   * @param Agency $agency
   * @return type 
   */
  public static function pdfHeader(Bankbook $bankbook, Agency $agency = null) 
  {
    $pdf = self::buildBasic();
    
    $pdf->AddPage();
    
   //print space header logo   
    $pdf->Ln(self::spaceHeaderlogo);
    
    $pdf = self::buildHeader($bankbook, $pdf, $agency);
    
    //print margin content header
    $pdf->Ln(self::marginTopContent);
    
    //print space table header
    $pdf->Ln(self::spaceTableHeader);
    
    return $pdf;
  }
  
  /**
   *
   * @param Bankbook $bankbook
   * @return type 
   */
  public static function pdfContent(Bankbook $bankbook) 
  {
    $pdf = self::buildBasic();
    
    $pdf->AddPage();
    
    //print space header logo   
    $pdf->Ln(self::spaceHeaderlogo);
    
    //print space header content
    $pdf->Ln(self::spaceHeaderContent);
    
    //print margin content header
    $pdf->Ln(self::marginTopContent);
    
    //print space table header
    $pdf->Ln(self::spaceTableHeader);
    
    $pdf = self::buildContent($bankbook, $pdf);
    
    return $pdf;
  }
  
  /**
   *
   * @param Bankbook $bankbook
   * @param Agency $agency
   * @return type 
   */
  public static function pdfAll(Bankbook $bankbook, Agency $agency = null) 
  {
    $pdf = self::buildBasic();
    
    $pdf->AddPage();
    
   //print space header logo   
    $pdf->Ln(self::spaceHeaderlogo);
    
    $pdf = self::buildHeader($bankbook, $pdf, $agency);
    
    //print margin content header
    $pdf->Ln(self::marginTopContent);
    
    //print space table header
    $pdf->Ln(self::spaceTableHeader);
    
    $pdf = self::buildContent($bankbook, $pdf);
    
    return $pdf;
  }    
}

?>
