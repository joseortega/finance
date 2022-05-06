<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#credit_number_payments').change(function(e) {
      e.preventDefault();
      $('#loader').show();
      $('#amortizations').load(
        '<?php echo url_for('credit_payment/select?id='.$credit->getId())?>',
        { query: this.value},
        function() { $('#loader').hide(); }
      );
    });
  });
</script>

<div class="form">
  <form action="<?php echo url_for('credit_payment/pay?id='.$credit->getId())?>" method="post">
    <?php include_partial('form_fieldset', array('form'=>$form))?>
    <div class="loader">
      <img id="loader" src="/images/ajax/loader.gif" style="vertical-align: middle; display: none; right: 50%; top: -18px;" />
    </div>
    <div id="amortizations">
      <?php include_partial('list', array('amortizations' => $amortizations))?>
    </div>
    <ul class="actions">
      <li><button type="submit" class="classy" onclick="this.disabled=true; this.form.submit();"><span><?php echo __('Effect payment')?></span> </button></li>
    </ul>
  </form>
</div>
