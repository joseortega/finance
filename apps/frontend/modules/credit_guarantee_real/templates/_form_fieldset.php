<script type="text/javascript">
        <?php foreach ($form['guarantees'] as $key=>$guaranteeNew);?>

	var key = <?php print_r($key+1)?>;

	function addGuarantee(key) {
	  var r = $.ajax({
	    type: 'GET',
	    url: '<?php echo url_for('credit_guarantee_real/addGuaranteeForm')?>'+'<?php echo ($form->getObject()->isNew()?'':'?id='.$form->getObject()->getId()).($form->getObject()->isNew()?'?key=':'&key=')?>'+key,
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
	  $('#add_guarantee').click(function(e) {
              e.preventDefault();
              $("#extra_guarantees").append(addGuarantee(key));
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
                 
    <?php foreach ($form['guarantees'] as $key=>$guarantee):?>
    <fieldset class="embedded_form">
        <?php echo $guarantee->render()?>
    </fieldset>
    <?php endforeach;?>
    <div id="extra_guarantees"></div>
    <div><a id="add_guarantee" href="#" ><?php echo __('Add guarantee')?></a></div>
</fieldset>

