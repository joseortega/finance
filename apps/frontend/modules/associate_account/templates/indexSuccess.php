<?php include_partial('associate/associate_page_head', array('associate' => $associate))?>

<?php include_partial('list', array('pager'=>$pager, 'associate'=>$associate))?>

<ul class="actions">
  <a class="minibutton" href="<?php echo url_for('account/new?id='.$associate->getId())?>"><span><?php echo __('New account')?></span></a>
</ul>
