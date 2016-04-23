<?php
function filter_image_tag($html, $id, $alt, $title, $align, $size) {
    list( $img_src, $width, $height ) = image_downsize($id, $size);
    $hwstring = image_hwstring($width, $height);
    $title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';
    $title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';
    $class = 'size-thumbnail wp-image-' . $id;
    $class = apply_filters( 'get_image_tag_class', $class, $id, $align, $size );
    $lightbox_img = wp_get_attachment_image_src($id, "full");
    $html = '<a data-lightbox href="' .  $lightbox_img[0] . '"><img src="' . esc_attr($img_src) . '" alt="' . esc_attr($alt) . '" ' . $title . $hwstring . 'class="' . $class . '" /></a>';
    return $html;
}
add_filter('get_image_tag', 'filter_image_tag', 10, 8);

if ( is_admin() ) { wp_enqueue_script('require-post-title', get_bloginfo('template_directory') . '/js/require-title.js'); }

register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'primary' ),
		'secondary'  => __( 'Secondary Menu', 'secondary' ),
	) );
	
register_sidebar(array(
	'name' => 'Top sidebar',
	'id' => 'sidebar_top'
));
	
register_sidebar(array(
	'name' => 'Bottom sidebar',
	'id' => 'sidebar_bottom'
));

register_sidebar(array(
	'name' => 'Right sidebar',
	'id' => 'sidebar_right'
));


function my_limit_archives( $args ) {
    $args['limit'] = 12;
    return $args;
}
add_filter( 'widget_archives_args', 'my_limit_archives' );


function my_new_contactmethods( $contactmethods ) {
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //add Facebook
    $contactmethods['facebook'] = 'Facebook';
    //add Last.fm
    $contactmethods['lastfm'] = 'Last.fm';
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);


add_theme_support( 'post-thumbnails' ); 


function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


//______________________________________________________________________________THEME OPTIONS_____________________________________________________________________________________________//


function setup_theme_admin_menus() {
         
    add_submenu_page('edit.php',
        'Patička', 'Patička', 'edit_posts',
        'footer_options', 'footer_options');
		
    add_submenu_page('index.php',
        'Widgety', 'Widgety', 'edit_others_pages',
        'dashboard_options', 'dashboard_options');
}

add_action("admin_menu", "setup_theme_admin_menus");

include('footer_options.php');
include('dashboard_options.php');

//_________________________________________________PAGINATION______________________________________________________//
function my_post_queries( $query ) {
	if($query->is_category() or $query->is_archive() or $query->is_search() or $query->is_tag())
	{
      $query->set('posts_per_page', 28);
	}
	if($query->is_front_page())
	{
      $query->set('posts_per_page', 10);
	}
}
add_action( 'pre_get_posts', 'my_post_queries' );

function comment_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo '<div style="float: left; margin-right: 10px">' . get_avatar( $comment, 60 ) . '</div>';
					echo'<p style="color: #3299BB; font-size: 14px; padding-top: 5px">'.get_comment_author().'</p>';
					echo '<p style="font-size: 12px; color: #f90">'.get_comment_date().' v '.get_comment_time().'</p>';
					
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link('<span style="margin-right: 10px"><i class="fa fa-edit" style="margin-right: 5px"></i>Upravit</span>');?>  <?php comment_reply_link( array_merge( $args, array( 'reply_text' => ' <i class="fa fa-reply" style="margin-right: 5px"></i>Odpovědět', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
}
//______________________________________________________________________________RATING MATA BOX___________________________________________//

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function rating_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'rating',
			__( 'Hodnocení', 'rating' ),
			'rating_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'rating_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function rating_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'rating_meta_box', 'rating_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$rating_value = get_post_meta( $post->ID, 'rating_meta_value_key', true );
	if(empty($rating_value)) $rating_value = 0;
	
	echo '
	<input style="padding-top: 18px;" type="range" id="rating_value" name="rating_value" value="' . esc_attr( $rating_value ) . '" min="0" max="10" />		 	<label id="rating_label">' . esc_attr( $rating_value ) . '/10</label>
	<script>
	$j=jQuery.noConflict();
 $j("#rating_value").on("change mousemove", function() {
    $j("#rating_label").html($j("#rating_value").val() + "/10");
});
 </script>';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function rating_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['rating_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['rating_meta_box_nonce'], 'rating_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['rating_value'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['rating_value'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'rating_meta_value_key', $my_data );
}
add_action( 'save_post', 'rating_save_meta_box_data' );


//______________________________________________________________________________slider META BOX___________________________________________//

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function slider_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'slider',
			__( 'Slider', 'slider' ),
			'slider_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'slider_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function slider_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'slider_meta_box', 'slider_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$slider_post = get_post_meta( $post->ID, 'slider_post', true );
	$slider_image = get_post_meta( $post->ID, 'slider_image', true );
	$slide_description = get_post_meta( $post->ID, 'slide_description', true );
	?>
    <div id="slider_image_box">
    <?php if(empty($slider_image)){ ?>
    <label style="font-weight: bold"l>Odkaz:</label>
    <br>
    <input type="url" name="slider_image" placeholder="http://" value="<?php echo esc_attr( $slider_image ) ?>" />
    <br>
    <label style="font-weight: bold">Vybrat soubor:</label>
    <br>
    <a id="upload_image_button" style="text-decoration:underline; cursor: pointer; padding-left: 3px">Zvolit obrázek</a>
    <br>
    <?php } else{ ?>
		<label style="font-weight: bold"l>Obrázek:</label>
        <br>
        <img src="<?php echo $slider_image; ?>" style="width: 100%; margin-top: 5px; padding-left: 3px; max-width: 300px"><br>
        <a id="change_image_button" style="text-decoration:underline; cursor: pointer; padding-left: 3px">Změnit obrázek</a>
    <?php } ?>
    </div>
    <label style="font-weight: bold">Popis:</label>
    <br>
    <textarea name="slide_description" style="width: 100%; margin-top: 5px; margin-left: 3px; max-width: 300px"><?php echo $slide_description; ?></textarea><br>
    <label style="font-weight: bold">Status:</label>
    <br>
	<span style="position: relative; bottom: 1px; padding-left: 3px">Zobrazovat ve slideru</span>
	<input name="slider_post" type="checkbox" name="slider_post" value="true" <?php if($slider_post == true) echo "checked"; ?>  />
<script>
// Uploading files
var file_frame;

  jQuery('#upload_image_button').live('click', function( event ){

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // Finally, open the modal
    file_frame.open();
	
    // When an image is selected, run a callback.
  file_frame.on( 'select', function() {

    var selection = file_frame.state().get('selection');

    selection.map( function( attachment ) {

      attachment = attachment.toJSON();
	  jQuery('#slider_image_box').html('<label style="font-weight: bold"l>Obrázek:</label><br><img style="width: 100%; margin-top: 5px; padding-left: 3px; max-width: 300px" src="' + attachment.url + '"></img><br><input type="hidden" name="slider_image" value="' + attachment.url + '">');
    });
  });

  });
  
  jQuery('#change_image_button').live('click', function( event ){
	  jQuery('#slider_image_box').html('<label style="font-weight: bold"l>Odkaz:</label><br><input type="url" name="slider_image" placeholder="http://" /><br><label style="font-weight: bold">Vybrat soubor:</label><br><a id="upload_image_button" style="text-decoration:underline; cursor: pointer; padding-left: 3px">Zvolit obrázek</a><br>');
  });
</script>

	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function slider_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['slider_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['slider_meta_box_nonce'], 'slider_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	
	
	$slider_image = $_POST["slider_image"];
	$slider_post = $_POST['slider_post'];
	$slide_description = $_POST['slide_description'];
	if(!isset($_POST['slider_post'])) $slider_post = false;

	// Update the meta field in the database.
	update_post_meta( $post_id, 'slider_post', $slider_post );
	if(!empty($_POST["slider_image"])) update_post_meta( $post_id, 'slider_image', $slider_image );
	if(!empty($_POST["slide_description"])) update_post_meta( $post_id, 'slide_description', $slide_description );
}
add_action( 'save_post', 'slider_save_meta_box_data' );

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function example_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'example_dashboard_widget',         // Widget slug.
                 'Example Dashboard Widget',         // Title.
                 'example_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function example_dashboard_widget_function() {
	$settings = get_option("dashboard_options");
	// Display whatever it is you want to show.
	echo $settings['widget_text'];
}

/*_____________________________Image widget_________________________________*/
// Creating the widget 
class image_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'image_widget', 

// Widget name will appear in UI
__('Obrázek', 'image_widget_domain'), 

// Widget description
array( 'description' => __( 'Widget pro obrázek, nebo banner', 'image_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo __( 'Hello, World!', 'image_widget_domain' );
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
    <div id="slider_image_box">
    <label style="font-weight: bold"l>URI obrázku:</label>
    <br>
    <input type="url" name="<?php echo $this->get_field_name( 'url' ); ?>" placeholder="http://" value="<?php echo $instance['url']; ?>" />
    <br>
    <label style="font-weight: bold">Vybrat soubor:</label>
    <br>
    <a id="upload_image_button" style="text-decoration:underline; cursor: pointer; padding-left: 3px">Zvolit obrázek</a>
    <br>
</div>

<script>
// Uploading files
var file_frame;

  jQuery('#upload_image_button').live('click', function( event ){

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // Finally, open the modal
    file_frame.open();
	
    // When an image is selected, run a callback.
  file_frame.on( 'select', function() {

    var selection = file_frame.state().get('selection');

    selection.map( function( attachment ) {

      attachment = attachment.toJSON();
	  jQuery('#slider_image_box').html('<label style="font-weight: bold"l>Obrázek:</label><br><img style="width: 100%; margin-top: 5px; padding-left: 3px; max-width: 300px" src="' + attachment.url + '"></img><br><input type="hidden" name="slider_image" value="' + attachment.url + '">');
    });
  });

  });
  
  jQuery('#change_image_button').live('click', function( event ){
	  jQuery('#slider_image_box').html('<label style="font-weight: bold"l>Odkaz:</label><br><input type="url" name="slider_image" placeholder="http://" /><br><label style="font-weight: bold">Vybrat soubor:</label><br><a id="upload_image_button" style="text-decoration:underline; cursor: pointer; padding-left: 3px">Zvolit obrázek</a><br>');
  });
</script>

<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
return $instance;
}
} // Class image_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'image_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );