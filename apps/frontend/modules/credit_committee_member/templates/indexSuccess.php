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
  
<?php include_partial('credit/edit_page_head', array('credit'=>$credit)) ?>

<div class="htabs associate clear_fix">
<div class="sidebar">
  <?php include_partial('credit/configuration', array('credit'=>$credit))?>
</div>
<div class="columns typical clear_fix">
  <div class="main">
    <div class="fields">
      <ul id="committee_members" class="fieldpills">
      <?php foreach ($committeeMembers as $committeeMember): ?>
        <li>
          <?php echo $committeeMember->getName() ?>
          <a class="remove" href="<?php echo url_for('credit_committee_member/delete?id='.$committeeMember->getId())?>"><?php echo __('X')?></a>
        </li>
      <?php endforeach; ?>
    </ul>
    <a id="add_link" href="<?php echo url_for('credit_committee_member/new?id='.$credit->getId()) ?>"><?php echo __('Add Member')?></a>
    <div id="new" style="display: none">
    </div>
    </div>
    
  </div>
  <div class="sidebar">
    <p>
      <?php echo __('Añada los miembros del comité para la aprobación de este crédito')?>
    </p>
  </div>
</div>
</div>