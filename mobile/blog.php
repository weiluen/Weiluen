<!DOCTYPE html>
<html>
<head>
    <title>James W Huang</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700,400,300" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://wwww.weiluen.com/mobile/themes/weiluen.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
    <link rel="icon" href="http://www.weiluen.com/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://www.weiluen.com/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="http://wwww.weiluen.com/icons/apple/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://wwww.weiluen.com/icons/apple/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://wwww.weiluen.com/icons/apple/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://wwww.weiluen.com/icons/apple/apple-touch-icon-144x144.png">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <script type="text/javascript" src="http://cdn.jsdelivr.net/klass/1.2.2/klass.min.js"></script>
    <script type="text/javascript" src="http://cdn.jsdelivr.net/photoswipe/3.0.5/code.photoswipe.jquery-3.0.5.min.js"></script>
    <script type="text/javascript">
      (function (window, $, PhotoSwipe) {
          $("div:jqmData(role='page')").live('pageshow', function (e) {
              var currentPage = $(e.target),
                  options = { imageScaleMethod: 'fitNoUpscale' },
                  swipesOnPage = currentPage.find('.gallery-item');
              if (swipesOnPage.length == 0) {
                  return false;
              }
              swipesOnPage.each(function (i) {
                  if ($(this).data('photoswipe') != 'init') {
                      $(this).data('photoswipe', 'init');
                      var photoSwipeInstance = $(this).find('a:has(img)', e.target).photoSwipe(options, currentPage.attr('id'));
                  }
                  return true;
              });
          }).live('pagehide', function (e) {
              var currentPage = $(e.target),
                  photoSwipeInstance = PhotoSwipe.getInstance(currentPage.attr('id'));
              if (typeof photoSwipeInstance != "undefined" && photoSwipeInstance != null) {
                  Code.photoSwipe.detatch(photoSwipeInstance);
              }
              return true;
          });
      }(window, window.jQuery, window.Code.PhotoSwipe));
    </script>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-35869547-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
</head>
<body>
<div data-role="page" id="blog" class="gallery-page">
  <div data-role="header" data-position="fixed" class="ui-state-persist">
    <img style="position:relative; left:50%; margin-left:-62.5px; padding: 3px;" src="logos/logo6.png" />
    <a style="float: right;" href="desktop.html" data-role="button" data-mini="true" class="ui-btn-right">
      <img src="http://www.weiluen.com/mobile/desktop.png" height="45px" width="45px" style="margin-top:-9px; margin-bottom:-17px; margin-right:-9px; margin-left:-9px;"/>
    </a> 
  </div>
  <div data-role="content" id="posts">
    <h1 style="font-family: Open Sans, Helvetica, Arial, sans-serif; text-align:center;">LATEST POSTS</h1>
    <?php
require('../blog/wp-blog-header.php');
$args = array( 'numberposts' => 5, 'orderby' => 'post_date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?>
    <div data-role="collapsible" data-theme="a" data-content-theme="a" data-iconpos="right" >
          <h2 style="text-align:left;"><?php the_date(); ?></h2>
      <p>
        <h2 style="text-align:center;"><?php the_title(); ?></h2>
        <div style="margin-top:-15px;" class="gallery-item"><?php the_content(); ?></div>
      </p>
    </div>
    <?php endforeach; ?>
  </div> 
  <div data-role="footer" data-id="nav" data-position="fixed" class="ui-state-persist">
      <div data-role="navbar">
        <ul>
          <li><a href="index.html" data-ajax="false">Home</a></li>
          <li><a href="photos.html" data-ajax="false" data-prefetch="true">Photos</a></li>
          <li><a href="#">Blog</a></li>
        </ul>
      </div>
   </div>
</div>
</body>
</html>