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
  // echo "<pre>";
  // var_dump($query);
  // echo "</pre>";
  if ($query -> have_posts()) { ?>
  <section class="posts">
    <div class="wrapper">
      <?php get_template_part('template-parts/modules/filter/filter'); ?>
      <div class="post-container" data-posts="<?php echo $posts_per_page; ?>">
        <?php
          while ($query -> have_posts()) {
            $query -> the_post();
            $id = get_the_ID();
            $permalink = get_the_permalink();
            $title = get_the_title();
            $excerpt = get_the_excerpt(); 
            $tags = get_the_terms($id, 'tag');
            
            if ($permalink || $title || $excerpt || $tags) { ?>
            <article>
              <?php
                echo ($permalink && $title) ? '<h3><a href="'.$permalink.'" class="post-title" title="'.$title.'">'.$title.'</a></h3>' : null;
                echo $excerpt ? '<p class="content-paragraph">'.$excerpt.'</p>' : null;
                if ($tags) { ?>
              <ul class="cpt_taxonomy">
                <?php
                  foreach ($tags as $tag) {
                    $tag_name = $tag->name;
                    echo $tag_name ? '<li class="taxonomy-list">'.$tag_name.'</li>' : null;
                  }
                ?>
              </ul>
              <?php } ?>
            </article>
          <?php }
            } ?>
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