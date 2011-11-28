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

[?php if ($sf_user->hasFlash('notice')): ?]
  <div class="notice">[?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?]<span class="close">[?php echo __('Close')?]</span></div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('error')): ?]
  <div class="error">[?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?]</div>
[?php endif; ?]
