
<?php include_partial('associate/edit_page_head', array('associate'=>$associate)) ?>

<div class="htabs associate clear_fix">
  <div class="sidebar">
    <?php include_partial('associate/configuration', array('associate'=>$associate)) ?>
  </div>
  <div class="main">
    <div class="ejector">
      <h2><?php echo __('Delete this associate')?></h2>
      <div class="ejector-content">
        <p><?php echo __('Once you delete an associate, there is no going back. Please be certain.')?></p>
        <?php echo link_to('<span>'.__('Delete this associate').'</span>', 'associate/delete?id='.$associate->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class'=>'button classy danger')) ?>
      </div>
    </div>
  </div>
</div>
