<script type="text/javascript">
  $(document).ready(function() {
    $('.close').click(function(e) {
      e.preventDefault();
      var $elem = $(this);
      $elem.parent().fadeOut('slow', function(){
        $elem.parent().remove()
      });

    });
  });
</script>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo __($sf_user->getFlash('error')) ?><span class="close"><?php echo __('Close')?></span></div>
<?php endif ?>