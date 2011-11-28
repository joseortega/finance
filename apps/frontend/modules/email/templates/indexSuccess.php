<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<script type="text/javascript">
  
  $(document).ready(function() {
    $('#add_link').click(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'GET',
        url: $(this).attr('href'),
        async:false,
        dataType: 'html',
        success: function(data){
          $("#new").append(data);
        }
      });

      $("#add_link").hide();
      $('#new').show();
    });
    
    $('.remove').click(function(e) {
      e.preventDefault();
      var $elem = $(this);
      $.ajax({
        type: 'GET',
        url: $(this).attr('href'),
        async:false,
        dataType: 'html',
        success: function(data){
          $elem.parent().remove();
        }
      })
    });
  });
</script>
  
<?php include_partial('associate/edit_page_head', array('associate'=>$associate)) ?>

<div class="htabs associate clear_fix">
<div class="sidebar">
  <?php include_partial('associate/configuration', array('associate'=>$associate))?>
</div>
<div class="columns typical clear_fix">
  <div class="main">
    <div class="fields">
      <ul id="emails" class="fieldpills">
      <?php foreach ($Emails as $Email): ?>
        <li>
          <?php echo $Email->getAddress() ?>
          <a class="remove" href="<?php echo url_for('email/delete?id='.$Email->getId())?>"><?php echo __('X')?></a>
        </li>
      <?php endforeach; ?>
    </ul>
    <a id="add_link" href="<?php echo url_for('email/new?id='.$associate->getId()) ?>"><?php echo __('Add Email Address')?></a>
    <div id="new" style="display: none">
    </div>
    </div>
    
  </div>
  <div class="sidebar">
    <p>
      <?php echo __('Los emails serviran para enviar notificaciones')?>
    </p>
  </div>
</div>
</div>