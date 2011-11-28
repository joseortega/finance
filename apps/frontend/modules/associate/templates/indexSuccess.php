<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>



<script type="text/javascript">
  $(document).ready(function()
  {
    $('.search button').hide();

    $('#search_associate_keywords').keyup(function(key)
    {
      if (this.value.length >= 3 || this.value == '')
      {
        $('#loader').show();
        $('#associates').load(
          $(this).parents('form').attr('action'),
          { query: this.value + '*' },
          function() { $('#loader').hide(); }
        );
      }
    });
  });
</script>

<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('Search')?></h1>
  </div>
  <?php include_partial('nav/associates') ?>
</div>
<div class="main">
  <div class="search">
    <div class="form">
      <form action="<?php echo url_for('@associate_search') ?>" method="get">
        <input type="search" value="<?php echo $sf_request->getParameter('query')?>" name="query" autocomplete="off" placeholder="<?php echo __('Find associate')?>" value="<?php echo $sf_request->getParameter('query') ?>" id="search_associate_keywords" />
        <button class="minibutton"><span><?php echo __('Search')?></span></button>
        <img id="loader" src="/images/ajax/loader.gif" style="vertical-align: middle; display: none" />
      </form>
    </div>
  </div>
  
  <div class="rule"></div>
  
  <div id="associates">
    <?php include_partial('list', array('associates' => $associates))?>
  </div>
</div>
