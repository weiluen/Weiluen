<!DOCTYPE html>
<html>
<head>
<?php include('buffer.php'); ?>
<title>James W Huang</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,italic" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.weiluen.com/mobile/themes/weiluen.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
<link rel="icon" href="http://www.weiluen.com/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.weiluen.com/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="http://www.weiluen.com/icons/apple/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://www.weiluen.com/icons/apple/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://www.weiluen.com/icons/apple/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="http://www.weiluen.com/icons/apple/apple-touch-icon-144x144.png">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>      
<script type="text/javascript" src="http://cdn.jsdelivr.net/klass/1.2.2/klass.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/photoswipe/3.0.5/code.photoswipe.jquery-3.0.5.min.js"></script>
<script type="text/javascript">
(function(window, $, PhotoSwipe){
    $( document ).delegate("div:jqmData(role='page')", "pageinit", function() {
      var options = { imageScaleMethod: 'fitNoUpscale' }
      $('.pophotos').each(function(i, e) { 
              if ($(this).find('a:has(img)').length != 0) {
                    $(this).addClass('yayo');
                }
        });
      $('.yayo').each(function(i, e) {
       PhotoSwipe.attach($(e).find('a:has(img)', options)); 
      });
    });
}(window, window.jQuery, window.Code.PhotoSwipe));
</script>
<?php require('../desktop/blog/wp-blog-header.php'); ?>
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
<body  itemscope itemtype="http://schema.org/Person">
 <div data-role="page" id="home">
  <div data-role="header" data-position="fixed" class="ui-state-persist"> 
    <img style="position:relative; left:50%; margin-left:-62.5px; padding: 3px;" src="http://www.weiluen.com/logos/logo6.png" /> <a style="float: right;" href="#desktop" data-role="button" data-mini="true" class="ui-btn-right desktop"><img src="http://www.weiluen.com/mobile/desktop.png" height="45px" width="45px" style="margin-top:-9px; margin-bottom:-17px; margin-right:-9px; margin-left:-9px;"/></a> </div>
  <div data-role="content" id="home">
    <div data-role="collapsible" data-theme="a" data-content-theme="a" data-iconpos="right" data-collapsed="false" >
      <h2>ABOUT ME</h2>
      <img id="me" style="position:relative; left:50%; margin-left:-140px;" itemprop="image" src="http://www.weiluen.com/img/me.jpg" alt="">
      <p> My name is <strong>James <span itemprop="additionalName">Weiluen</span> Huang</strong>. I graduated from the <span itemprop="alumniOf">University of Texas</span>. And I've been a <span itemprop="jobTitle">volunteer in Thailand</span>. I can speak English, Chinese, and Thai. If you're interested, you can read about my life here. </p>
    </div>
    <div data-role="collapsible" data-theme="a" data-content-theme="a" data-iconpos="right">
      <h2>WHAT I LIKE</h2>
      <p>I like Tom Yum Gung, Dim Sum on Sunday mornings, Schweppes tonic water, Pepsi Max, Coke Zero, old grainy movies, Thai commercials, funny transliterations, classical music, dubstep, 2pac, Biggie Smalls, FM, chess, violins, obscure theories, Thai fashion, Lady Bird Lake, kayaks, Veggie Heaven and the rest of the Drag, food carts, sunsets, golf at Butler Pitch & Putt, crawfish boils, Zatarain's Red Beans and Rice, Anthony Bourdain, Jin, cheese, bizarre foods, obscure philosophers, movies at the movie theatre, little cats, museums, genetics research, NPR, A Way with Words, floating lanterns, powdery beaches, knife shaved noodles, rhinoceros beetles, Sichuan food, giant pandas, patterns, Pancho's, plants and alliteration.</p>
    </div>
    <div data-role="collapsible" data-theme="a" data-content-theme="a" style="font-family: "Open Sans", Helvetica, Arial, sans-serif;" data-iconpos="right"> 
      <h2>THE DISCLAIMER</h2>
      <p> Because I have to put this somewhere . . . .</p>
      <blockquote style="font-family: Helvetica, Arial, sans-serif; font-size:14px;"><em> "The opinions, information, and photos found here are solely my own and are in no way affiliated with the government of the United States."</em><small><cite title="Me" itemprop="name">James Huang</cite></small></blockquote>
    </div>
    <div data-role="collapsible" data-theme="a" data-content-theme="a" style="font-family: "Open Sans", Helvetica, Arial, sans-serif;" data-iconpos="right">
      <h2>CONTACT ME</h2>
      <p style="font-size:14px;"><strong itemprop="name">James Huang</strong><br>
        james.huang@weiluen.com<br>
        jameshuang1789@gmail.com<br>
        091.803.1245 </p>
      <p style="font-size:16px;"> <strong>โรงเรียนทัพพระยาพิทยา</strong><br />
        99หมู่ 8 ต. โคกสูง<br />
        อ. โคกสูง<br />
        สระแก้ว 27120 </p>
         <img src="https://maps.googleapis.com/maps/api/staticmap?center=Khok Sung, Sa Kaeo&amp;zoom=7&amp;size=300x150&amp;markers=Khok Sung, Sa Kaeo|&amp;sensor=false" width="300"  height="150" />
    </div>
  </div> 
  <div data-role="footer" data-id="nav" data-position="fixed" class="ui-state-persist">
    <div data-role="navbar">
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#photos">Photos</a></li>
        <li><a href="#blog" data-prefetch>Blog</a></li>
      </ul>
    </div> 
  </div> 
</div>

<div data-role="page" id="photos">
	  <div data-role="header" data-position="fixed" class="ui-state-persist">
   		 <img style="position:relative; left:50%; margin-left:-62.5px; padding: 3px;" src="http://www.weiluen.com/logos/logo6.png" /> <a style="float: right;" href="#desktop" data-role="button" data-mini="true" class="ui-btn-right desktop"><img src="http://www.weiluen.com/mobile/desktop.png" height="45px" width="45px" style="margin-top:-9px; margin-bottom:-17px; margin-right:-9px; margin-left:-9px;"/></a> 
       </div>
       <div data-role="content" class="pophotos">       		
       		<ul id="Gallery">
               <div class="ui-grid-a">
        					<div class="ui-block-a">
                         		<li><a href="http://www.weiluen.com/mobile/images/full/01.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/01.jpg" alt="" /></a></li>
                        		<li><a href="http://www.weiluen.com/mobile/images/full/02.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/02.jpg" alt="" /></a></li>
                        		<li><a href="http://www.weiluen.com/mobile/images/full/03.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/03.jpg" alt="" /></a></li>
                						<li><a href="http://www.weiluen.com/mobile/images/full/04.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/04.jpg" alt="" /></a></li>
                						<li><a href="http://www.weiluen.com/mobile/images/full/05.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/05.jpg" alt="" /></a></li>
                						<li><a href="http://www.weiluen.com/mobile/images/full/06.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/06.jpg" alt="" /></a></li>
                            </div>
                    <div class="ui-block-b" style="list-style: none;">
                            <li><a href="http://www.weiluen.com/mobile/images/full/07.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/07.jpg" alt="" /></a></li>
                            <li><a href="http://www.weiluen.com/mobile/images/full/08.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/08.jpg" alt="" /></a></li>
                            <li><a href="http://www.weiluen.com/mobile/images/full/10.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/10.jpg" alt="" /></a></li>
                            <li><a href="http://www.weiluen.com/mobile/images/full/11.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/11.jpg" alt="" /></a></li>
                            <li><a href="http://www.weiluen.com/mobile/images/full/12.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/12.jpg" alt="" /></a></li>
                            <li><a href="http://www.weiluen.com/mobile/images/full/13.jpg" rel="external"><img src="http://www.weiluen.com/mobile/images/thumb/13.jpg" alt="" /></a></li>
                   </div>    
                </div>
          </ul>
       </div>
       <div data-role="footer" data-id="nav" data-position="fixed" class="ui-state-persist">
          <div data-role="navbar">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#photos">Photos</a></li>
                <li><a href="#blog" data-prefetch>Blog</a></li>
            </ul>
          </div>
      </div>
</div>

<div data-role="page" id="blog">
  <div data-role="header" data-position="fixed" class="ui-state-persist">
    <img style="position:relative; left:50%; margin-left:-62.5px; padding: 3px;" src="http://www.weiluen.com/logos/logo6.png" /> <a style="float: right;" href="#desktop" data-role="button" data-mini="true" class="ui-btn-right desktop"><img src="http://www.weiluen.com/mobile/desktop.png" height="45px" width="45px" style="margin-top:-9px; margin-bottom:-17px; margin-right:-9px; margin-left:-9px;"/></a> </div>
  <div data-role="content" id="posts">
    <h1 style="font-family: Helvetica, Arial, sans-serif; text-align: center;">LATEST POSTS</h1>
      <?php
      $args = array( 'numberposts' => 5, 'orderby' => 'post_date' );
      $postslist = get_posts( $args );
      foreach ($postslist as $post) :  setup_postdata($post); ?>
    <div class="pophotos" data-role="collapsible" data-theme="a" data-content-theme="a" data-iconpos="right" >
      <h2 style="text-align:left; font-style:normal;"><?php the_date(); ?></h2>
       <h2 style="text-align:center;"><?php the_title(); ?></h2>
       <div style="margin-top:-15px;" ><?php the_content(); ?></div>
    </div>
    <?php endforeach; ?>
  </div> 
  <div data-role="footer" data-id="nav" data-position="fixed" class="ui-state-persist">
      <div data-role="navbar">
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#photos">Photos</a></li>
          <li><a href="#blog" data-prefetch>Blog</a></li>
        </ul>
      </div>
   </div>
</div>


<div data-role="page" id="desktop">
    <div data-role="header" data-position="fixed" class="ui-state-persist">
       <img style="position:relative; left:50%; margin-left:-62.5px; padding: 3px;" src="http://www.weiluen.com/logos/logo6.png" />
       <a style="float: right;" href="#desktop" data-role="button" data-mini="true" class="ui-btn-right desktop"><img src="http://www.weiluen.com/mobile/desktop.png" height="45px" width="45px" style="margin-top:-9px; margin-bottom:-17px; margin-right:-9px; margin-left:-9px;"/></a> 
    </div>
       <div data-role="content">
          <h2>DESKTOP</h2>
          <p>Hi! My name is JAMESBOT. I have determined that you are surfing this website from a mobile platform. If you are on a mobile platform, I believe that the mobile version is the best way to view this website. If you don't agree, feel free to switch by hitting the continue button.</p>
        <a data-role="button" data-inline="true" data-theme="a" href="http://d.weiluen.com" data-icon="arrow-r" data-iconpos="right" rel="external">Continue to Desktop</a>
       </div>
       <div data-role="footer" data-id="nav" data-position="fixed" class="ui-state-persist">
          <div data-role="navbar">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#photos">Photos</a></li>
                <li><a href="#blog" data-prefetch>Blog</a></li>
            </ul>
          </div>
      </div>
</div>
</body>
</html>