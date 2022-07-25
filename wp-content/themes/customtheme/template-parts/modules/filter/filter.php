<?php
  function customTaxonomy($name) {
    $all_tax = get_terms(array(
      'taxonomy' => $name,
      'hide_empty' => true,
    ));
    foreach ($all_tax as $tax_list) {
      $tax_slug = $tax_list->slug;
      $tax_name = $tax_list->name;
      ?>
      <li class="taxonomy">
        <input type="checkbox" class="tax-name" id="<?php echo $tax_slug; ?>" data-name="<?php echo $name; ?>" data-tax="<?php echo $tax_slug; ?>" />
        <label for="<?php echo $tax_slug; ?>"><?php echo $tax_name; ?></label>
      </li>
    <?php }
  }
?>
<div class="filter">
  <div class="search">
    <input type="text" class="search-input" placeholder="Search" />
  </div>
  <ul class="display-filter"></ul>
  <div class="clear">
    <input type="submit" class="clear-filter" value="Clear all" />
  </div>
  <ul class="brand">
    <h2>Brands</h2>
    <?php customTaxonomy('brand'); ?>
  </ul>
  <ul class="filter">
    <h2>Tags</h2>
    <?php customTaxonomy('tag'); ?>
  </ul>
</div>