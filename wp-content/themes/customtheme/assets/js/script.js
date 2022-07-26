(function ($) {

  // for search
  $('.search-input').keypress(function (e) {
    if (e.key == 'Enter') {
      var data = $(this);
      var inputValue = data.val();
      searchFilter('', '', inputValue);
    }
  });;

  // for filter
  var clickTagSlug = [];
  var clickTagName = [];
  $('.tax-name').click(function () {
    var data = $(this);
    var tagName = data.attr('data-name');
    var tagSlug = data.attr('data-tax');

    if ($.inArray(tagName, clickTagName) == -1) {
      clickTagName.push(tagName);
    }
    
    if ($.inArray(tagSlug, clickTagSlug) != -1) {
      clickTagSlug.splice($.inArray(tagSlug, clickTagSlug), 1);
    } else {
      clickTagSlug.push(tagSlug);
    }
    searchFilter(clickTagSlug, clickTagName, '');
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