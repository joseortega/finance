<div id="page_head" class="info">
  <div class="title_actions_bar clear_fix">
    <h1>
      <strong>
        <a href="<?php echo url_for('@general_transaction')?>"><?php echo $cash?></a>
        <em>
          (<?php echo __('Balance')?>
          <?php echo $cash->getBalance()?>)
        </em>
      </strong>
    </h1>
  </div>
  <p class="breadcrumb"> 
    <?php echo __('Cash Balance')?>
    <span class="separator"></span>
    <strong><?php echo $cash->getBalance()?></strong>
  </p>
</div>