<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('New Investment')?></h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('@investment')?>"><span><?php echo __('Go to list')?></span></a> </li>
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
      <p>
        <?php echo __('Investments are made by debiting the respective partner account, Once you save an investment, there is no going back. Please be certain.')?>
        <a href="<?php echo url_for('@investment')?>"><span><?php echo __('Investment list')?></span></a>
      </p>
    </div>
  </div>
</div>