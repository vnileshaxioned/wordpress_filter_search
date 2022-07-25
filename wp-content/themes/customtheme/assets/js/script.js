(function ($) {

  // for tab filter and search function for a work page
  // searchFilter();

  // for tab filter
  var clickTagName = [];
  $('.tax-name').click(function (e) {
    e.preventDefault();
    var data = $(this);
    var tagName = data.attr('data-name');
    var tagSlug = data.attr('data-tax');

    console.log($.inArray(tagSlug, clickTagName));
    if ($.inArray(tagSlug, clickTagName) != -1) {
      clickTagName.splice($.inArray(tagSlug, clickTagName), 1);
    } else {
      clickTagName.push(tagSlug);
    }
    console.log(clickTagName)
    searchFilter(clickTagName, tagName, '');
  });

  // searchFilter function to call ajax request
  function searchFilter(tagSlug, tagName, search) {
    var postPerPage = $('.post-container').attr('data-posts');
    $.ajax({
      type: 'post',
      url: ajax.ajaxurl,
      data: {
        action: 'filter_search',
        tag_name: tagName,
        tag_slug: tagSlug,
        search: search,
        post_per_page: postPerPage,
      },
      datatype: 'json',
      success: function (response) {
        console.log(response);
        if (response.length) {
          $('.post-container').html(response);
        } else {
          $('.post-container').html('<li><span>No Search found</span></li>');
        }
      },
      error: function (xhr, status, error) {
        alert('Status: ' + xhr.status + ' ' + error);
      },
    });
  }
}(jQuery));