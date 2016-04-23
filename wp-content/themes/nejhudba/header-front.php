<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico">
<title>Nejhudba.cz</title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/responsiveslides.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300' rel='stylesheet' type='text/css'>
<?php wp_head(); ?> 
</head>
<body>
<nav id="primary" role="navigation">
   <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
          <a class="navbar-brand" href="<?php echo home_url() ?>" style="padding-top: 10px">
<span style="font-size:14px;position: relative;top: 4px;">
<svg width="5" height="7">
  <rect width="5" height="7" style="fill:#f90;"></rect>
</svg>
<svg width="5" height="15">
  <rect width="5" height="15" style="fill:#f90;"></rect>
</svg>
<svg width="5" height="22">
  <rect width="5" height="22" style="fill:#f90;"></rect>
</svg>
</span>
     Nejhudba.cz
</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="primary-collapse">
      <?php wp_nav_menu(array('menu_class'=>'nav navbar-nav', 'container' => false, 'theme_location'=>'primary'));?>
      <div id="mobile-menu">
    	<?php wp_nav_menu(array('menu_class'=>'nav navbar-nav navbar-right', 'container' => false, 'theme_location'=>'secondary'));?>
      </div>
       <form role="search" method="get" id="searchform" class="navbar-form navbar-right searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="input-group">
      <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="form-control" />
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" ><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
      </form>

    </div><!-- /.navbar-collapse -->
    </div>
</nav>
	<header class="front">
<nav id="secondary">
<div class="container" style="padding-left: inherit; padding-right: inherit">
    <div class="collapse navbar-collapse" style="padding-left: inherit; padding-right: inherit">
	<div class="navbar-header">
    
    <a class="navbar-brand" href="<?php echo home_url() ?>" style="padding-top: 7px">
<span id="logo">
<svg width="10" height="15">
  <rect width="10" height="15" style="fill:#f90;"></rect>
</svg>
<svg width="10" height="30">
  <rect width="10" height="30" style="fill:#f90;"></rect>
</svg>
<svg width="10" height="45">
  <rect width="10" height="45" style="fill:#f90;"></rect>
</svg>
</span>
     Nejhudba.cz
</a>
</div>
    
    	<?php wp_nav_menu(array('menu_class'=>'nav navbar-nav navbar-right', 'container' => false, 'theme_location'=>'secondary'));?>
    </div>
</div>
</nav>
<div class="container" id="slider_frame">
<ul class="slider" id="slider-front">

<?php

$args = array(
	'showposts' => '5',
	'meta_query' => array(
		array(
			'key' => 'slider_post',
			'value' => "true",
		)
	)
 );
$postslist = get_posts( $args );
foreach($postslist as $post)
{
	$description = get_post_meta( $post->ID, "slide_description", true );
	?>
	<a href="<?php the_permalink(); ?>" data-image="<?php echo get_post_meta( $post->ID, "slider_image", true ); ?>" data-uri="<?php the_permalink(); ?>" data-author-uri="<?php echo get_author_posts_url($post->post_author ); ?>" data-title="<?php echo $post->post_title; ?>" data-date="<?php echo mysql2date('d. m. Y', $post->post_date); ?>" data-author="<?php echo get_the_author_meta( 'display_name', $post->post_author ); ?>" style="background-image: url('<?php echo get_post_meta( $post->ID, "slider_image", true ); ?>'); ">
    <?php if(!empty($description)){ ?><div class="caption"><?php echo get_post_meta( $post->ID, "slide_description", true ); ?></div><?php } ?>
   		</a>
        <?php
}
?>



</ul>
</div>
</header>