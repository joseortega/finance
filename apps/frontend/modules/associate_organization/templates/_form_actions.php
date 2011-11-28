<ul class="actions">
  <?php if($form->getObject()->isNew()):?>
    <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Create organization')?></span> </button></li>
  <?php else:?>
    <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Update info')?></span> </button></li>
  <?php endif;?>
</ul>