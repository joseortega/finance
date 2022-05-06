<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('New Person')?></h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('@associate_person')?>"><span><?php echo __('Go to list')?></span></a> </li>
    </ul>
  </div>
</div>

<div class="rule"></div>

<div class="columns newcols clear_fix">
  <div  class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <h2><?php echo __('Note')?>:</h2>
      <p><?php echo __('These basic data to create a associate, later you can add more features individuals.')?></p>
    </div>
  </div>
</div>


