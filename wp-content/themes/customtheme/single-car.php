<?php
  get_header();
  $id = get_the_ID();
  $permalink = get_the_permalink();
  $title = get_the_title();
  $content = wpautop(get_the_content());
  $tag_taxonomy = 'tag';
  $brand_taxonomy = 'brand';
  $tags = get_the_terms($id, $tag_taxonomy);
  $brands = get_the_terms($id, $brand_taxonomy);

  if ($permalink || $title || $content || $tag_taxonomy || $brand_taxonomy || $tags || $brands) { ?>
  <section class="post-detail">
    <div class="wrapper">
      <?php
        echo $title ? '<h2 class="post-detail-title">'.$title.'</h2>' : null;
        echo $content ? '<div class="post-content">'.$content.'</div>' : null;

        if ($tag_taxonomy || $brand_taxonomy || $tags || $brands) { ?>
        <ul class="table">
          <li class="table-head">
            <?php
              taxonomySorting($tag_taxonomy);
              taxonomySorting($brand_taxonomy);
            ?>
          </li>
          <li class="table-body">
            <?php
              taxonomyName($tags);
              taxonomyName($brands);
            ?>
          </li>
        </ul>
      <?php } ?>
    </div>
  </section>
<?php }
  get_footer();
?>