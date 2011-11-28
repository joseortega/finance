<ul class="bignav">
  <li><a <?php if(!$sf_request->getParameter('categoryId')) echo 'class="selected"';?> href="<?php echo url_for('@associate_organization')?>"><span><?php echo __('All') ?></span></a></li>
  <?php foreach ($categories as $category):?>
    <li><a <?php if($category->getId() == $sf_request->getParameter('categoryId')) echo 'class="selected"';?> href="<?php echo url_for('associate_organization/filterByCategory?categoryId='.$category->getId())?>"><?php echo $category ?></a></li>
  <?php endforeach;?>
</ul>