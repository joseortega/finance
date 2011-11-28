<div class="pagination">
  <a href="<?php echo url_for('@associate_person') ?>?categoryId=<?php echo $category ? $category->getId():''?>&page=1">
    <img src="/images/common/first.png" alt="First page" title="First page" />
  </a>

  <a href="<?php echo url_for('@associate_person') ?>?categoryId=<?php echo $category ? $category->getId():''?>&page=<?php echo $pager->getPreviousPage() ?>">
    <img src="/images/common/previous.png" alt="Previous page" title="Previous page" />
  </a>

  <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
      <a href="<?php echo url_for('@associate_person') ?>?categoryId=<?php echo $category ? $category->getId():''?>&page=<?php echo $page ?>"><?php echo $page ?></a>
    <?php endif; ?>
  <?php endforeach; ?>

  <a href="<?php echo url_for('@associate_person') ?>?categoryId=<?php echo $category ? $category->getId():''?>&page=<?php echo $pager->getNextPage() ?>">
   <img src="/images/common/next.png" alt="Next page" title="Next page" />
  </a>

  <a href="<?php echo url_for('@associate_person') ?>?categoryId=<?php echo $category ? $category->getId():''?>&page=<?php echo $pager->getLastPage() ?>">
    <img src="/images/common/last.png" alt="Last page" title="Last page" />
  </a>
</div>
