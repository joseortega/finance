<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/js/jquery.colorbox.js') ?>
<?php use_stylesheet('/css/colorbox/colorbox.css') ?>

<script>
$(document).ready(function(){

  $(".ajax_link").colorbox({speed: 320, opacity: 0.55, top: 100, initialWidth: 710, initialHeight: 20, close: "x"});

});
</script>

<?php include_partial('account/account_page_head', array('account'=>$account))?>

<div class=" columns clear_fix">
  <div class="news account_bankbooks">
    <?php include_partial('list', array('pager' => $pager, 'account'=> $account)) ?>
  </div>
</div>