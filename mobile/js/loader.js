$(function (window, $, PhotoSwipe) {

// still using live for photoswipe vs. on()/off()
$("div:jqmData(role='page')").live('pageshow', function (e) {

    var currentPage = $(e.target),
        options = { imageScaleMethod: 'fitNoUpscale' },
        // allow multiple galleries
        swipesOnPage = currentPage.find('.gallery-item');

    // no photoswipe, we're done
    if (swipesOnPage.length == 0) {
        return false;
    }

    // if there are swipes init each
    swipesOnPage.each(function (i) {

        // make sure swipe is initialized once in case events bubble
        if ($(this).data('photoswipe') != 'init') {
            $(this).data('photoswipe', 'init');
            // init - make sure you add a class of swipeMe to your images!!
            var photoSwipeInstance = $(this).find('a:has(img)', e.target).photoSwipe(options, currentPage.attr('id'));
        }
        return true;
    });
// un-init when leaving the page
}).live('pagehide', function (e) {

    var currentPage = $(e.target),
        photoSwipeInstance = PhotoSwipe.getInstance(currentPage.attr('id'));

    if (typeof photoSwipeInstance != "undefined" && photoSwipeInstance != null) {
        PhotoSwipe.detatch(photoSwipeInstance);
    }

    return true;
});

}(window, window.jQuery, window.Code.PhotoSwipe));