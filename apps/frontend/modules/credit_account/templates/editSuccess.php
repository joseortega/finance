<?php include_partial('credit/edit_page_head', array('credit'=>$credit))?>

<div class="htabs credit clear_fix">
  <div class="sidebar">
    <?php include_partial('credit/configuration', array('credit'=>$credit))?>
  </div>
  <div class="columns typical">
    <div class="main">
      <?php include_partial('util/flashes') ?>
      <div class="fields">
        <?php include_partial('form', array('form' => $form, 'credit'=>$credit)) ?>
      </div>
    </div>
    <div class="sidebar">
      <p>
        <?php echo __('El pago de cuotas se realizará mediante débitos de la cuenta vinculada.')?>
      </p>
    </div>
  </div>

</div>