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
           $('#guarantees_personal').append(data);
           $('#autocomplete_guarantee_personal_associate_id').attr('value', '');
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
  <form id="ajax_form" action="<?php echo url_for('credit_guarantee_personal/create?id='.$credit->getId())?>" method="POST">
    <?php echo $form->renderHiddenFields()?>
    <?php echo $form['associate_id']->render()?>  
    <button type="submit" class="minibutton"><span><?php echo __('Add')?></span></button>
  </form>
  <?php echo __('or')?>
  <a class="cancel" href="#"><?php echo __('Cancel')?></a>
</div>


