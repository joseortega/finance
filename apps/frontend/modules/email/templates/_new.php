<?php use_javascript('/js/jquery-1.5.min.js') ?>
<script type="text/javascript">
  $(document).ready(function() {
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

<li>
  <?php echo $Email->getAddress() ?>
  <a class="remove" href="<?php echo url_for('email/delete?id='.$Email->getId())?>"><?php echo __('X')?></a>
</li>