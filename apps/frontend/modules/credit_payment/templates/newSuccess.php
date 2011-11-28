<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class=" columns clear_fix">
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form, 'credit' => $credit)) ?>
  </div>
</div>



<?php use_stylesheet('/css/smoothness/jquery-ui-1.8.13.custom.css') ?>
<?php use_javascript('/js/jquery-1.5.min.js') ?>

<?php use_javascript('/js/jquery-ui-1.8.13.custom.min.js') ?>


<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog-confirm" ).dialog({
			resizable: true,
                        autoOpen: false,
                        show: 'blind',
                        hide: 'blind',
			height:150,
                        position: ['center',100],
			modal: true,
			buttons: {
				"<?php echo __('Execute Payment')?>": function() {
					window.location.href = $(this).dialog('option', 'href');
                                        this.onclick=function(){return false};
                                        $( this ).dialog( "close" );
				},
				"<?php echo __('Cancel')?>": function() {
					$( this ).dialog( "close" );
				}
			}
		});
                
                $('.confirm').click(function(e){
                  e.preventDefault();
                  $("#dialog-confirm").dialog('option', 'href',$(this).attr('href')).dialog('open');
                  return false;
                });   
	});
        
        
        
        
</script>

<div id="dialog-confirm" title="<?php echo __('Confirmation')?>">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo __('Once payment executed, there is no going back. Please be certain.')?></p>
</div>
        
<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class=" columns infocols clear_fix">
  <?php include_partial('util/flashes')?>
  <div class="main">
    <?php if($credit->CountPaymentsPending()>0):?>
    <div class="section">
      <table class="info">
        <tbody>
          <tr>
            <th><?php echo __('Payment #')?></th>
            <td><?php echo $credit->countPaymentsEffected()+1?></td>
          </tr>
          <tr>
            <th><?php echo __('Payment date')?></th>
            <td><?php echo $payment->getDate()?></td>
          </tr>
          <tr>
            <th><?php echo __('Account to debit')?></th>
            <td><?php echo $credit->getAccount()->getNumber()?> | <?php echo $credit->getAccount()->getAvailableBalance()?></td>
          </tr>
          <tr>
            <th><?php echo __('Capital')?></th>
            <td><?php echo $payment->getCapital()?></td>
          </tr>
          <tr>
            <th><?php echo __('Interest')?></th>
            <td><?php echo $payment->getInterest()?></td>
          </tr>
          <tr>
            <th><?php echo __('Arrear')?></th>
            <td><?php echo $payment->getArrear()?></td>
          </tr>
          <tr>
            <th><?php echo __('Days in arrear')?></th>
            <td><?php echo $payment->getDaysInArrear()?></td>
          </tr>
          <tr>
            <th><strong><?php echo __('Amount payable')?></strong></th>
            <td><strong><?php echo $payment->getTotal()?></strong></td>
          </tr>
        </tbody>
      </table>
    </div>
    <ul class="actions">
      <li><?php echo link_to('<span>'.__('Effect payment').'</span>', 'credit_payment/onePayment?id='.$payment->getId(), array( 'class'=>'button classy confirm', 'onclick'=>'this.onclick=function(){return false}')) ?></li>
    </ul>
    
    
    <?php endif;?>
  </div>
  <div class="sidebar">
    <div class="note">
      <h2><?php echo __('Note')?></h2>
      <p><?php echo __('El pago se realiza mediante debitos de la cuenta configurada, una vez efectuado la accion, no hay marcha atras. Por favor asegurese.')?></p>
    </div>
  </div>
</div>