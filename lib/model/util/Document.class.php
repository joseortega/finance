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
  public static function pdfAccountTransaction(Transaction $transaction, $i18n)
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
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_id'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getId(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write investment transaction in pdf object
   * 
   * @param InvestmentTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfInvestmentTransaction(Transaction $transaction, $i18n)
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
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_id'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getId(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write credit transaction in pdf object
   * 
   * @param CreditTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfCreditTransaction(Transaction $transaction, $i18n)
  {
    $pdf=new PDF('P','mm', array(105,147));
    $pdf->AddPage();

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $payments = $transaction->getPayments();
    
    //payments Number
    
    foreach ($payments as $key => $payment){
      
      if($key == 0){
        $paymentNumber = $payment->getNumber();
      }
      
      if($key != 0){
        $paymentNumber = $paymentNumber.', '.$payment->getNumber();
      }
    }

    $pdf->Cell(25,5,$titleReport->getValue(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_credit'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCredit()->getId(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_associate'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCredit()->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_transaction'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getTransactionType()->getConcept(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCreatedAt(),0,1,'L');
    
    //payment
    if(count($payments) != 0){
        
        $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_payments'),0,0,'L',1);
        $pdf->Cell(25,5,$paymentNumber,0,1,'L');

        $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_capital'),0,0,'L',1);
        $pdf->Cell(25,5,PaymentPeer::sumCapital($payments),0,1,'L');

        $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_interest'),0,0,'L',1);
        $pdf->Cell(25,5,PaymentPeer::sumInterest($payments),0,1,'L');

        $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_arrear'),0,0,'L',1);
        $pdf->Cell(25,5,PaymentPeer::sumArrear($payments),0,1,'L');
        
        $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_discount'),0,0,'L',1);
        $pdf->Cell(25,5,PaymentPeer::sumDiscount($payments),0,1,'L');
    }
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_amount'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAmount(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_id'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getId(),0,1,'L');
    
    return $pdf;
  }
  
  /**
   * Write cash transaction in pdf object
   * @param AccountTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfCashTransaction(Transaction $transaction, $i18n)
  {
    $pdf=new PDF('P','mm', array(105,147));
    $pdf->AddPage();

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);

    $pdf->Cell(25,5,$titleReport->getValue(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_transaction'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getTransactionType()->getConcept(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getCreatedAt(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_amount'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getAmount(),0,1,'L');
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_id'),0,0,'L',1);
    $pdf->Cell(25,5,$transaction->getId(),0,1,'L');
    
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
    
    $pdf=new PDF('P','mm', 'A4');
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
    $pdf->Cell(27,5,sfConfig::get('app_'.$i18n.'_n'),1,0,'L',1);
    $pdf->Cell(27,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(27,5,sfConfig::get('app_'.$i18n.'_balance'),1,0,'R',1);
    $pdf->Cell(27,5,sfConfig::get('app_'.$i18n.'_capital'),1,0,'R',1);
    $pdf->Cell(27,5,sfConfig::get('app_'.$i18n.'_interest'),1,0,'R',1);
    $pdf->Cell(27,5,sfConfig::get('app_'.$i18n.'_payment'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_status'),1,1,'R',1);

    $numero_reg = count($amortizations);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);


    foreach ($amortizations as $amortization)
    {
        $pdf->Cell(27,5,$amortization->getNumber(),1,0,'L',1);
        $pdf->Cell(27,5,$amortization->getDate(),1,0,'L',1);
        $pdf->Cell(27,5,$amortization->getBalance(),1,0,'R',1);
        $pdf->Cell(27,5,$amortization->getCapital(),1,0,'R',1);
        $pdf->Cell(27,5,$amortization->getInterest(),1,0,'R',1);
        $pdf->Cell(27,5,$amortization->getPreTotal(),1,0,'R',1);
        $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_'.$amortization->getStatus()),1,1,'R',1);
    }

    $pdf->SetFillColor(220,220,220);
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(81,5,'',1,0,'R',1);
    
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(27,5,$credit->getCapitalTotal(),1,0,'R',1);
    $pdf->Cell(27,5,$credit->getInterestTotal(),1,0,'R',1);
    $pdf->Cell(27,5,$credit->getPaymentTotal(),1,0,'R',1);
    $pdf->Cell(0,5,'',1,1,'R',1);
    
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
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_debit'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_credit'),1,1,'R',1);
    
    $debit = 0;
    $credit = 0;
    
    foreach ($transactions as $accountTransaction)
    {
      $pdf->Cell(25,5,$accountTransaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(70,5,$accountTransaction->getAccount()->getNumber().'/'.$accountTransaction->getAccount()->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(30,5,$accountTransaction->getTransactionType()->getInitials(),1,0,'L');   
      
      if($accountTransaction->isDebit()){
          $pdf->Cell(30,5,$accountTransaction->getAmount(),1,0,'R');
          $pdf->Cell(0,5,'',1,1,'R');
          
          $debit = $debit + $accountTransaction->getAmount();
          
      }else{
          $pdf->Cell(30,5,'',1,0,'R');
          $pdf->Cell(0,5,$accountTransaction->getAmount(),1,1,'R');
          
          $credit = $credit + $accountTransaction->getAmount();
      }
    }
    
    $pdf->SetFillColor(220,220,220);
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(125,5,'',1,0,'R',1);
    
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(30,5, $debit,1,0,'R',1);
    $pdf->Cell(0,5, $credit,1,1,'R',1);
    
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
  
  /**
   * Write account transactions in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfCashTransactions($transactions, $i18n)
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
    $pdf->Cell(45,5,sfConfig::get('app_'.$i18n.'_cash'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_type'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_debit'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_credit'),1,1,'R',1);
    
    $debit = 0;
    $credit = 0;
    
    foreach ($transactions as $accountTransaction)
    {
      $pdf->Cell(25,5,$accountTransaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(45,5,$accountTransaction->getCash()->getName(),1,0,'L');
      $pdf->Cell(30,5,$accountTransaction->getTransactionType()->getInitials(),1,0,'L');
      $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_entity_type_'.$accountTransaction->getEntityType()),1,0,'L');
      
      if($accountTransaction->isDebit()){
          $pdf->Cell(30,5,$accountTransaction->getAmount(),1,0,'R');
          $pdf->Cell(0,5,'',1,1,'R');
          
          $debit = $debit + $accountTransaction->getAmount();
          
      }else{
          $pdf->Cell(30,5,'',1,0,'R');
          $pdf->Cell(0,5,$accountTransaction->getAmount(),1,1,'R');
          
          $credit = $credit + $accountTransaction->getAmount();
      }
    }
    
    $pdf->SetFillColor(220,220,220);
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(130,5,'',1,0,'R',1);
    
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(30,5, $debit,1,0,'R',1);
    $pdf->Cell(0,5, $credit,1,1,'R',1);
    
    return $pdf;
  }
  
  /**
   * Write Investment transactions in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfAssociates($associates, $i18n)
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
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_number'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_name'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_identification'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_category'),1,0,'L',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_created_at'),1,1,'R',1);
    
    foreach ($associates as $associate)
    {
      $pdf->Cell(25,5,$associate->getNumber(),1,0,'L');
      $pdf->Cell(70,5,$associate->getName(),1,0,'L');
      $pdf->Cell(30,5,$associate->getIdentification(),1,0,'L');
      $pdf->Cell(30,5,$associate->getCategory()->getName(),1,0,'L');
      $pdf->Cell(0,5,$associate->getCreatedAt('y-m-d'),1,1,'R');
    }
    
    return $pdf;
  }
  
  /**
   * Write accounts in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfAccounts($accounts, $i18n)
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
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_associate'),1,0,'L',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_account'),1,0,'L',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_type'),1,0,'L',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_available_balance'),1,0,'R',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_blocked_balance'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_balance'),1,1,'R',1);
    
    foreach ($accounts as $account)
    {
      $pdf->Cell(70,5,$account->getAssociate()->getNumber().' / '.$account->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(25,5,$account->getNumber(),1,0,'L');
      $pdf->Cell(25,5,$account->getProduct()->getName(),1,0,'L');
      $pdf->Cell(25,5,$account->getAvailableBalance(),1,0,'R');
      $pdf->Cell(25,5,$account->getBlockedBalance(),1,0,'R');
      $pdf->Cell(0,5,$account->getBalance(),1,1,'R');
    }
    
    return $pdf;
  }
  
  /**
   * Write credits in pdf object
   * 
   * @param array $transactions
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfCredits($credits, $i18n)
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
    $pdf->Cell(60,5,sfConfig::get('app_'.$i18n.'_associate'),1,0,'L',1);
    $pdf->Cell(15,5,sfConfig::get('app_'.$i18n.'_credit'),1,0,'L',1);
    $pdf->Cell(45,5,sfConfig::get('app_'.$i18n.'_type'),1,0,'L',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_amount'),1,0,'R',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_term'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_created_at'),1,1,'R',1);
    
    foreach ($credits as $credit)
    {
      $pdf->Cell(60,5,$credit->getAssociate()->getNumber().' / '.$credit->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(15,5,$credit->getId(),1,0,'L');
      $pdf->Cell(45,5,$credit->getProduct()->getName(),1,0,'L');
      $pdf->Cell(25,5,$credit->getAmount(),1,0,'R');
      $pdf->Cell(25,5,$credit->getTimeInMonths(),1,0,'R');
      $pdf->Cell(0,5,$credit->getCreatedAt('Y-m-d'),1,1,'R');
    }
    
    return $pdf;
  }
}

?>
