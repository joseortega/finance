<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php use_javascript('/js/jquery-1.5.min.js', 'first') ?>
    <?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
    <?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="container">
      <div id="header" class="admin">
        <div class="site">
          <a class="logo" href="<?php echo url_for('@homepage')?>">
            <img alt="fynance" src="/images/header/logoadmin.png"></img>
          </a>
          <?php if ($sf_user->isAuthenticated()): ?>
            <div class="userbox">
              <div class="avatarname">
                <?php echo __('Welcome') ?> <?php echo $sf_user->getUsername()?>
              </div>
              <ul class="usernav clear_fix">
                <li><a href="<?php echo url_for('/user')?>"><?php echo __('Configuration')?></a></li>
                <li><a href="<?php echo url_for('/help/index')?>"><?php echo __('Help')?></a></li>
                <li><a href="<?php echo url_for('backup/index')?>"><?php echo __('Backup')?></a></li>
                <li><?php echo link_to(__('Log Out'), 'sf_guard_signout') ?></li>
              </ul>
            </div>
            <ul class="nav clear_fix">
              <li><a href="<?php echo url_for('/associate_person')?>"><?php echo __('Go to application')?></a></li>
              <li><a href="<?php echo url_for('@account_product')?>"><?php echo __('Accounts')?></a></li>
              <li><a href="<?php echo url_for('@credit_product')?>"><?php echo __('Credits')?></a></li>
              <li><a href="<?php echo url_for('@investment_product')?>"><?php echo __('Investments')?></a></li>
              <li><a href="<?php echo url_for('@country')?>"><?php echo __('Location')?></a></li>
              <li><a href="<?php echo url_for('@agency')?>"><?php echo __('General')?></a></li>
              <li><a href="<?php echo url_for('@sf_guard_user')?>"><?php echo __('Users')?></a></li>
              <li><a href="<?php echo url_for('@category')?>"><?php echo __('Associates')?></a></li>
              <li><a href="<?php echo url_for('@accounting_exercise')?>"><?php echo __('Contabilidad')?></a></li>
            </ul>
          <?php else:?>
            <ul class="nav logged_out clear_fix">
              <li><a href="<?php echo url_for('/about/index')?>"><?php echo __('Financial Project')?></a></li>
              <li><a href="<?php echo url_for('/help/index')?>"><?php echo __('Help')?></a></li>
              <li><?php echo link_to(__('Sign in'), 'sf_guard_signin') ?></li>
            </ul>
          <?php endif;?>
        </div>
      </div>
      <div id="main">
        <div class="site">
          <?php echo $sf_content ?>
        </div>
      </div>
      <div id="footer">
        <div class="site">
          <a class="sponsor" href="#">2011 finance project</a>
          <ul class="links">
            <li><a href="<?php echo url_for('/about/index')?>"><?php echo __('About')?></a></li>
            <li><a href="<?php echo url_for('/help/index')?>"><?php echo __('Help')?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>