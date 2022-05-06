<?php use_helper('I18N', 'Date') ?>

<div id="page_head">
  <div class="title_actions_bar clear_fix">
    <h1><?php echo __('Organizations')?></h1>
    <ul class="actions">
      <li><a  class="minibutton" href="<?php echo url_for('@associate_organization_new')?>"><span><?php echo __('New Organization')?></span></a> </li>
    </ul>
  </div>
  <?php include_partial('nav/associates') ?>
</div>

<div class="columns listcols sidenav clear_fix">
  <?php include_partial('util/flashes') ?>
  <div class="sidebar">
    <?php include_partial('associate_organization/filter_category', array('categories' => $categories))?>
    <div class="rule"></div>
    <div class="filterbox">
      <form action="<?php echo url_for('@associate_organization') ?>" method="get">
        <input type="search" name="query" autocomplete="off" placeholder="<?php echo __('Find associate')?>" value="<?php echo $sf_request->getParameter('query') ?>" id="person_search_keywords" />
        <button class="minibutton" style="display: none"><span><?php echo __('Search')?></span></button>
      </form>
    </div>
  </div>
  <div class="main">
    <div class="title_actions_bar">
      <h3>
        <?php if($category):?>
          <?php echo $category?>
        <?php elseif($sf_request->getParameter('query')):?>
          <?php echo $sf_request->getParameter('query')?>
        <?php else:?>
          <?php echo __('All')?>
        <?php endif;?>
      </h3>
      <ul class="actions">
        <li><a class="minibutton" href="<?php echo url_for('associate_organization/printInPdf?categoryId=')?><?php echo $category ? $category->getId():''?>&query=<?php echo $sf_request->getParameter('query') ?>"><span><?php echo __('Print')?></span></a></li>
      </ul>
    </div>
    <div class="rule"></div>
    <?php include_partial('list', array('pager' => $pager, 'category' => $category)) ?>
  </div>
</div>
