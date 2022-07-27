<?php
if ($query->have_posts()) {
  while ($query->have_posts()) {
  $query->the_post();
  $id = get_the_ID();
  $permalink = get_the_permalink();
  $title = get_the_title();
  $excerpt = get_the_excerpt(); 
  $tags = get_the_terms($id, 'tag');
  
  if ($permalink || $title || $excerpt || $tags) {
    $result = ($permalink && $title) ? '<article><h3><a href="'.$permalink.'" class="post-title" title="'.$title.'">'.$title.'</a></h3>' : null;
    $result .= $excerpt ? '<p class="content-paragraph">'.$excerpt.'</p>' : null;
    if ($tags) {
    $result .= '<ul class="cpt_taxonomy">';
      foreach ($tags as $tag) {
        $tag_name = $tag->name;
        $result .= $tag_name ? '<li class="taxonomy-list">'.$tag_name.'</li>' : null;
      }
    $result .= '</ul></article>';
    }
    echo $result;
  }
  } wp_reset_postdata();
}
?>