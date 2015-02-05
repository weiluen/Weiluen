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
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content" style="margin-bottom:40px;">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      <?php the_tags('<ul class="entry-tags"><li>','</li><li>','</li></ul>'); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
</div>