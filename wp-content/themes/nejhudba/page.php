<?php get_header(); ?>
<div class="container" id="content">
<div style="margin-bottom:10px;text-align: center;">
<?php dynamic_sidebar(sidebar_top); ?>
</div>
<div class="col-md-9">
<?php while ( have_posts() ) : the_post();?>
<h1 style="margin-top: 10px"><?php the_title();?></h1>
<?php the_content();?>
<?php endwhile; ?>
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
<script>
$("form").submit(function(e) {
    e.preventDefault();
	 // Get some values from elements on the page:
	  var $form = $( this ),
	  name = $form.find( "input[name='name']" ).val(),
	  from = $form.find( "input[name='from']" ).val(),
	  text = $form.find( "textarea[name='text']" ).val(),
	  url = $form.attr( "action" );
	   // Send the data using post
	  var sending = $.post( url, { name: name, from: from, text: text } );
	  // Put the results in a div
	  sending.done(function( data ) {
		$( "input[name='name']" ).val("");
		$( "input[name='from']" ).val("");
		$( "textarea[name='text']" ).val("");
	  	$('#callback').html(data).fadeIn( 1000 ).delay(9000).fadeOut( 1000 );
	  });
	  
});
</script>
