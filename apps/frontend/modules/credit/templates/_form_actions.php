<ul class="actions">
  <?php if($form->isNew()):?>
    <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Create request')?></span> </button></li>
  <?php else:?>
    <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Update credit')?></span> </button></li>
  <?php endif;?>
  
</ul>