<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class=" columns clear_fix">
  <div class="main">
    <?php include_partial('util/flashes')?>
    <?php include_partial('form', array('form' => $form, 'credit' => $credit, 'amortizations' => $amortizations)) ?>
  </div>
</div>
