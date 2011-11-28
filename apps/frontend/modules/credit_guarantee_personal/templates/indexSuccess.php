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

<?php include_partial('credit/edit_page_head', array('credit'=>$credit))?>


<div class="htabs credit clear_fix">
  <div class="sidebar">
    <?php include_partial('credit/configuration', array('credit'=>$credit))?>
  </div>
  <div class="columns typical clear_fix">
    <div class="main">
      <div class="fields">
        <ul id="guarantees_personal" class="fieldpills associatesname">
          <?php foreach ($guaranteePersonals as $guaranteePersonal):?>
            <li>
              <?php if ($guaranteePersonal->getAssociate()->getPicture()): ?>
              <img src="/uploads/pictures/thumb_<?php echo $guaranteePersonal->getAssociate()->getPicture()?>"alt="<?php echo $guaranteePersonal->getAssociate() ?>" width="36" height="36"/>
              <?php else: ?>
                <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $guaranteePersonal->getAssociate()->getPicture() ?>" width="20" height="20" />
              <?php endif; ?>
              <a href="<?php echo url_for('associate_show', $guaranteePersonal->getAssociate())?>"><?php echo $guaranteePersonal->getAssociate()?></a>
              <a id="" class="remove" href="<?php echo url_for('credit_guarantee_personal/delete?credit_id='.$guaranteePersonal->getCreditId().'&associate_id='.$guaranteePersonal->getAssociateId())?>"><?php echo __('X')?></a>
            </li>
          <?php endforeach;?>
        </ul>
      <a id="add_link" href="<?php echo url_for('credit_guarantee_personal/new?id='.$credit->getId()) ?>"><?php echo __('Add Guarantee Personal')?></a>
      <div id="new" style="display: none">
      </div>
      </div>
    </div>
    <div class="sidebar">
      <p>
        <?php echo __('Las garantías personales o sobre firma debe ser socio o cliente de su empresa')?>
      </p>
    </div>
  </div>
</div>