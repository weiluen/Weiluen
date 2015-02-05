<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>James Weiluen Huang</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.1/bootstrap.min.js"></script>
<script src= "http://maps.google.com/maps/api/js?AIzaSyCE1f3YBPCalGD0ae4hZ-jJyxuiUxvKonc&sensor=false"></script>
<script src="js/jquery.localscroll-1.2.7-min.js"></script>
<script src="js/jquery.scrollTo-1.4.3.1-min.js"></script>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<?php
require('blog/wp-blog-header.php');
?>
<script>$('.navbar').scrollspy()</script>
</head>

<body data-spy="scroll" data-target=".navbar" onload="initialize()">
<div class="nav-header">
	<nav class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container" style="margin-top:-1px;">
				<h1 class="brand"> <a href="www.weiluen.com"> <img style="margin-top:-5px;" src="logos/logo6.png"> </a> </h1>
				<div class="nav-collapse">
					<ul style="margin-top:11px;" class="nav pull-right">
						<li class="active"> <a href="#home">Home</a> </li>
						<li> <a href="#story">MY Story</a> </li>
						<li> <a href="#photos">Photos</a> </li>
						<li> <a href="#contact">Contact Me</a> </li>
						<li> <a href="http://wwww.weiluen.com/blog"><img src="http://www.weiluen.com/img/blogl.png" style="margin-top:-10px;" /> Blog</a> </li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</div>
<div id="home" class="hero-unit" style="background: url(http://www.weiluen.com/strip3.jpg); with:100%; height:350px;">
	<div class="container">
		<h1 style="text-align: center; padding-top: 100px;" id="weiluen">//WEILUEN
			<p style="margin:-5px;"><small id="blogging">Writing from the Orient<a href="http://www.facebook.com/huang.w.james"><img style="margin-top:-10px; margin-right: 7px; margin-left:20px;" src="http://www.weiluen.com/img/fbook.png" /></a><a href="http://www.twitter.com/jhuang07"><img style="margin-top:-10px; margin-right: 7px;" src="http://www.weiluen.com/img/twitterl.png" /></a><a href="https://plus.google.com/117143777068871299381"><img style="margin-top:-10px;" src="http://www.weiluen.com/img/gplus.png" /></a></small></p>
		</h1>
	</div>
</div>
<div id="story" class="container"><br />
	<br />
	<br />
	<div class="row-fluid">
		<div class="span12">
			<h2 class="inform">MY STORY</h2>
			<br />
			<br />
			<h4 style="tetxt-align: left;" class="info tab"> Hi! My name is <strong>James Weiluen Huang</strong>. I am a Peace Corps volunteer.</h4>
			<p>
			<h4 class="info">I live on the border of Thailand and Cambodia. I also like nachos.</h4>
			</p>
			<br />
			<div class="row-fluid">
				<div class=span4>
					<h3 class="abouts">About Me</h3>
					<img class="thumbnail" src="img/me.png" alt="">ou will need to create a custom theme. A theme is a set of files used to tell WordPress how to display the site. Using_Themes. Go to your WordPress Themes folder (located at /wp-content/themes/) and create a new folder, call it "mytheme". </div>
				<div class=span4>
					<h3 class="abouts">What Am I Up To?</h3>
					ou will need to create a custom theme. A theme is a set of files used to tell WordPress how to display the site. Using_Themes. Go to your WordPress Themes folder (located at /wp-content/themes/) and create a new folder, call it "mytheme". ou will need to create a custom theme. A theme is a set of files used to tell WordPress how to display the site. Using_Themes. Go to your WordPress Themes folder (located at /wp-content/themes/) and create a new folder, call it "mytheme".ou will need to create a custom theme. A theme is a set of files used to tell WordPress how to display the site. Using_Themes. Go to your WordPress Themes folder (located at /wp-content/themes/) and create a new folder, call it "mytheme". </div>
				<div class=span4>
					<h3 class="abouts">The Disclaimer</h3>
					Because I have to . . . . <br><p><em>The opinions, information, and photos found here are solely my own and are in no way affiliated with the Peace Corps or the government of the United States.</em></p> </div>
			</div>
			<div class="row-fluid">
				<?php
$args = array( 'numberposts' => 3, 'orderby' => 'post_date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?>
				<div class="span4">
					<h3 class="slinks"><a href="<?php the_permalink(); ?>"> <strong>
						<?php the_title(); ?>
						</strong> </a>
						<p style="margin-top:-21px;"><small>
							<?php the_date(); ?>
							</small></p>
					</h3>
					<div class="slinks" style="margin-top:5px;">
						<?php
      	if ( has_post_thumbnail() ) {
	echo get_the_post_thumbnail($post->ID, array(280,200), 'thumbnail');
	print_excerpt(110);
}
else {
	 echo print_excerpt(680);
}
?>
						<a href="<?php the_permalink(); ?>" style="color:#663399">go to post ...</a> </div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="row-fluid">
				<?php
$args = array( 'numberposts' => 3, 'offset'=> 3, 'orderby' => 'post_date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?>
				<div class="span4">
					<h3 class="slinks"><a href="<?php the_permalink(); ?>"> <strong>
						<?php the_title(); ?>
						</strong> </a>
						<p style="margin-top:-21px;"><small>
							<?php the_date(); ?>
							</small></p>
					</h3>
					<div class="slinks" style="margin-top:5px;">
						<?php
      	if ( has_post_thumbnail() ) {
	echo get_the_post_thumbnail($post->ID, array(280,200), 'thumbnail');
	print_excerpt(110);
}
else {
	 echo print_excerpt(680);
}
?>
						<a href="<?php the_permalink(); ?>" style="color:#663399">go to post ...</a> </div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<hr />
<div class="container" id="photos">
	<h2 style="padding-top:80px;" class="inform">PHOTOS</h2>
	<p>
	<h4 class="info tab" style="margin-top: 25px;">These are some selected photos from my Thai life. I've taken them just</h4>
	</p>
	<p>
	<h4 class="info" style="margin-top:;">for you.... sorta. I'll try to update the photos as frequently as possible. Keep</h4></p>
	<p><h4 class="info" style="margin-top:;">checking back! Below you might find photos of elephant riding, crazy edibles,<h4></p> <p><h4 class="info" style="margin-top:;">and giant lizards.</h4>
	</p>
	<div style="margin-top: 50px; margin-bottom:50px;" id="myCarousel" class="carousel slide"> 
		<!-- Carousel items -->
		<div class="carousel-inner">
			<div class="active item"> <img src="http://www.weiluen.com/carousel/flight.jpg" />
				<div class="carousel-caption">
					<h4>In The Clouds</h4>
					<p>On my way to Thailand . . . awaiting untold experiences . . . </p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/greenfields.jpg" />
				<div class="carousel-caption">
					<h4>Host Family</h4>
					<p>Riding in my host family's jeep for the first time</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/sunsetchaopraya.jpg" />
				<div class="carousel-caption">
					<h4>Sunset Over the Chaopraya</h4>
					<p>The view from my hotel room at the Chaisaeng Palace</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/treeroots.jpg" />
				<div class="carousel-caption">
					<h4>Old Ruins In Ayutthaya</h4>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/ruins2.jpg" />
				<div class="carousel-caption">
					<h4>Ruins</h4>
					<p>Taking a stroll into some old ruins. . .</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/watsky.jpg" />
				<div class="carousel-caption">
					<h4>A Wat</h4>
					<p>A wat in friendly Mae La</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/lonefarmer.jpg" />
				<div class="carousel-caption">
					<h4>A Lone Rice Farmer In Sing Buri</h4>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/loneboat.jpg" />
				<div class="carousel-caption">
					<h4>Vacation Time</h4>
					<p>hanging out with my host family on a boat in Sa Kaeo</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/waterfall.jpg" />
				<div class="carousel-caption">
					<h4>Trekking</h4>
					<p>Taking a precarious walk over a roaring waterfall</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/wormdinner.jpg" />
				<div class="carousel-caption">
					<h4>What's For Dinner?</h4>
					<p>A healthy serving of bamboo worms for dinner</p>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/trekflower.jpg" />
				<div class="carousel-caption">
					<h4>A Brilliant Flower</h4>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/giantgolden.jpg" />
				<div class="carousel-caption">
					<h4>A Golden Buddha From Ayutthaya</h4>
				</div>
			</div>
			<div class="item"> <img src="http://www.weiluen.com/carousel/mist.jpg" />
				<div class="carousel-caption">
					<h4>Mist</h4>
					<p>The morning mist in Chiang Rai</p>
				</div>
			</div>
			<!---<div class="item">
    </div>--> 
		</div>
		<!-- Carousel nav --> 
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a> </div>
</div>
<hr id="contact" />
<h2 style="padding-top: 90px;" class="inform">CONTACT ME</h2>
<div class="container">
	<h4 style="padding-top: 40px;" class="info" style="text-align: center;">This is where I stay. I call it my home away from home. Drop me a line!</h4>
</div>
</div>
</div>
<br />
<div id="map_canvas" style="width:100%; height:280px; margin-top: 30px;"></div>
<div class="container" style="padding-top:40px;">
	<div class="row-fluid">
		<div class="span6">
			<h2 style="text-align:center;">CONTACT INFO</h2>
			<div class="row-fluid"><br />
				<address class="span6" style="margin-left:30px;">
				<strong>James Huang</strong><br />
				james.huang@weiluen.com<br />
				jameshuang1789@gmail.com<br />
				<abbr>Phone:</abbr> 090.897.1776<br />
				</address>
				<address class="span5">
				<strong>โรงเรียนทัพพระยาพิทยา</strong><br />
				99หมู่ 8 ต. โคกสูง<br />
				อ. โคกสูง<br />
				สระแก้ว 27120<br />
				</address>
			</div>
			<a href="http://www.facebook.com/huang.w.james"><img style="margin-top:-10px; margin-right: 7px; margin-left:30px;" src="http://www.weiluen.com/img/fbook.png" /></a><a href="http://www.twitter.com/jhuang07"><img style="margin-top:-10px; margin-right: 7px;" src="http://www.weiluen.com/img/twitter.png" /></a><a href="https://plus.google.com/117143777068871299381"><img style="margin-top:-10px;" src="http://www.weiluen.com/img/gplus.png" /></a> </div>
		<div class="span6">
			<h2 style="text-align:center;">EMAIL ME</h2>
			<div class="span6">
				<form action="index.php" method="post" name="myemailform">
					<div class="control-group">
						<label class="control-label" for="inputIcon"></label>
						<div class="controls">
							<div class="input-prepend">
								<label>Full Name:</label>
								<span class="add-on"><i class="icon-user"></i></span>
								<input class="input-xlarge" name="inputName" type="text" placeholder="Your Full Name. . ." />
								<label style="padding-top:10px;">Email Address:</label>
								<span class="add-on"><i class="icon-envelope"></i></span>
								<input class="input-xlarge" name="inputEmail" type="text" placeholder="Your Email Address. . ." />
								<div class="control" style="padding-top:10px;">
									<label>This is where you write a friendly message:</label>
									<textarea class="input-xxlarge pull-left" name="inputMsg" rows="8" placeholder="Type your message here . . ."></textarea>
								</div>
								
								<button class="btn-block btn-primary pull-left" type="submit" value="submit" name="submit">Submit</button>>
								 </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" data-target="#myModal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Message Sent</h3>
	</div>
	<div class="modal-body">
		<p>Thank you for your submission.</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" data-target="#myModal" aria-hidden="true">Close</button>
    </div>
</div>
<div style="margin-top: 50px; width: 100%; height: 200px; background-color:#e6e6e6;" > <a href="#home"><img src="logos/logoabstract.png" style="margin-top:20px; position: absolute; left: 50%; margin-left: -70px;" /> <img src="logos/huang.png" style="margin-top:70px; position: absolute; left: 50%; margin-left: -70px;" /></a></div>
<script>
function initialize() {
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(13.833841, 102.612964),
    disableDefaultUI: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map_canvas"),
       mapOptions);
	var point = new google.maps.LatLng(13.833841, 102.612964);
	var myMarker = new google.maps.Marker({
  		position:point,
  		map:map,
  		title:"Home",
	});
}
$('.carousel').carousel({
  interval: 2500
})
$(document).ready(function() {
   $('.nav').localScroll({duration:900});
})
</script> 
<script src="http://www.weiluen.com/js/gen_validator31.js"></script>
<?php
if(!isset($_POST['submit']))
{

}
  $name = $_POST['inputName'];
  $visitor_email = $_POST['inputEmail'];
  $message = $_POST['inputMsg'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo 'Name and email are mandatory!';
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

    $email_from = 'fyre182@gmail.com';
    $email_subject = "New Form From Personal Site";
    $email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $message  ".
	
  $to = "fyre182@gmail.com";
  $headers = "From: $email_from \r\n";
  $headers .= "Reply-To: $visitor_email \r\n";
  mail($to,$email_subject,$email_body,$headers);
  header("Location:#myModal");
  
  // Function to validate against any email injection attempts
  function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>
</body>

</html>

<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>