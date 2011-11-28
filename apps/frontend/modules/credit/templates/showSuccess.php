<?php echo include_partial('credit/info_page_head', array('credit'=>$credit))?>

<div class="columns infocols clear_fix">
  <?php include_partial('flashes', array('credit'=>$credit))?>
  <div class="first">
    <?php include_partial('detail', array('credit'=>$credit)) ?>
    <?php include_partial('info_actions', array('credit' => $credit))?>
  </div>
  <div class="last">
    <?php include_partial('info_note', array('credit' => $credit))?>
  </div> 
</div>