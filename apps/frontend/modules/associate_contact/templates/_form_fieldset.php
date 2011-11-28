<script type="text/javascript">
        <?php foreach ($form['phones'] as $key=>$phoneNew);?>

	var key = <?php print_r($key+1)?>;

	function addPhone(key) {
	  var r = $.ajax({
	    type: 'GET',
	    url: '<?php echo url_for('associate_contact/addPhone')?>'+'<?php echo ($form->getObject()->isNew()?'':'?id='.$form->getObject()->getId()).($form->getObject()->isNew()?'?key=':'&key=')?>'+key,
	    async: false
	  }).responseText;
	  return r;
	}

        var removeNew = function(){
            $('.removenew').click(function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });
        };

	$().ready(function() {
	  $('#add_phone').click(function(e) {
              e.preventDefault();
              $("#extra_phones").append(addPhone(key));
	    key = key + 1;

            $('.removenew').unbind('click');
                removeNew();
            });

             removeNew();

	});

</script>

<?php echo $form['_csrf_token'] ?>
<?php echo $form['id'] ?>

<fieldset>
  <div class="form_row">
    <div>
        <?php echo $form['phones']->renderLabel() ?>
        <div class="content">
            <div>
                <?php foreach ($form['phones'] as $key=>$phone):?>
                <fieldset class="phoneNumber">
                  <?php foreach ($phone as $row):?>
                    <?php echo $row->render() ?>
                  <?php endforeach;?>
                </fieldset>
                <?php endforeach;?>
                <div id="extra_phones"></div>
                <div><a id="add_phone" href="#" ><?php echo __('Add phone')?></a></div>
            </div>
        </div>
    </div>
  </div>
</fieldset>

<fieldset>
  <?php echo $form['city_hometown_id']->renderRow() ?>
</fieldset>
<fieldset>
  <?php echo $form['city_current_id']->renderRow() ?>
  <?php echo $form['neighborhood']->renderRow() ?>
  <?php echo $form['address']->renderRow() ?>
  <?php echo $form['website']->renderRow() ?>
</fieldset>