<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <header>
      <h4 class="entry-title rogo" style="width: 820px; margin-left: -45px;"><?php the_title(); ?></h4>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content" style="margin-bottom:40px;">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      <?php the_tags('<ul class="entry-tags"><li>','</li><li>','</li></ul>'); ?>
    </footer>
    <hr style="width: 100%; margin-top: 10px; position: relative;">
    <div style="width:100%; margin-top:7px;">
    <?php comments_template('/templates/comments.php'); ?></div>
  </article>
<?php endwhile; ?>
</div>