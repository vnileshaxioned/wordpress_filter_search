<?php

/* Template Name: Car Listing */

  get_header();

  $posts_per_page = 10;
  $args = array(
    'post_type' => 'car',
    'orderby' => 'title',
    'order' =>'ASC',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
    'tax_query' => array(
      'relation' => 'OR',
      array(
        'taxonomy' => 'tag',
        'field' => 'slug',
        'terms' => array('minivan', 'Hatchback')
      )
    )
  );

  $query = new WP_Query( $args );
  if ($query -> have_posts()) { ?>
  <section class="posts">
    <div class="wrapper">
      <?php get_template_part('template-parts/modules/filter/filter'); ?>
      <div class="post-container" data-posts="<?php echo $posts_per_page; ?>">
        <?php
          while ($query -> have_posts()) {
            $query -> the_post();
            $permalink = get_the_permalink();
            $title = get_the_title();
            $excerpt = get_the_excerpt(); ?>
            <article>
              <h3><a href="<?php echo $permalink; ?>" class="post-title" title="<?php echo $title; ?>"><?php echo $title; ?></a></h3>
              <p class="content-paragraph"><?php echo $excerpt; ?></p>
            </article>
          <?php } ?>
        </div>
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
    get_footer(); ?>