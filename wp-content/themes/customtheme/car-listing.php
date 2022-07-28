<?php

/* Template Name: Car Listing */

  get_header();

  $posts_per_page = 10;
  $args = array(
    'post_type' => 'car',
    'orderby' => 'title',
    'order' =>'ASC',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page
  );
  $query = new WP_Query( $args );

  if ($query -> have_posts()) { ?>
  <section class="posts">
    <div class="wrapper">
      <?php get_template_part('template-parts/modules/filter/filter'); ?>
      <ul class="post-container" data-posts="<?php echo $posts_per_page; ?>">
        <?php
          $args = array('query' => $query);
          get_template_part('template-parts/modules/filter/content', 'display-filter', $args);
        ?>
      </ul>
    </div>
  </section>
<?php } else { ?>
  <section class="posts">
    <div class="wrapper">
      <p>No posts are available</p>
    </div>
  </section>
<?php }
  wp_reset_postdata();
  get_footer();
?>