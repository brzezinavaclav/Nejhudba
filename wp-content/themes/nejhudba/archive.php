<?php get_header(); ?>
<div class="container" id="content">
<div style="margin-bottom:10px;text-align: center;">
<?php dynamic_sidebar(sidebar_top); ?>
</div>
<div class="col-md-9">
<h1 style="margin-bottom: 25px;"><?php single_month_title(' '); ?> </h1>
<?php while ( have_posts() ) : the_post();?>
<div class="col-md-6 tile">
<div style="min-height:90px;  position:relative">
<a href="<?php the_permalink(); ?>">
<?php 
if ( has_post_thumbnail() ) { 
	the_post_thumbnail(array(70, 70), array('style' => 'float: left; margin: 0px 10px 6px 0px'));
} 
else{
	echo '<img src="'.get_template_directory_uri().'/img/logo.jpg" style="float: left; margin: 0px 10px 5px 0px" width="70" height="70">';
}
?>
</a>
<div style="max-height: 40px; overflow-y: hidden">
<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
</div>
<div style="position:absolute; bottom: 25px; width: 100%; padding-left: 80px">
<a style="color:#fff" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a><a style="color:#fff;float:right;"><?php the_time('d. m. Y'); ?></a>
</div>
</div>
</div>
<?php endwhile; ?>
<div style="margin-top: 30px">
<span style="float: left"><?php previous_posts_link(); ?></span>
<span style="float: right"><?php next_posts_link(); ?></span>
</div>
</div>
<div class="col-md-3">
<h1 style=" margin-bottom: 15px">Nejhudba na facebooku</h1>
<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FNejhudba.cz&amp;width&amp;height=245&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=242905692574799" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:245px;box-shadow: none" allowTransparency="true"></iframe>
<?php dynamic_sidebar(sidebar_right); ?>
</div>
</div>
<div style="margin-bottom:10px;text-align: center;">
<?php dynamic_sidebar(sidebar_bottom); ?>
</div>
<?php get_footer();  ?>