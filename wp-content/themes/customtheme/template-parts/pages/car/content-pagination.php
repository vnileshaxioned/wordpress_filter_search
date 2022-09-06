<?php
  $total_post = $args['total_post'];
  $show_post = $args['show_post'];
  $current_page = 0;
  $pages = ceil($total_post/$show_post);
  if (($show_post < $total_post) && ($show_post != $total_post)) {
?>
  <ul class="pagination-action">
    <?php
      for ($current_page = 0; $current_page < $pages; $current_page++) {
        $page = $current_page + 1;
      ?>
      <li class="pagination-action-list">
        <a href="#FIXME" class="pagination-action-cta" title="<?php echo 'Page '.$page; ?>"><?php echo $page; ?></a>
      </li>
    <?php } ?>
  </ul>
  <ul class="pagination">
    <li class="pagination-list">
      <a href="#FIXME" class="pagination-cta pagination-cta-left" title="Previous">Previous</a>
    </li>
    <li class="pagination-list">
      <a href="#FIXME" class="pagination-cta pagination-cta-right" title="Next">Next</a>
    </li>
  </ul>
<?php } ?>