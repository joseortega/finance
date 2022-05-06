<?php include_partial('investment/investment_page_head', array('investment'=>$investment))?>

<div class="columns infocols clear_fix">
  <?php include_partial('util/flashes')?>
  <div class="first">
    <?php include_partial('detail', array('investment' => $investment)) ?>
  </div>
  <div class="last">
    <?php if($investment->getIsCurrent()):?>
      <?php if(!$investment->isExpired()):?>
        <ul class="stats clear_fix">
          <li>
            <strong><?php echo $investment->getDaysToExpire()?></strong>
            <span><?php echo __('Days to expire')?></span>
          </li>
        </ul>
      <?php else:?>
        <ul class="stats clear_fix">
          <li>
            <strong><?php echo $investment->getDaysToExpire()*-1?></strong>
            <span><?php echo __('Days expired')?></span>
          </li>
        </ul>
      <?php endif;?>
    <?php endif;?>
  </div>
  
  <?php if($investment->isExpired()):?>
    <div class="rule"></div>
    <ul class="actions">
      <li><a class="button classy" href="<?php echo url_for('investment_expired/repay?id='.$investment->getId())?>"><span><?php echo __('Accredit to account')?></span></a></li>
    </ul>
  <?php endif;?>
</div>