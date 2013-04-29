<ul class="bignav">
  <li><a <?php if(!$sf_request->getParameter('categoryId') && !$sf_request->getParameter('query')) echo 'class="selected"';?> href="<?php echo url_for('@associate_person')?>"><span><?php echo __('All') ?></span></a></li>
  <?php foreach ($categories as $category):?>
    <li><a <?php if($category->getId() == $sf_request->getParameter('categoryId')) echo 'class="selected"';?> href="<?php echo url_for('@associate_person') ?>?categoryId=<?php echo $category ? $category->getId():''?>"><?php echo $category ?></a></li>
  <?php endforeach;?>
</ul>