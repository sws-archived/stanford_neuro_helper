(function ($) {
  Drupal.behaviors.emphasis = {
    attach: function (context, settings) {
      // Code to be run on page load, and
      // on ajax load added here
      $('.view-neuro-research-emphasis .view-content').imagesLoaded(function(){
        $('.view-neuro-research-emphasis .view-content').isotope({
          // options
          itemSelector: '.view-neuro-research-emphasis .views-row',
          masonry: {
            // use element for option
            //columnWidth: 400,
            gutter: 20
          },
          itemPositionDataEnabled: true
        });
      });
      $( document ).ajaxComplete(function() {
        $('.view-neuro-research-emphasis .view-content').imagesLoaded(function(){
          $('.view-neuro-research-emphasis .view-content').isotope({
            // options
            itemSelector: '.view-neuro-research-emphasis .views-row',
            masonry: {
              // use element for option
              //columnWidth: 400,
              gutter: 20
            },
            //itemPositionDataEnabled: true
          });
        });
        $('.view-neuro-research-emphasis .view-content').isotope('reloadItems');
      });
    }
  };
}(jQuery));
