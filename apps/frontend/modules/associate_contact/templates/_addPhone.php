<fieldset class="phoneNumber">
  <?php foreach ($form['phones'][$key] as $row):?>
    <?php echo $row->render() ?>
  <?php endforeach;?>
</fieldset>
