    </main>
    <!--main section end-->
    <!--footer section start-->
    <footer>
      <div class="wrapper">
        <?php
          if (function_exists('custom_menu')) { 
            custom_menu('secondary');
          } else {
            wp_nav_menu(array(
              'theme_location' => 'secondary',
              'menu_class' => 'menu',
              'container' => 'nav',
              'container_class' => 'navbar',
              'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            ));
          }
        ?>
      </div>
    </footer>
    <!--footer section end-->
  </div>
  <!--container end-->
  <?php wp_footer(); ?>
</body>
</html>