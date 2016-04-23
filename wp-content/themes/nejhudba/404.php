<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico">
    <title>404 ‹ Nejhudba.cz</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/responsiveslides.css" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300' rel='stylesheet' type='text/css'>
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
    <rect width="5" height="7" style="fill:#f90;">
</svg>
<svg width="5" height="15">
    <rect width="5" height="15" style="fill:#f90;">
</svg>
<svg width="5" height="22">
    <rect width="5" height="22" style="fill:#f90;">
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
</nav>

<header class="page">
    <nav id="secondary">
        <div class="container" style="padding-left: inherit; padding-right: inherit">
            <div class="collapse navbar-collapse" style="padding-left: inherit; padding-right: inherit">
                <div class="navbar-header">

                    <a class="navbar-brand" href="<?php echo home_url() ?>" style="padding-top: 7px">
<span id="logo">
<svg width="10" height="15">
    <rect width="10" height="15" style="fill:#f90;">
</svg>
<svg width="10" height="30">
    <rect width="10" height="30" style="fill:#f90;">
</svg>
<svg width="10" height="45">
    <rect width="10" height="45" style="fill:#f90;">
</svg>
</span>
                        Nejhudba.cz
                    </a>
                </div>

                <?php wp_nav_menu(array('menu_class'=>'nav navbar-nav navbar-right', 'container' => false, 'theme_location'=>'secondary'));?>
            </div>
        </div>
    </nav>
</header>
<div class="container" id="content">
    <div style="margin-bottom:10px;text-align: center;">
        <?php dynamic_sidebar(sidebar_top); ?>
    </div>
    <div class="col-md-9">
        <h1>404 - Stránka nebyla nalezena</h1>
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