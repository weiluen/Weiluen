<style>
* {
	font-family: open-sans, helvetica, arial;
	font-color:#555;
}

.container {
	width: 900px;
	position: absolute;
	left: 50%;
	margin-left: -450px;
}

.title {
	font-size: 1000%;
}

a:link {color:#333; text-decoration: none;}
a:visited {color:#333; text-decoration: none;}
a:hover {color:#663399; text-decoration: none;} 
a:active {color:#663399; text-decoration: none;}
#box a:link {color:#663399; text-decoration: none;}
#box a:visited {color:#333; text-decoration: none;}
#box a:hover {color:#333; text-decoration: none;} 
#box a:active {color:#333; text-decoration: none;}
</style>

<div style="padding-top: 60px;" class="container">
<h1 class="title"><a href="http://www.weiluen.com">//WEILUEN</a></h1>
<p><h1 class="title" style="margin-top: 70px;"><a href="http://www.weiluen.com/blog">BLOG</a></h1></p>
</div>
<div class="container" id="box" style="margin-top:285px;">
<?php get_template_part('templates/content', 'single'); ?>
</div>