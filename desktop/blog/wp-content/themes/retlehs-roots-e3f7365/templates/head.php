<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://www.weiluen.com/desktop/blog/assets/fancybox/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
  <script src="http://www.weiluen.com/desktop/blog/assets/fancybox/jquery.fancybox.pack.js?v=2.1.3"></script>
  <script type="text/javascript" src="http://www.weiluen.com/desktop/blog/assets/fancybox/jquery.fancybox-media.js?v=1.0.5"></script>
  <link rel="stylesheet" href="http://www.weiluen.com/desktop/blog/assets/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
  <script type="text/javascript" src="http://www.weiluen.com/desktop/blog/assets/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script>
  <?php wp_head(); ?>
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
  <script type="text/javascript">  
  $(document).ready(function () {
    $('a').has('img').not(".huangers").addClass("fancybox").attr('rel', 'gallery1');
    $('.fancybox').fancybox({
		padding : 0,
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
});
</script>
<script type="text/javascript">
	$(document).ready(function() {
   	$('.carousel').carousel({ interval: false });
	$('.item').eq(Math.floor((Math.random() * $('.item').length))).addClass("active");
});
</script>
  <?php if (wp_count_posts()->publish > 0) : ?>
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  <?php endif; ?>
</head>