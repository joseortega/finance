<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript">
  $(document).ready(function() {         
    $('#ajax_form').submit(function(e){
     e.preventDefault();
       $.ajax({
         type: "POST",
         url: $(this).attr("action"),
         data: $(this).serialize(),
         success: function(data){
           $('#committee_members').append(data);
           $('#committee_member_name').attr('value', '');
         }
       })
    });
    
    $('.cancel').click(function(e){
      $('.cancel').parent().remove();
      $("#add_link").show();
      $('#new').hide();
    })

  });
</script>

<div class="form">
  <form id="ajax_form" action="<?php echo url_for('credit_committee_member/create?id='.$credit->getId()) ?>" method="POST">
    <?php echo $form->renderHiddenFields(false) ?>
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form['name']->renderError() ?>
    <?php echo $form['name']->render()?>  
    <button type="submit" class="minibutton"><span><?php echo __('Add')?></span></button>
  </form>
  <?php echo __('or')?>
  <a class="cancel" href="#"><?php echo __('Cancel')?></a>
</div>


