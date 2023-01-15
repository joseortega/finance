 <?php echo $form['_csrf_token'] ?>
 <?php echo $form['id'] ?>
<div class="columns equacols bordered infocols clear_fix">
    <div class="first">
         <?php echo $form['code']->renderRow() ?>
         <?php echo $form['reference']->renderRow() ?>
    </div>
    <div class="last">
        <?php echo $form['date']->renderRow() ?>
        <?php echo $form['observation']->renderRow() ?>
    </div>
</div>

<div class="rule"></div>

<div class="columns equacols infocols clear_fix">
    <div class="column_first">
        Cuenta
    </div>
    <div class="column_medium">
        Debe
    </div>
    <div class="column_last">
        Haber
    </div>
</div>

<div class="rule"></div>

<fieldset>
  <div class="form_row">
    <div>
        <?php foreach ($form['voucher_items'] as $key=>$voucherItem):?>
            <div class="columns equacols infocols clear_fix">
                <div class="column_first">
                    <?php echo $voucherItem['accounting_account_id']->render() ?>
                </div>
                <div class="column_medium">
                    <?php echo $voucherItem['debit']->render() ?>
                </div>
                <div class="column_last">
                    <?php echo $voucherItem['credit']->render() ?>
                </div>
            </div>
        <?php endforeach;?>
        <div id="extra_phones"></div>
        <div><a id="add_phone" href="#" ><?php echo __('Add phone')?></a></div>
    </div>
  </div>
</fieldset>
