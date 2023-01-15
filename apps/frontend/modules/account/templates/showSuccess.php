<?php include_partial('account/account_page_head', array('account'=>$account))?>

<div class="columns infocols clear_fix">
  <?php include_partial('util/flashes')?>
  <div class="first">
    <?php include_partial('detail', array('account' => $account)) ?>
  </div>
  <div class="last">
  </div>
</div>