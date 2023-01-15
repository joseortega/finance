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
   * Write account transaction in pdf object
   * @param AccountTransaction $transaction
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfAccountTransfer(Transfer $transfer, $i18n)
  {
    $pdf=new PDF('P','mm', array(105,147));
    $pdf->AddPage();

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);

    $pdf->Cell(25,5,$titleReport->getValue(),0,1,'L');
    
    $pdf->Cell(25,5,'Cuenta de Origen',0,0,'L',1);
    $pdf->Cell(25,5,$transfer->getAccountOrigin()->getNumber().' / '.$transfer->getAccountOrigin()->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(25,5,'Cuenta de Destino',0,0,'L',1);
    $pdf->Cell(25,5,$transfer->getAccountDestination()->getNumber().' / '.$transfer->getAccountDestination()->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(25,5,'Observación',0,0,'L',1);
    $pdf->Cell(25,5,$transfer->getObservation(),0,1,'L');
    
    $pdf->Cell(25,5,'Creado en',0,0,'L',1);
    $pdf->Cell(25,5,$transfer->getCreatedAt(),0,1,'L');
    
    $pdf->Cell(25,5,'Monto',0,0,'L',1);
    $pdf->Cell(25,5,$transfer->getAmount(),0,1,'L');
    
    $pdf->Cell(25,5,'Código',0,0,'L',1);
    $pdf->Cell(25,5,$transfer->getId(),0,1,'L');
    
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
    
    $pdf->SetFont('Arial','B',15);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','',12);
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

    $pdf->SetFont('Arial','',11);
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
    
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(81,5,'',1,0,'R',1);
    
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(27,5,$credit->getCapitalTotal(),1,0,'R',1);
    $pdf->Cell(27,5,$credit->getInterestTotal(),1,0,'R',1);
    $pdf->Cell(27,5,$credit->getPaymentTotal(),1,0,'R',1);
    $pdf->Cell(0,5,'',1,1,'R',1);

    $pdf->Ln(30);

    $pdf->SetFont('Arial','',12);

    $pdf->Cell(40,5,'f)',0,0,'L');
    $pdf->Cell(40,5,'',0,1,'L');

    $pdf->Cell(40,5,'Deudor',0,0,'L');
    $pdf->Cell(40,5,$credit->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(40,5,'Identificación',0,0,'L');
    $pdf->Cell(40,5,$credit->getAssociate()->getIdentification(),0,1,'L');
    
    return $pdf;
  }
  /**
   * Retorna el contenido del pagaré referente al deudor
   * 
   * @param Credit $credit
   * @param string $i18n
   * @return string 
   */
  private static function PagareContenido(Credit $credit){

    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $parrafo1Parte1= "Debo (emos) y pagaré (mos) a la orden del (de la) {$titleReport}";
    $parrafo1Parte2= "En esta ciudad o el lugar donde sea (mos) requerido (s) la cantidad de $ {$credit->getAmount()}";
    $parrafo1Parte3= "valor que he (mos) recibido a entera satisfacción, en calidad de préstamo.";

    $parrafo1 = "{$parrafo1Parte1} {$parrafo1Parte2} {$parrafo1Parte3}";

    $parrafo2Parte1 = "Tambien me (nos) obligo (amos) a pagar la tasa del interés del % {$credit->getInterestRate()} ANUAL REAJUSTABLE";
    $parrafo2Parte2 = "Comprometiendome (nos) a pagar en el plazo de {$credit->getTimeInMonths()} meses y en {$credit->countPayments()} dividendos";
    $parrafo2Parte3 = "con frecuencia de pago cada {$credit->getPayFrequencyInMonths()} en meses quedando integramente cancelado.";

    $parrafo2 = "{$parrafo2Parte1} {$parrafo2Parte2} {$parrafo2Parte3}";

    $parrafo3Parte1 = "En caso de mora me (nos) obligo (amos) a pagar desde la fecha de vencimiento hasta la fecha de pago efectivo,";
    $parrafo3Parte2 = "el interés de mora vigente regulado por la Junta Bancaria.";

    $parrafo3 = "{$parrafo3Parte1} {$parrafo3Parte2}";

    $parrafo4Parte1 = "Si dejare de pagar 1 o mas dividendos o si se diere el crédito destino distinto al convenido, acepto que la acreedora";
    $parrafo4Parte2 = "de por vencido el plazo y exija aún judicialmente el pago total de lo adeudado;";
    $parrafo4Parte3 = "bastando para ello la simple información que hiciere la acreedora en el escrito de demanda.";

    $parrafo4 = "{$parrafo4Parte1} {$parrafo4Parte2} {$parrafo4Parte3}";

    $parrafo5Parte1 = "Para el fin de cumplimiento de los estipulado me (nos) ebligo (amos) con todos mis (nuestros) bienes presentes o futuros";
    $parrafo5Parte2 = "y de manera expreso autorizo a {$titleReport} para que pueda acreditar como pago parcial o total a las obligaciones que se deriben de este pagaré,";
    $parrafo5Parte3 = "debitando o tomando los dineros que mantengo (emos) en mis (nuestras) Cuentas de Ahorro; así como ellos que provengan de valores o documentos";
    $parrafo5Parte4 = "a mi (nuestro) favor que pertenecen y existen en su poder.";

    $parrafo5 = "{$parrafo5Parte1} {$parrafo5Parte2} {$parrafo5Parte3} {$parrafo5Parte4}";

    $parrafo6Parte1 = "Quedo (amos) expresamente sometidos a la jurisdicción de los jueces competentes de esta ciudad y al tramite ejecutivo o cualquier otro permitido por la ley;";
    $parrafo6Parte2 = "obligandome (nos) al fiel cumplimiento de lo estipulado; asi como el pago de todos los gastos judiciales, extrajudiciales y honorarios profesionales";
    $parrafo6Parte3 = "que ocacionare el cobro de la obligación contenida en este documento, bastando para determinar el monto de tales gastos, la sola aseveración de la Acreedora.";
    $parrafo6Parte4 = "a mi (nuestro) favor que pertenecen y existen en su poder.";

    $parrafo6 = "{$parrafo6Parte1} {$parrafo6Parte2} {$parrafo6Parte3} {$parrafo6Parte4}";

    $contenido = "{$parrafo1}\n\n{$parrafo2}\n\n{$parrafo3}\n\n{$parrafo4}\n\n{$parrafo5}\n\n{$parrafo6}";

    return $contenido;
  }
  /**
   * Retorna el contenido del pagaré referente al garante
   * 
   * @param Credit $credit
   * @param string $i18n
   * @return string
   */
  private static function PagareContenidoGarante(Credit $credit)
  {
    $parrafo1Parte1= "POR AVAL, garantizo (amos) solidariamente en los mismos términos y condiciones constantes en el pagaré que antecede,";
    $parrafo1Parte2= "el cumplimiento de las obligaciones del (de los) suscriptor (es) de este pagaré. Renuncio (amos) domicilio y quedo (amos) sometido (s)";
    $parrafo1Parte3= "a los jueces competentes de esta ciudad o los que elija el acreedor. Renuncio (amos) al beneficio de orden y exclusión";

    $parrafo1 = "{$parrafo1Parte1} {$parrafo1Parte2} {$parrafo1Parte3}";

    $parrafo2Parte1 = "Autorizo (amos) a la entidad financiera para que disponga de los valores que a mi (nuestro) favor existan en mi (s), nuestra (s) cuenta (s)";
    $parrafo2Parte2 = "que mantengo (mantenenmos) en la cooperativa, e impute tales valores al pago total o parcial de la obligación constante en este pagaré, de sus intereses";
    $parrafo2Parte3 = "y gastos ocacionados por la mora o cualquier otro gasto, sin que deba para esto la Cooperativa dar aviso alguno ni recibir nueva autorización";

    $parrafo2 = "{$parrafo2Parte1} {$parrafo2Parte2} {$parrafo2Parte3}";

    $parrafo3Parte1 = "El pago de una vez iniciada la ejecución judicial no podrá hacerse por partes ni aún por mis (nuestro) herederos o legatarios";

    $parrafo3 = "{$parrafo3Parte1}";

    $parrafo4Parte1 = "Sin protesto, Exímese de la presentación para el pago asi como de avisos por la falta de pago";


    $parrafo4 = "{$parrafo4Parte1}";



    $contenidoGarante = "{$parrafo1}\n\n{$parrafo2}\n\n{$parrafo3}\n\n{$parrafo4}";

    return $contenidoGarante;
  }
  /**
   * Impresión pagaré de crédito
   * 
   * @param Credit $credit
   * @param string $i18n
   * @return PDF 
   */
  public static function pdfPagare(Credit $credit, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);

    $pagareContenido = self::pagareContenido($credit);

    $pagareContenidoGarante = self::PagareContenidoGarante($credit);
     
    // armando el report
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',15);
    $pdf->SetTextColor(0,0,0);

    //Nombre de La Entidad Financiera
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);

    $pdf->Cell(190,5,'PAGARÉ',0,1,'C',0,'');
    $pdf->Cell(190,5,'',0,1,'C',0);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,5,'Nro de Crédito',0,0,'L');
    $pdf->Cell(40,5,$credit->getId(),0,1,'L');
    
    $pdf->Cell(40,5,'Nro de Socio',0,0,'L');
    $pdf->Cell(40,5,$credit->getAssociate()->getNumber(),0,1,'L');

    $pdf->ln();

    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,5,$pagareContenido);
    $pdf->Cell(190,5,'',0,1,'C',0);

    
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);

    $pdf->Ln();

    $pdf->Cell(190,5,$credit->getIssuedAt(),0,0,'R');
    
    $pdf->Ln(30);


    $pdf->Cell(40,5,'f)',0,0,'L');
    $pdf->Cell(40,5,'',0,1,'L');

    $pdf->Cell(40,5,'Deudor',0,0,'L');
    $pdf->Cell(40,5,$credit->getAssociate()->getName(),0,1,'L');
    
    $pdf->Cell(40,5,'Identificación',0,0,'L');
    $pdf->Cell(40,5,$credit->getAssociate()->getIdentification(),0,1,'L');

    if(count($credit->getGuaranteePersonals())>0)
    {
      $pdf->AddPage();

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(190,5,'GARANTÍAS',0,1,'C',0,'');
      $pdf->Cell(190,5,'',0,1,'C',0);

      $pdf->SetFont('Arial','',12);
      $pdf->MultiCell(0,5,$pagareContenidoGarante);
      $pdf->Cell(190,5,'',0,1,'C',0);

      $pdf->Ln();

      $pdf->Cell(190,5,$credit->getIssuedAt(),0,0,'R');
      
      foreach($credit->getGuaranteePersonals() as $guaranteePersonal)
      {
        $pdf->Ln(30);

        $pdf->Cell(40,5,'f)',0,0,'L');
        $pdf->Cell(40,5,'',0,1,'L');

        $pdf->Cell(40,5,'Garante',0,0,'L');
        $pdf->Cell(40,5,$guaranteePersonal->getAssociate()->getName(),0,1,'L');
        
        $pdf->Cell(40,5,'Identificación',0,0,'L');
        $pdf->Cell(40,5,$guaranteePersonal->getAssociate()->getIdentification(),0,1,'L');
      }
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
  public static function pdfAccountTransactions($transactions, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);
    
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Movimientos en Cuentas',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','',8);    
    $pdf->SetFillColor(210,210,210);
    
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_account'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_debit'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_credit'),1,1,'R',1);
    
    $debit = 0;
    $credit = 0;
    
    $pdf->SetFont('Arial','',8);
    
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
    
    $pdf->SetFont('Arial','B',8);
    
    $pdf->Cell(125,5,'Total',1,0,'L',1);
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
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Movimientos en Créditos',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_credit'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_debit'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_credit'),1,1,'R',1);
    
    $pdf->SetFont('Arial','',8);
    
    $debit = 0;
    $credit = 0;
    
    foreach ($transactions as $transaction)
    {
      $pdf->Cell(25,5,$transaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(70,5,$transaction->getCredit()->getId().'/'.$transaction->getCredit()->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(30,5,$transaction->getTransactionType()->getInitials(),1,0,'L');   
      
      if($transaction->isDebit()){
          $pdf->Cell(30,5,$transaction->getAmount(),1,0,'R');
          $pdf->Cell(0,5,'',1,1,'R');
          
          $debit = $debit + $transaction->getAmount();
          
      }else{
          $pdf->Cell(30,5,'',1,0,'R');
          $pdf->Cell(0,5,$transaction->getAmount(),1,1,'R');
          
          $credit = $credit + $transaction->getAmount();
      }
    }
    
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(125,5,'Sumatoria',1,0,'L',1);
       
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
  public static function pdfInvestmentTransactions($transactions, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);
    
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Movimientos en Inversiones',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_investment'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_debit'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_credit'),1,1,'R',1);
    
    $pdf->SetFont('Arial','',8);
    
    $debit = 0;
    $credit = 0;
    
    foreach ($transactions as $transaction)
    {
      $pdf->Cell(25,5,$transaction->getCreatedAt('Y-m-d'),1,0,'L');
      $pdf->Cell(70,5,$transaction->getInvestment()->getId().'/'.$transaction->getInvestment()->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(30,5,$transaction->getTransactionType()->getInitials(),1,0,'L');   
      
      if($transaction->isDebit()){
          $pdf->Cell(30,5,$transaction->getAmount(),1,0,'R');
          $pdf->Cell(0,5,'',1,1,'R');
          
          $debit = $debit + $transaction->getAmount();
          
      }else{
          $pdf->Cell(30,5,'',1,0,'R');
          $pdf->Cell(0,5,$transaction->getAmount(),1,1,'R');
          
          $credit = $credit + $transaction->getAmount();
      }
      
    }
    
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(125,5,'Sumatoria',1,0,'L',1);
       
    $pdf->Cell(30,5, $debit,1,0,'R',1);
    $pdf->Cell(0,5, $credit,1,1,'R',1);
    
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
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Caja',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_date'),1,0,'L',1);
    $pdf->Cell(45,5,sfConfig::get('app_'.$i18n.'_cash'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_transaction'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_type'),1,0,'L',1);
    $pdf->Cell(30,5,sfConfig::get('app_'.$i18n.'_debit'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_credit'),1,1,'R',1);
    
    $pdf->SetFont('Arial','',8);
    
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
    
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(130,5,'Sumatoria',1,0,'L',1);

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
    $pdf->Cell(190,5,'Reporte de Socios',0,1,'C',0);
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
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Cuentas',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','B',8);
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
    
    $totalAvailableBalance = 0;
    $totalBlockedBalance = 0;
    $totalBalance = 0;
    
    $pdf->SetFont('Arial','',8);
            
    foreach ($accounts as $account)
    {
      $pdf->Cell(70,5,$account->getAssociate()->getNumber().' / '.$account->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(25,5,$account->getNumber(),1,0,'L');
      $pdf->Cell(25,5,$account->getProduct()->getName(),1,0,'L');
      $pdf->Cell(25,5,$account->getAvailableBalance(),1,0,'R');
      $pdf->Cell(25,5,$account->getBlockedBalance(),1,0,'R');
      $pdf->Cell(0,5,$account->getBalance(),1,1,'R');
      
      $totalAvailableBalance= $totalAvailableBalance + $account->getAvailableBalance();
      $totalBlockedBalance = $totalBlockedBalance + $account->getBlockedBalance();
      $totalBalance = $totalBalance + $account->getBalance();
    }
    
    //modificado el 15 de octubre del 2022...
    $pdf->SetFont('Arial','B',8);
    
    $pdf->Cell(120,5,'Sumatoria',1,0,'L',1);
    $pdf->Cell(25,5,$totalAvailableBalance,1,0,'R',1);
    $pdf->Cell(25,5,$totalBlockedBalance,1,0,'R',1);
    $pdf->Cell(0,5,$totalBalance,1,1,'R',1);
    
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
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Créditos',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(210,210,210);
    $pdf->SetTextColor(0);
  
    $pdf->Cell(60,5,sfConfig::get('app_'.$i18n.'_associate'),1,0,'L',1);
    $pdf->Cell(15,5,sfConfig::get('app_'.$i18n.'_credit'),1,0,'L',1);
    $pdf->Cell(45,5,sfConfig::get('app_'.$i18n.'_type'),1,0,'L',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_created_at'),1,0,'R',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_term'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_amount'),1,1,'R',1);
    
    $pdf->SetFont('Arial','',8);
    $totalAmount = 0;
    
    foreach ($credits as $credit)
    {
      $pdf->Cell(60,5,$credit->getAssociate()->getNumber().' / '.$credit->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(15,5,$credit->getId(),1,0,'L');
      $pdf->Cell(45,5,$credit->getProduct()->getName(),1,0,'L');
      $pdf->Cell(25,5,$credit->getCreatedAt('Y-m-d'),1,0,'R');
      $pdf->Cell(25,5,$credit->getTimeInMonths(),1,0,'R');
      $pdf->Cell(0,5,$credit->getAmount(),1,1,'R');
      
      $totalAmount = $totalAmount + $credit->getAmount();
    }
    
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(170,5,'Total de Monto',1,0,'L',1);
    $pdf->Cell(0,5,$totalAmount,1,1,'R',1);
    
    return $pdf;
  }
  
  public static function pdfInvestments($investments, $i18n)
  {
    $titleReport = ConfigurationPeer::retrieveByName(Configuration::TITLE_REPORT);
    
    $pdf=new PDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(190,5,$titleReport->getValue(),0,1,'C',0,'');
    $pdf->Cell(190,5,'Reporte de Inversiones',0,1,'C',0);
    $pdf->Cell(190,5,'',0,1,'C',0);
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(210,210,210);
    $pdf->Cell(70,5,sfConfig::get('app_'.$i18n.'_associate'),1,0,'L',1);
    $pdf->Cell(15,5,sfConfig::get('app_'.$i18n.'_investment'),1,0,'L',1);
    $pdf->Cell(35,5,sfConfig::get('app_'.$i18n.'_type'),1,0,'L',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_created_at'),1,0,'R',1);
    $pdf->Cell(25,5,sfConfig::get('app_'.$i18n.'_expiration_date'),1,0,'R',1);
    $pdf->Cell(0,5,sfConfig::get('app_'.$i18n.'_amount'),1,1,'R',1);
    
    $totalAmount = 0;
    
    $pdf->SetFont('Arial','',8);
            
    foreach ($investments as $investment)
    {
      $pdf->Cell(70,5,$investment->getAssociate()->getNumber().' / '.$investment->getAssociate()->getName(),1,0,'L');
      $pdf->Cell(15,5,$investment->getId(),1,0,'L');
      $pdf->Cell(35,5,$investment->getProduct()->getName(),1,0,'L');
      $pdf->Cell(25,5,$investment->getCreatedAt('Y-m-d'),1,0,'R');
      $pdf->Cell(25,5,$investment->getExpirationDate('Y-m-d'),1,0,'R');
      $pdf->Cell(0,5,$investment->getAmount(),1,1,'R');
      
      $totalAmount = $totalAmount + $investment->getAmount();
    }
    
    
    
    //modificado el 15 de octubre del 2022...
    $pdf->SetFont('Arial','B',8);
    
    $pdf->Cell(120,5,'Sumatoria',1,0,'L',1);
    $pdf->Cell(0,5,$totalAmount,1,1,'R',1);
    
    return $pdf;
  }
}

?>
