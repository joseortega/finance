<?php use_helper('I18N', 'Date') ?>

<?php use_javascript('/js/jquery-1.5.min.js') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    //inicialize agency
    jQuery("#autocomplete_agency_id")
    .autocomplete('<?php echo url_for('ajax/ajaxAgency')?>', jQuery.extend({}, {
      dataType: 'json',
      parse:    function(data) {
        var parsed = [];
        for (key in data) {
          parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
        }
        return parsed;
      }
    }))
    .result(function(event, data) { jQuery("#agency_id").val(data[1]); });
    
    //open cash
    jQuery("#autocomplete_cash_id")
    .autocomplete('<?php echo url_for('ajax/ajaxCash')?>', jQuery.extend({}, {
      dataType: 'json',
      parse:    function(data) {
        var parsed = [];
        for (key in data) {
          parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
        }
        return parsed;
      }
    }))
    .result(function(event, data) { jQuery("#cash_id").val(data[1]); });
  });
</script>

<div id="page_head" class="info">
  <div class="title_actions_bar clear_fix">
    <h1>
      <?php echo __('Your connection')?>
    </h1>
  </div>
  <p class="breadcrumb"> 
    <?php echo __('Connection')?>
    <span class="separator"></span>
    <strong><?php echo 'Admin'?></strong>
  </p>
</div>
<div class="columns clear_fix">
  <div class="column_1">
    <!--agency -->
    <h1><?php echo __('Agency')?></h1>
    <div class="rule"></div>
    <?php if(!$sf_user->getAgency()):?>
      <form action="<?php echo url_for('connection/AgencyInicialize') ?>" method="get">
        <input type="hidden" name="agency_id" id="agency_id" />
        <input type="text" name="autocomplete_agency_id" autocomplete="off" placeholder="<?php echo __('Agency name')?>" id="autocomplete_agency_id" />
        <button class="minibutton"><span><?php echo __('Inicialize')?></span></button>
      </form>
    <?php else:?>
      <p><?php echo $sf_user->getAgency()?></p>
      <a class="minibutton" href="<?php echo url_for('connection/agencyReconnect')?>"><span><?php echo __('Reconfigure')?></span></a>
    <?php endif;?>
  </div>
  <div class="column_2">
  <!--cash -->
  <h1><?php echo __('Cash')?></h1>
  <div class="rule"></div>
  <?php if(!$sf_user->getCash()):?>
    <form action="<?php echo url_for('connection/CashOpen') ?>" method="get">
      <input type="hidden" name="cash_id" id="cash_id" />
      <input type="text" name="autocomplete_cash_id" autocomplete="off" placeholder="<?php echo __('Cash name')?>" id="autocomplete_cash_id" />
      <button class="minibutton"><span><?php echo __('Open')?></span></button>
    </form>
  <?php else:?>
    <p><?php echo $sf_user->getCash()?></p>
    <a class="minibutton" href="<?php echo url_for('connection/CashClose')?>"><span><?php echo __('Close')?></span></a>
  <?php endif;?>
  </div>
</div>