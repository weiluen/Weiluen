<link href="http://fonts.googleapis.com/css?family=Open+Sans:700,400,300" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500">
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
<script type="text/javascript" src= "http://maps.google.com/maps/api/js?AIzaSyD_DYao5a_ZL-BCis1JHxwU1Cz5EhTdGiU&sensor=false"></script>
<script type="text/javascript">
function initialize() {
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(13.693777,100.543439),
    disableDefaultUI: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map_canvas"),
       mapOptions);
	var point = new google.maps.LatLng(13.693777,100.543439);
	var myMarker = new google.maps.Marker({
  		position:point,
  		map:map,
  		title:"Khao San Rd.",
	});
}
</script>
<style>
.navbarcontainer {
	position: absolute;
	margin-left: -585px;
}
</style>
<body onload="initialize()"> 
  <div style="font-family: 'Open Sans', Helvetica Neue, Helvetica, Sans-serif; font-size:18px;">
  <div class="hero-unit" style="margin-top: 130px; padding-bottom: 15px;">
    <h1 style="text-align:center;">Error 404</h1>
    <h3>Where you go? Khao San Road?</h3>
    <p>You've arrived here by error. Let me help you get to where you need to go.</p> 
    <div id="map_canvas" style="width:100%; height:280px;"></div>
    <br>
    <a href="http://weiluen.com/desktop/blog" class="btn btn-primary btn-large pull-right" style="color: #fff;">Go Back To Site</a>
    <?php get_search_form( $echo ); ?>
  </div>
 </div>
</body>