<?php get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&appId=242905692574799&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container" id="content">
<div style="margin-bottom:10px;text-align: center;">
<?php dynamic_sidebar(sidebar_top); ?>
</div>
<div class="col-md-9">
<h1 style="margin-top: 10px">
<?php
$rating_value = get_post_meta( get_the_ID(), 'rating_meta_value_key', true );
the_title();
?> 
</h1>
<?php while ( have_posts() ) : the_post();?>

<div style="padding-top: 5px">
<?php the_content();?>
<?php endwhile; ?>
</div>
<?php comments_template(); ?>
</div>
<div class="col-md-3">
<?php 
if ( has_post_thumbnail() ) { 
	the_post_thumbnail(array(500, 500), array('style' => 'float: left; margin: 50px 10px 20px 0px; width: 100%; height: 100%'));
} 
?>
<h1 style="margin-top: 10px; margin-bottom: 15px">Informace</h1>
<h4 class="subheading"><i class="fa fa-user" style="margin-right: 5px;"></i><?php the_author_posts_link(); ?></h4>
<h4 class="subheading"><i class="fa fa-pencil" style="margin-right: 5px"></i><?php the_time('d. m. Y, G:i'); ?></h4>
<h4 class="subheading">
	<?php if(!empty($rating_value)) echo '<i class="fa fa-star" style="margin-right: 5px"> ' . $rating_value . '/10</i>'; ?></h4>
<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<br>
<!-- Umístěte tuto značku do záhlaví nebo těsně před značku konce těla textu. -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'cs'}
</script>

<!-- Umístěte tuto značku na místo, kde se má widget tlačítko +1 zobrazit. -->
<div class="g-plusone" data-annotation="none"></div><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<?php dynamic_sidebar(sidebar_right); ?>
</div>
</div>
<div style="margin-bottom:10px;text-align: center;">
<?php dynamic_sidebar(sidebar_bottom); ?>
</div>
<?php get_footer();  ?>
