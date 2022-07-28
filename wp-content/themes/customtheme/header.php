<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php wp_head(); ?>
</head>
<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <div class="wrapper">
        <h1><a href="<?php bloginfo('url'); ?>" class="header-logo" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php
          if (function_exists('custom_menu')) { 
            custom_menu('primary');
          } else {
            wp_nav_menu(array(
              'theme_location' => 'primary',
              'menu_class' => 'menu',
              'container' => 'nav',
              'container_class' => 'navbar',
              'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            ));
          }
        ?>
      </div>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>