<div id="page_head">

  <h1><?php echo __('Configuration')?></h1>

  <?php include_partial('nav/config') ?>
  
</div>

<div class="columns newcols clear_fix">
  <div class="main">
    <?php include_partial('util/flashes') ?>
    <?php include_partial('form', array('form' => $form, 'name'=> $name)) ?>
  </div>
  <div class="sidebar">
    <div class="note">
      <p><?php echo __('Configure el título para impresión de documentos')?></p>
    </div>
  </div>
</div>

