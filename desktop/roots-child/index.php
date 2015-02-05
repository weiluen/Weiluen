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

a:link {color:#333; text-decoration: none;}      /* unvisited link */
a:visited {color:#333; text-decoration: none;}  /* visited link */
a:hover {color:#663399; text-decorationL none;}  /* mouse over link */
a:active {color:#0000FF; text-decorationL none;}  /* selected link */

</style>

<h1 class="title"><a href="http://www.weiluen.com">//WEILUEN</a></h1>
<p><h1 class="title" style="margin-top:-170px;"><a href="http://www.weiluen.com/blog">BLOG</a></h1></p>
<div class="container" style="position:absolute; margin-top:-100px;"> 
<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', get_post_format()); ?>
</div>