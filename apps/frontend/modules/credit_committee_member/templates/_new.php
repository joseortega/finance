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
  <?php echo $committeeMember->getName() ?>
  <a class="remove" href="<?php echo url_for('credit_committee_member/delete?id='.$committeeMember->getId())?>"><?php echo __('X')?></a>
</li>