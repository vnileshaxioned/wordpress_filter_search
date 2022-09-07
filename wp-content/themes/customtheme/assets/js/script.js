(function ($) {
  $(document).ready(function () {
    // pagination
    var postPerPage = $('.post-container').attr('data-posts'),
      pageList = $('.pagination-action-list'),
      page = 0;

    ctaHide(page);
    pageClicked($(pageList[page]), page);

    $('.pagination-action-list').click(function (e) {
      e.preventDefault();
      $('.pagination-action-cta').removeClass('pagination-action-active');
      var ctaClicked = $(this);
      pageClicked(ctaClicked, ctaClicked.index());
    });

    $('.pagination-cta-right').click(function (e) {
      e.preventDefault();
      page++;
      $('.pagination-action-cta').removeClass('pagination-action-active');
      pageClicked($(pageList[page]), page);
    });

    $('.pagination-cta-left').click(function (e) {
      e.preventDefault();
      page--;
      $('.pagination-action-cta').removeClass('pagination-action-active');
      pageClicked($(pageList[page]), page);
    });

    // to page active start here
    function pageClicked(clicked, index) {
      var elementChild = clicked.children('a'),
        ctaOffset = index * postPerPage;
      elementChild.addClass('pagination-action-active');
      ctaHide(ctaOffset, clicked.index());
      pagination(ctaOffset);
      page = index;
    }
    // to page active start here

    // pagination function to call ajax request
    function pagination(offsetStart) {
      $.ajax({
        type: 'post',
        url: ajax.ajaxurl,
        data: {
          action: 'pagination',
          offset: offsetStart,
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

    // for previous & next cta hide start here
    function ctaHide(offset, index = '') {
      paginationCtaHide($('.pagination-cta-left'), offset === 0);
      paginationCtaHide(
        $('.pagination-cta-right'),
        index === $('.pagination-action-list').length - 1
      );
    }

    function paginationCtaHide(element, condition) {
      if (condition) {
        element.hide();
      } else {
        element.show();
      }
    }
    // for previous & next cta hide end here

    // taxonomy sorting
    $('.sorting-tag').click(function () {
      var taxonomy = $(this).attr('data-taxonomy');
      var value = $('.sorting-tag option:selected').val();
      sorting(value, taxonomy);
    });

    $('.sorting-brand').click(function () {
      var taxonomy = $(this).attr('data-taxonomy');
      var value = $('.sorting-brand option:selected').val();
      sorting(value, taxonomy);
    });

    function sorting(sort, taxonomy) {
      var list = $('.taxonomy-column').find('.list-' + taxonomy);
      $('.list-' + taxonomy)
        .parent()
        .append(
          list.sort(function (a, b) {
            if (sort == 'desc') {
              return $(b).text() > $(a).text() ? 1 : -1;
            } else {
              return $(b).text() < $(a).text() ? 1 : -1;
            }
          })
        );
    }

    // for search
    $('.search-input').keypress(function (e) {
      if (e.key == 'Enter') {
        var data = $(this);
        var inputValue = data.val();
        searchFilter('', '', inputValue);
      }
    });

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

      // display filter
      var list = [];
      $.each(clickTagSlug, function (index, value) {
        result = `<li class="selected-filter"><span>${value}</span></li>`;
        list.push(result);
      });
      $('.display-filter').empty().append(list);
    });

    // remove selected filter
    $(document).on('click', '.selected-filter', function () {
      var data = $(this);
      $('.tax-name').each(function () {
        var taxonomy = $(this);
        if (data.text() == taxonomy.attr('data-tax')) {
          taxonomy.trigger('click');
        }
      });
    });

    // clear all filter
    $('.clear-filter').click(function () {
      $('.tax-name').each(function (index, value) {
        var taxonomy = $(value);
        if (taxonomy.is(':checked')) {
          taxonomy.trigger('click');
        }
      });
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
  });
}(jQuery));