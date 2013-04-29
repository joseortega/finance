<div id="page_head">
  <h1><?php echo __('Data liberation')?></h1>
</div>

<div class="rule"></div>

<div id="backup">
  <p>
    <?php echo __('Finance lets you save a backup the database to your computer.')?>
  </p>
  <a class="button classy" href="<?php echo url_for('backup/backup')?>"><span><?php echo __('Create Archive and Download')?></span></a>
</div>