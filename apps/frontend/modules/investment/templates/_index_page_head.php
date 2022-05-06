<div id="page_head">
  <div class="title_actions_bar">
    <h1><?php echo __('Investments')?></h1>
    <ul class="actions">
      <li><a class="minibutton" href="<?php echo url_for('@investment_new')?>"><span><?php echo __('New investment')?></span></a></li>
    </ul>
  </div>
  <?php include_partial('nav/investments') ?> 
  <?php include_partial('sub_nav/investments') ?> 
</div>