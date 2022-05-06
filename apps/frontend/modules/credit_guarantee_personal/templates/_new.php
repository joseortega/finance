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
  <?php if ($guaranteePersonal->getAssociate()->getPicture()): ?>
  <img src="/uploads/pictures/thumb_<?php echo $guaranteePersonal->getAssociate()->getPicture()?>"alt="<?php echo $guaranteePersonal->getAssociate() ?>" width="36" height="36"/>
  <?php else: ?>
    <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $guaranteePersonal->getAssociate()->getPicture() ?>" width="20" height="20" />
  <?php endif; ?>
  <a href="<?php echo url_for('associate_show', $guaranteePersonal->getAssociate())?>"><?php echo $guaranteePersonal->getAssociate()?></a>
  <a class="remove" href="<?php echo url_for('credit_guarantee_personal/delete?credit_id='.$guaranteePersonal->getCreditId().'&associate_id='.$guaranteePersonal->getAssociateId())?>"><?php echo __('X')?></a>
</li>