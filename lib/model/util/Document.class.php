<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentTransaction
 *
 * @author jose
 */
class Document 
{
  /**
   * Write account transaction in pdf object
   * @param AccountTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfAccountTransaction(AccountTransaction $transaction, $i18n)
  {
    $pdf=new PDF('P','mm', array(105,147));
    $pdf->AddPage();

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);

    $pdf->Cell(25,5,$titleReport->getValue(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_account'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAccount()->getNumber(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_associate'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAccount()->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_transaction'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getTransactionType()->getConcept(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCreatedAt(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_amount'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAmount(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write investment transaction in pdf object
   * 
   * @param InvestmentTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfInvestmentTransaction(InvestmentTransaction $transaction, $i18n)
  {
    $pdf=new PDF('P','mm', array(105,147));
    $pdf->AddPage();

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);

    $pdf->Cell(25,5,$titleReport->getValue(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_investment'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getInvestment()->getId(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_associate'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getInvestment()->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_transaction'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getTransactionType()->getConcept(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCreatedAt(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_amount'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAmount(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write credit transaction in pdf object
   * 
   * @param CreditTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfCreditTransaction(CreditTransaction $transaction, $i18n)
  {
    $pdf=new PDF('P','mm', array(105,147));
    $pdf->AddPage();

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);

    $pdf->Cell(25,5,$titleReport->getValue(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_credit'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCredit()->getId(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_associate'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCredit()->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_transaction'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getTransactionType()->getConcept(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCreatedAt(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_amount'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAmount(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write investment in pdf object
   * 
   * @param Investment $investment
   * @return PDF 
   */
  public static function pdfInvestmnet(Investment $investment, Agency $agency = null)
  {
    if($agency){
      $agencyName = $agency->getName();
    }
    
    $pdf=new PDF('P','mm', array(228, 147));
    $pdf->SetMargins(0, 34.2, 0);
    $pdf->AddPage();
   
    $pdf->SetFont('Arial','',9);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $w = 60;
    $h = 5;
    
    $pdf->Cell($w,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getId(),0,0,'L');
    
    $pdf->Cell(28,$h,'',0,0,'L');
    $pdf->Cell($w,$h,$investment->getAssociate()->getNumber(),0,1,'L');
    
    $pdf->Cell($w,$h,'',0,0,'L');
    $pdf->Cell($w,$h, $agency,0,1,'L');
    
    $pdf->Cell($w,$h,'',0,0,'L');
    $pdf->Cell($w,$h,$investment->getAssociate()->getName(),0,1,'L');
    
    //space
    $pdf->Cell($w,5.2,'',0,1,'L');
    
    $h = 3.8;
    
    $pdf->Cell(68,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getAmount(),0,0,'L');
    
    $pdf->Cell(47,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getTimeDays(),0,1,'L');
    
    $pdf->Cell(68,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getInterestRate(),0,0,'L');
    
    $pdf->Cell(47,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getCreatedAt('Y-m-d'),0,1,'L');
    
    $pdf->Cell(68,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getInterestAmount(),0,0,'L');
    
    $pdf->Cell(47,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getExpirationDate('Y-m-d'),0,1,'L');
    
    $pdf->Cell(68,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getTaxAmount(),0,1,'L');
    
    $pdf->Cell(68,$h,'',0,0,'L');
    $pdf->Cell(40,$h,$investment->getFinalAmount(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write payments in pdf object
   * 
   * @param Credit $credit
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfAmortizationTable(Credit $credit, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $amortizations = $credit->getPayments();
    
    // armando el reporte
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $pdf->Cell(40,5,sfConfig::get('app_'.$i18n.'_associate'),0,0,'L');
    $pdf->Cell(40,5,$credit->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(40,5,sfConfig::get('app_'.$i18n.'_product'),0,0,'L');
    $pdf->Cell(40,5,$credit->getProduct()->getName(),0,1,'L');
    
    $pdf->Cell(40,5,sfConfig::get('app_'.$i18n.'_credit'),0,0,'L');
    $pdf->Cell(40,5,$credit->getId(),0,1,'L');
    
    $pdf->Cell(40,5,sfConfig::get('app_'.$i18n.'_amount'),0,0,'L');
    $pdf->Cell(40,5,$credit->getAmount(),0,1,'L');
    
    $pdf->Cell(40,5,sfConfig::get('app_'.$i18n.'_interest_rate'),0,0,'L');
    $pdf->Cell(40,5,$credit->getInterestRate(),0,1,'L');
    
    $pdf->Ln();
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_n'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_balance'),1,0,'R',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_capital'),1,0,'R',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_interest'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_payment'),1,1,'R',1);

    $numero_reg = count($amortizations);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);


    foreach ($amortizations as $amortization)
    {
        $pdf->Cell(30,5,$amortization->getNumber(),1,0,'L',1);
        $pdf->Cell(30,5,$amortization->getDate(),1,0,'L',1);
        $pdf->Cell(30,5,$amortization->getBalance(),1,0,'R',1);
        $pdf->Cell(30,5,$amortization->getCapital(),1,0,'R',1);
        $pdf->Cell(30,5,$amortization->getInterest(),1,0,'R',1);
        $pdf->Cell(0,5,$amortization->getTotal(),1,1,'R',1);
    }

    $pdf->SetFillColor(220,220,220);
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(90,5,'',1,0,'R',1);
    
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(30,5,$credit->getCapitalTotal(),1,0,'R',1);
    $pdf->Cell(30,5,$credit->getInterestTotal(),1,0,'R',1);
    $pdf->Cell(0,5,$credit->getPaymentTotal(),1,1,'R',1);
    
    return $pdf;
  }
  
  /**
   * Write account transactions in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfAccountTransactions($transactions, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);
    
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_account'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_amount'),1,1,'R',1);
    
    foreach ($transactions as $accountTransaction)
    {
      $pdf->Cell(25,5,$accountTransaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(70,5,$accountTransaction->getAccount()->getNumber().'/'.$accountTransaction->getAccount()->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(30,5,$accountTransaction->getTransactionType()->getInitials(),1,0,'L');   
      $pdf->Cell(0,5,$accountTransaction->getAmount(),1,1,'R');
    }
    
    return $pdf;
  }
  
  /**
   * Write Credit transactions in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfCreditTransactions($transactions, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);
    
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_credit'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_amount'),1,1,'R',1);
    
    foreach ($transactions as $transaction)
    {
      $pdf->Cell(25,5,$transaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(70,5,$transaction->getCredit()->getId().'/'.$transaction->getCredit()->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(30,5,$transaction->getTransactionType()->getInitials(),1,0,'L');   
      $pdf->Cell(0,5,$transaction->getAmount(),1,1,'R');
    }
    
    return $pdf;
  }
  
  /**
   * Write Investment transactions in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfInvestmentTransactions($transactions, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);
    
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_investment'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_amount'),1,1,'R',1);
    
    foreach ($transactions as $transaction)
    {
      $pdf->Cell(25,5,$transaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(70,5,$transaction->getInvestment()->getId().'/'.$transaction->getInvestment()->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(30,5,$transaction->getTransactionType()->getInitials(),1,0,'L');   
      $pdf->Cell(0,5,$transaction->getAmount(),1,1,'R');
    }
    
    return $pdf;
  }
}

?>
