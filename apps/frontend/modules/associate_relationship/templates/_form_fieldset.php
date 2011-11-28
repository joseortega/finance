<script type="text/javascript">
        <?php foreach ($form['relations'] as $key=>$relationship);?>

	var key = <?php print_r($key+1)?>;

	function addRelationship(key) {
	  var r = $.ajax({
	    type: 'GET',
	    url: '<?php echo url_for('associate_relationship/addRelationship')?>'+'<?php echo ($form->getObject()->isNew()?'':'?id='.$form->getObject()->getId()).($form->getObject()->isNew()?'?key=':'&key=')?>'+key,
	    async: false
	  }).responseText;
	  return r;
	}

        var removeNew = function(){
            $('.removenew').click(function(e){
                e.preventDefault();
                $(this).parent().parent().parent().parent().parent().parent().remove();
            });
        };

	$().ready(function() {
	  $('#add_relationship').click(function(e) {
              e.preventDefault();
              $("#extra_relationships").append(addRelationship(key));
	    key = key + 1;

            $('.removenew').unbind('click');
                removeNew();
            });

             removeNew();

	});

</script>

<fieldset>
  <?php echo $form['_csrf_token'] ?>
  <?php echo $form['id'] ?>
  <?php foreach ($form['relations'] as $key=>$relationship):?>
    <fieldset class="embedded_form">
      <?php echo $relationship->render()?>
    </fieldset>
  <?php endforeach;?>
  <div id="extra_relationships"></div>
  <div><a id="add_relationship" href="#" ><?php echo __('Add other')?></a></div>

</fieldset>