<div class="list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result') ?></p>
  <?php else: ?>
  <table class="associates" cellspacing="0">
    <thead>
        <tr>
          <th colspan="2"><?php echo __('Associate')?></th>
          <th class="data"><?php echo __('Identification')?></th>
          <th class="data"><?php echo __('Category')?></th>
          <th class="data"><?php echo __('Created at')?></th>
        </tr>
        <tr class="sep">
          <td colspan="8"></td>
        </tr>
      </thead>
    <tfoot>
      <tr>
        <th colspan="5">
          <?php if ($pager->haveToPaginate()): ?>
            <?php include_partial('associate_person/pagination', array('pager' => $pager, 'category' => $category)) ?>
          <?php endif; ?>

          <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
          <?php if ($pager->haveToPaginate()): ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage())) ?>
          <?php endif; ?>
        </th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($pager->getResults() as $key=>$associate): ?>
        <tr class="row">
          <td class="gravatar" rowspan="2">
            <?php if ($associate->getPicture()): ?>
            <img src="/uploads/pictures/thumb_<?php echo $associate->getPicture()?>"alt="<?php echo $associate ?>" width="36" height="36"/>
            <?php else: ?>
              <img src="/images/avatar/avatar_small.jpg"alt="<?php echo $associate ?>" width="36" height="36" />
            <?php endif; ?>
          </td>
          <td class="title"><a href="<?php echo url_for('associate_show',$associate)?>"><?php echo $associate?></a></td>
          <td class="data"><?php echo $associate->getIdentification() ?></td>
          <td class="data"><?php echo $associate->getCategory() ?></td>
          <td class="data"><?php echo $associate->getCreatedAt('Y-m-d') ?></td>
        </tr>
        <tr>
          <td colspan="4">
            <?php echo __('Updated at') ?> <?php echo $associate->getUpdatedAt() ?>
          </td>
        </tr>
        <tr class="sep">
          <td></td>
          <td class="border" colspan="4"></td>
        </tr>
        <tr class="sep">
          <td colspan="5"></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif;?>
</div>

