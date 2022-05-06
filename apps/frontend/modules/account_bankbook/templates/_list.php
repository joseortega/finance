<?php if (!$pager->getNbResults()): ?>
  <p><?php echo __('No result') ?></p>
<?php else: ?>
  <?php foreach ($pager->getResults() as $key=>$bankbook): ?>
  
  <?php $classStatus = $bankbook->getIsActive()?'bankbook_opened':'bankbook_closed'?>
  <?php $status = $bankbook->getIsActive()?'active':'inactive'?>
  
  <div class="alert <?php echo $classStatus?>">
    <div class="body">
      <div class="title">
        <a href="<?php echo url_for('account_bankbook_show', $bankbook)?>">
          <?php echo __('bankbook')?>
          <?php echo $bankbook->getId()?>
        </a>
        
        <?php echo __('status')?>
        <span><?php echo __($status)?></span>
        <?php echo __('print row')?>
        
        <span><?php echo $bankbook->getPrintRow()?></span>
        <a href="<?php echo url_for('account_show',$bankbook->getAccount())?>"><?php echo $bankbook->getAccount()->getNumber()?></a>
        /
        <a href="<?php echo url_for('associate_show',$bankbook->getAccount()->getAssociate())?>"><?php echo $bankbook->getAccount()->getAssociate()->getName()?></a>
      </div>
      <div class="detail">
        <div class="message">
          <blockquote><?php echo __('Created at')?> <?php echo $bankbook->getCreatedAt()?></blockquote>
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
  <?php include_partial('account_bankbook/pagination', array('pager' => $pager)) ?>
<?php endif; ?>
<?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
<?php if ($pager->haveToPaginate()): ?>
  <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
<?php endif; ?>
<?php endif;?>