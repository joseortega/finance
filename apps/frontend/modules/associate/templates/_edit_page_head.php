<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><a href="<?php echo url_for('associate_show', $associate)?>"><?php echo $associate?></a></h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('associate_show', $associate)?>"><span><?php echo __('View profile')?></span></a> </li>
    </ul>
  </div>  
  <p class="breadcrumb"> 
    <a href="<?php echo url_for('associate_show', $associate)?>"><?php echo $associate?></a>
    <span class="separator"></span>
    <?php echo __('Manage')?>
  </p>
</div>