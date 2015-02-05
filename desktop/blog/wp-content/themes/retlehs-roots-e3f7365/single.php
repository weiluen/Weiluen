<style>
 entry-title {font-size: 4em; color: #fff; margin-top:-75px;}
.fancybox > img {
   -webkit-filter: grayscale(90%);
}
.fancybox > img:hover {  
    -webkit-filter: grayscale(0%);
-webkit-transition:-webkit-filter 0.5s;  
}  
a, img {
    border:none;
}
</style>
<link href="http://www.weiluen.com/desktop/blog/assets/css/gridpak.css" rel="stylesheet" type="text/css">
<div class="nav-header">
  <nav class="navbar navbar-fixed-top">
    <div class="navbar-inner" style="height: 61px;">
      <div class="navbarcontainer">
        <h1 class="brand"> <a href="http://d.weiluen.com/" class="huangers"> <img style="margin-top:-5px;" class="huangers" src="http://www.weiluen.com/logos/logo6.png"> </a> </h1>
        <div class="nav-collapse">
          <ul style="margin-top:11px;" class="nav pull-right">
            <li> <a href="http://d.weiluen.com/#home">Home</a> </li>
            <li> <a href="http://d.weiluen.com/#story">My Story</a> </li>
            <li> <a href="http://d.weiluen.com/#photos">Photos</a> </li>
            <li> <a href="http://d.weiluen.com/#contact">Contact Me</a> </li>
            <li class="active"> <a href="http://www.weiluen.com/desktop/blog">
              <div class="blogl pull-right" style="margin-left:6px; margin-top:-4px;"></div>
              <span class="pull-left">Blog</span></a> </li>
          </ul>
        </div>
      </div>
    </div>	
</div>
<div class="container">
    <div style="width: 1080px; height: 550px; margin-left: -130px;" id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
      <div class="item"> <img src="http://www.weiluen.com/img/blogcover/tea.jpg" /></div>
      <div class="item"> <img src="http://www.weiluen.com/img/blogcover/boats.jpg" /></div>
      <div class="item"> <img src="http://www.weiluen.com/img/blogcover/walk.jpg" /></div>
      <div class="item"> <img src="http://www.weiluen.com/img/blogcover/bangkok.jpg" /></div>
    </div>
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>
<div class="container">
   <div id="shaded" style="background: rgba(0, 0, 0, 0);">
   <div style="position: relative; margin-left: 24px;">
      <a href="http://weiluen.com/desktop/blog"><h3 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #fff; font-weight:1000; letter-spacing:-20px; margin: -105px -45px; font-size: 20em;">BLOG</h3></a></div>
    </div>
<div id="box" style="position:relative; margin: 80px 0px 55px; background-color: #fff; padding-bottom: 15px;" class="shadow">
<div style="padding: 0px 15px; padding-top: 1px;">
	<?php get_template_part('templates/content', 'single'); ?>
	<style>.rogo {background: rgba(20, 20, 20, 1); padding: 10px 30px 5px; text-align: center; font:-family: 'Helvetica Neue', Helvetica, Arial; font-size: 40px; margin: -30px;}
		.rocker {margin-top: 40px;}
		a:visited {color: #663399;}
	</style>
</div>
</div>