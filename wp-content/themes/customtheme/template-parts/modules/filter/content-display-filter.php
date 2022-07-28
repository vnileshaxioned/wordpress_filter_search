<?php
  $query = $args['query'];
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
    }
?>