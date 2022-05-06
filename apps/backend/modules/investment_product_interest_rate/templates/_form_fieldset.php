
<script type="text/javascript">
  <?php foreach ($form['rate_terms'] as $key=>$rateTime);?>

  var key = <?php print_r($key+1)?>;

  function addRate(key) {
    var r = $.ajax({
      type: 'GET',
      url: '<?php echo url_for('investment_product_interest_rate/addRate')?>'+'<?php echo ($form->getObject()->isNew()?'':'?id='.$form->getObject()->getId()).($form->getObject()->isNew()?'?key=':'&key=')?>'+key,
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
    $('#add_rate').click(function(e) {
        e.preventDefault();
        $("#extra_rates").append(addRate(key));
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
    <?php foreach ($form['rate_terms'] as $key=>$rateTermForm):?>
    <fieldset class="embedded_form">
        <?php echo $rateTermForm->render() ?>
    </fieldset>
    <?php endforeach;?>
    <div id="extra_rates"></div>
    <div><a id="add_rate" href="#" ><?php echo __('Add other')?></a></div>
</fieldset>