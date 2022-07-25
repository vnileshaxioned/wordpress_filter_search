<?php
/* This template is used to display header */

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php wp_head() ?>
</head>
<body>
  <div class="container">
    <header>
      <div class="wrapper">
        <h1><a href="<?php bloginfo('url') ?>" class="header-logo" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1>
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_class' => 'navbar',
          'container' => 'nav',
          'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        ) ); ?>
      </div>
    </header>
    <main>