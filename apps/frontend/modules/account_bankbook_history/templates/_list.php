<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
  <?php foreach ($pager->getResults() as $key=>$bankbook): ?>
  
  <?php $classStatus = $bankbook->getIsActive()?'bankbook_opened':'bankbook_closed'?>
  <?php $status = $bankbook->getIsActive()?'active':'inactive'?>
  
  <div class="alert <?php echo $classStatus?>">
    <div class="body">
      <div class="title">
        <a  class="ajax_link" href="<?php echo url_for('account_bankbook_history/show?id='.$bankbook->getId())?>">
          <?php echo __('bankbook')?>
          <?php echo $bankbook->getId()?>
        </a>
        
        <?php echo __('status')?>
        <span><?php echo __($status)?></span>
        
        <?php echo __('print row')?>
        <span><?php echo $bankbook->getPrintRow()?></span>
        <?php echo __('Created at')?> <?php echo $bankbook->getCreatedAt()?>
      </div>
      <div class="detail">
        <div class="message">         
          <ul class="actions print_bankbook"> 
            <li><a href="<?php echo url_for('account_bankbook/printHeader?id='.$bankbook->getId())?>"><span><?php echo __('Print header')?></span></a></li>
            <li><a href="<?php echo url_for('account_bankbook/printContent?id='.$bankbook->getId())?>"><span><?php echo __('Print content')?></span></a></li>
            <li><a href="<?php echo url_for('account_bankbook/printAll?id='.$bankbook->getId())?>"><span><?php echo __('Print all')?></span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>

  <?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('pagination', array('pager' => $pager, 'account'=>$account)) ?>
  <?php endif; ?>

  <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
  <?php if ($pager->haveToPaginate()): ?>
    <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
  <?php endif; ?>

<?php endif;?>
