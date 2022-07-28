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
    <li class="post-list">
      <?php if ($permalink && $title) { ?>
        <h3 class="post-heading">
          <a href="<?php echo $permalink; ?>" class="post-title" title="<?php echo $title; ?>"><?php echo $title; ?></a>
        </h3>
      <?php }
        echo $excerpt ? '<p class="content-paragraph">'.$excerpt.'</p>' : null;
        if ($tags) { ?>
        <ul class="taxonomy">
          <?php
            foreach ($tags as $tag) {
              $tag_name = $tag->name;
              echo $tag_name ? '<li class="taxonomy-list"><span>'.$tag_name.'</span></li>' : null;
            }
          ?>
        </ul>
      <?php } ?>
    </li>
  <?php }
    }
  ?>
