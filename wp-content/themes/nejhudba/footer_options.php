<?php

function footer_admin_tabs( $current = 'general' ) {
    $tabs = array( 'general' => 'Hlavní', 'albums' => 'Blížící se alba', 'events' => 'Kam vyrazit', 'releases' => 'Future releases');
	echo '<div class="wrap">';
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=footer_options&tab=$tab'>$name</a>";

    }
    echo '</h2>';
}

function footer_options() {
	
if ($_POST["general-submit"]) save_footer_options("general");
elseif ($_POST["album-submit"]) save_footer_options("albums");
elseif ($_POST["events-submit"]) save_footer_options("events");
elseif ($_POST["releases-submit"]) save_footer_options("releases");
	
		if($_GET['delete'] && $_GET['tab'] == "albums")
		{
		  $settings = get_option('album_options');
		  unset($settings['interpret'][$_GET['item']]);
		  unset($settings['album'][$_GET['item']]);
		  unset($settings['date'][$_GET['item']]);
		  unset($settings['image'][$_GET['item']]);
		  unset($settings['itunes'][$_GET['item']]);
		  unset($settings['facebook'][$_GET['item']]);
		  unset($settings['beatport'][$_GET['item']]);
		  unset($settings['more'][$_GET['item']]);
		  $settings['interpret'] = array_values($settings['interpret']);
		  $settings['album'] = array_values($settings['album']);
		  $settings['date'] = array_values($settings['date']);
		  $settings['image'] = array_values($settings['image']);
		  $settings['itunes'] = array_values($settings['itunes']);
		  $settings['facebook'] = array_values($settings['facebook']);
		  $settings['beatport'] = array_values($settings['beatport']);
		  $settings['more'] = array_values($settings['more']);
	      $updated = update_option( "album_options", $settings );
		}	
		
			
		if($_GET['delete'] && $_GET['tab'] == "events")
		{
		  $settings = get_option('event_options');
		  unset($settings['event'][$_GET['item']]);
		  unset($settings['place'][$_GET['item']]);
		  unset($settings['date'][$_GET['item']]);
		  unset($settings['image'][$_GET['item']]);
		  unset($settings['lastfm'][$_GET['item']]);
		  unset($settings['facebook'][$_GET['item']]);
		  unset($settings['more'][$_GET['item']]);
		  $settings['event'] = array_values($settings['event']);
		  $settings['place'] = array_values($settings['place']);
		  $settings['date'] = array_values($settings['date']);
		  $settings['image'] = array_values($settings['image']);
		  $settings['lastfm'] = array_values($settings['lastfm']);
		  $settings['facebook'] = array_values($settings['facebook']);
		  $settings['more'] = array_values($settings['more']);
	      $updated = update_option( "event_options", $settings );
		}	
			
		if($_GET['delete'] && $_GET['tab'] == "releases")
		{
		  $settings = get_option('release_options');
		  unset($settings['interpret'][$_GET['item']]);
		  unset($settings['release'][$_GET['item']]);
		  unset($settings['date'][$_GET['item']]);
		  unset($settings['image'][$_GET['item']]);
		  unset($settings['lastfm'][$_GET['item']]);
		  unset($settings['facebook'][$_GET['item']]);
		  unset($settings['more'][$_GET['item']]);
		  $settings['interpret'] = array_values($settings['interpret']);
		  $settings['release'] = array_values($settings['release']);
		  $settings['date'] = array_values($settings['date']);
		  $settings['image'] = array_values($settings['image']);
		  $settings['lastfm'] = array_values($settings['lastfm']);
		  $settings['facebook'] = array_values($settings['facebook']);
		  $settings['facebook'] = array_values($settings['youtube']);
		  $settings['facebook'] = array_values($settings['soundcloud']);
		  $settings['more'] = array_values($settings['more']);
	      $updated = update_option( "release_options", $settings );
		}	

	
   global $pagenow;
   if ( isset ( $_GET['tab'] ) ) footer_admin_tabs($_GET['tab']); else footer_admin_tabs('general');

if ( $pagenow == 'edit.php' && $_GET['page'] == 'footer_options' ){

   if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab'];
   else $tab = 'general';

   switch ( $tab ){
      case 'general' : include 'footer_general.php';
      break;
      case 'albums' : include 'albums.php';
      break;
      case 'events' : include 'events.php';
      break;
      case 'releases' : include 'releases.php';
      break;
   }
}

}

function save_footer_options($options)
{
	if ($options == "general")
	{
		$settings = get_option("general_options");
		$settings["copyright"] = $_POST["copyright"];
		$settings["facebook"] = $_POST["facebook"];
		$settings["twitter"] = $_POST["twitter"];
		update_option("general_options", $settings);
	}
	elseif ($options == "albums")
	{
		
		$settings = get_option('album_options');
		if($_POST['edit'])
		{
		  $settings = get_option('album_options');
		  unset($settings['interpret'][$_POST['edit_id']]);
		  unset($settings['album'][$_POST['edit_id']]);
		  unset($settings['date'][$_POST['edit_id']]);
		  unset($settings['image'][$_POST['edit_id']]);
		  unset($settings['itunes'][$_POST['edit_id']]);
		  unset($settings['facebook'][$_POST['edit_id']]);
		  unset($settings['beatport'][$_POST['edit_id']]);
		  unset($settings['more'][$_POST['edit_id']]);
		  $settings['interpret'] = array_values($settings['interpret']);
		  $settings['album'] = array_values($settings['album']);
		  $settings['date'] = array_values($settings['date']);
		  $settings['image'] = array_values($settings['image']);
		  $settings['itunes'] = array_values($settings['itunes']);
		  $settings['facebook'] = array_values($settings['facebook']);
		  $settings['beatport'] = array_values($settings['beatport']);
		  $settings['more'] = array_values($settings['more']);
		  
			$key = 0;
			  for($i=0; $i<count($settings['date']); $i++){
				  if(strtotime($_POST['date']) > strtotime($settings['date'][$i])) $key = $i+1;
			  }
			  
			  $settings['date'] = array_values(array_slice($settings['date'], 0, $key, true) +
			  array("x" => $_POST['date']) +
			  array_slice($settings['date'], $key, count($settings['date']), true)) ;
			  
			  $settings['interpret'] = array_values(array_slice($settings['interpret'], 0, $key, true) +
			  array("x" => $_POST['interpret']) +
			  array_slice($settings['interpret'], $key, count($settings['interpret']), true)) ;
			  
			  $settings['album'] = array_values(array_slice($settings['album'], 0, $key, true) +
			  array("x" => $_POST['album']) +
			  array_slice($settings['album'], $key, count($settings['album']), true)) ;
			  
			  $settings['image'] = array_values(array_slice($settings['image'], 0, $key, true) +
			  array("x" => $_POST['image']) +
			  array_slice($settings['image'], $key, count($settings['image']), true)) ;
			  
			  $settings['itunes'] = array_values(array_slice($settings['itunes'], 0, $key, true) +
			  array("x" => $_POST['itunes']) +
			  array_slice($settings['itunes'], $key, count($settings['itunes']), true)) ;
			  
			  $settings['facebook'] = array_values(array_slice($settings['facebook'], 0, $key, true) +
			  array("x" => $_POST['facebook']) +
			  array_slice($settings['facebook'], $key, count($settings['facebook']), true)) ;
			  
			  $settings['beatport'] = array_values(array_slice($settings['beatport'], 0, $key, true) +
			  array("x" => $_POST['beatport']) +
			  array_slice($settings['beatport'], $key, count($settings['beatport']), true)) ;
			  
			  $settings['more'] = array_values(array_slice($settings['more'], 0, $key, true) +
			  array("x" => $_POST['more']) +
			  array_slice($settings['more'], $key, count($settings['more']), true)) ;
		  
		}
		else
		{
		  if(!$settings)
		  {
			  $settings['interpret'] = array();
			  $settings['album'] = array();
			  $settings['date'] = array();
			  $settings['image'] = array();
			  $settings['itunes'] = array();
			  $settings['facebook'] = array();
			  $settings['beatport'] = array();
			  $settings['more'] = array();
		  }
			  $key = 0;
			  for($i=0; $i<count($settings['date']); $i++){
				  if(strtotime($_POST['date']) > strtotime($settings['date'][$i])) $key = $i+1;
			  }
			  
			  $settings['date'] = array_values(array_slice($settings['date'], 0, $key, true) +
			  array("x" => $_POST['date']) +
			  array_slice($settings['date'], $key, count($settings['date']), true)) ;
			  
			  $settings['interpret'] = array_values(array_slice($settings['interpret'], 0, $key, true) +
			  array("x" => $_POST['interpret']) +
			  array_slice($settings['interpret'], $key, count($settings['interpret']), true)) ;
			  
			  $settings['album'] = array_values(array_slice($settings['album'], 0, $key, true) +
			  array("x" => $_POST['album']) +
			  array_slice($settings['album'], $key, count($settings['album']), true)) ;
			  
			  $settings['image'] = array_values(array_slice($settings['image'], 0, $key, true) +
			  array("x" => $_POST['image']) +
			  array_slice($settings['image'], $key, count($settings['image']), true)) ;
			  
			  $settings['itunes'] = array_values(array_slice($settings['itunes'], 0, $key, true) +
			  array("x" => $_POST['itunes']) +
			  array_slice($settings['itunes'], $key, count($settings['itunes']), true)) ;
			  
			  $settings['facebook'] = array_values(array_slice($settings['facebook'], 0, $key, true) +
			  array("x" => $_POST['facebook']) +
			  array_slice($settings['facebook'], $key, count($settings['facebook']), true)) ;
			  
			  $settings['beatport'] = array_values(array_slice($settings['beatport'], 0, $key, true) +
			  array("x" => $_POST['beatport']) +
			  array_slice($settings['beatport'], $key, count($settings['beatport']), true)) ;
			  
			  $settings['more'] = array_values(array_slice($settings['more'], 0, $key, true) +
			  array("x" => $_POST['more']) +
			  array_slice($settings['more'], $key, count($settings['more']), true)) ;
		}
	    $updated = update_option( "album_options", $settings );
	}
	elseif ($options == "events")
	{
		
		$settings = get_option('event_options');
		if($_POST['edit'])
		{
		  unset($settings['event'][$_POST['edit_id']]);
		  unset($settings['place'][$_POST['edit_id']]);
		  unset($settings['date'][$_POST['edit_id']]);
		  unset($settings['image'][$_POST['edit_id']]);
		  unset($settings['lastfm'][$_POST['edit_id']]);
		  unset($settings['facebook'][$_POST['edit_id']]);
		  unset($settings['more'][$_POST['edit_id']]);
		  $settings['event'] = array_values($settings['event']);
		  $settings['place'] = array_values($settings['place']);
		  $settings['date'] = array_values($settings['date']);
		  $settings['image'] = array_values($settings['image']);
		  $settings['lastfm'] = array_values($settings['lastfm']);
		  $settings['facebook'] = array_values($settings['facebook']);
		  $settings['more'] = array_values($settings['more']);
		  
			$key = 0;
			  for($i=0; $i<count($settings['date']); $i++){
				  if(strtotime($_POST['date']) > strtotime($settings['date'][$i])) $key = $i+1;
			  }
			  
			  $settings['date'] = array_values(array_slice($settings['date'], 0, $key, true) +
			  array("x" => $_POST['date']) +
			  array_slice($settings['date'], $key, count($settings['date']), true)) ;
			  
			  $settings['event'] = array_values(array_slice($settings['event'], 0, $key, true) +
			  array("x" => $_POST['event']) +
			  array_slice($settings['event'], $key, count($settings['event']), true)) ;
			  
			  $settings['place'] = array_values(array_slice($settings['place'], 0, $key, true) +
			  array("x" => $_POST['place']) +
			  array_slice($settings['place'], $key, count($settings['place']), true)) ;
			  
			  $settings['image'] = array_values(array_slice($settings['image'], 0, $key, true) +
			  array("x" => $_POST['image']) +
			  array_slice($settings['image'], $key, count($settings['image']), true)) ;
			  
			  
			  $settings['facebook'] = array_values(array_slice($settings['facebook'], 0, $key, true) +
			  array("x" => $_POST['facebook']) +
			  array_slice($settings['facebook'], $key, count($settings['facebook']), true)) ;
			  
			  $settings['lastfm'] = array_values(array_slice($settings['lastfm'], 0, $key, true) +
			  array("x" => $_POST['lastfm']) +
			  array_slice($settings['lastfm'], $key, count($settings['lastfm']), true)) ;
			  
			  $settings['more'] = array_values(array_slice($settings['more'], 0, $key, true) +
			  array("x" => $_POST['more']) +
			  array_slice($settings['more'], $key, count($settings['more']), true)) ;
		  
			
			  		  
		}
		else
		{
		  if(!$settings)
		  {
			  $settings['event'] = array();
			  $settings['place'] = array();
			  $settings['date'] = array();
			  $settings['image'] = array();
			  $settings['lastfm'] = array();
			  $settings['facebook'] = array();
			  $settings['more'] = array();
		  }
			  $key = 0;
			  for($i=0; $i<count($settings['date']); $i++){
				  if(strtotime($_POST['date']) > strtotime($settings['date'][$i])) $key = $i+1;
			  }
			  
			  $settings['date'] = array_values(array_slice($settings['date'], 0, $key, true) +
			  array("x" => $_POST['date']) +
			  array_slice($settings['date'], $key, count($settings['date']), true)) ;
			  
			  $settings['event'] = array_values(array_slice($settings['event'], 0, $key, true) +
			  array("x" => $_POST['event']) +
			  array_slice($settings['event'], $key, count($settings['event']), true)) ;
			  
			  $settings['place'] = array_values(array_slice($settings['place'], 0, $key, true) +
			  array("x" => $_POST['place']) +
			  array_slice($settings['place'], $key, count($settings['place']), true)) ;
			  
			  $settings['image'] = array_values(array_slice($settings['image'], 0, $key, true) +
			  array("x" => $_POST['image']) +
			  array_slice($settings['image'], $key, count($settings['image']), true)) ;
			  
			  $settings['lastfm'] = array_values(array_slice($settings['lastfm'], 0, $key, true) +
			  array("x" => $_POST['lastfm']) +
			  array_slice($settings['lastfm'], $key, count($settings['lastfm']), true)) ;
			  
			  $settings['facebook'] = array_values(array_slice($settings['facebook'], 0, $key, true) +
			  array("x" => $_POST['facebook']) +
			  array_slice($settings['facebook'], $key, count($settings['facebook']), true)) ;
			  
			  $settings['more'] = array_values(array_slice($settings['more'], 0, $key, true) +
			  array("x" => $_POST['more']) +
			  array_slice($settings['more'], $key, count($settings['more']), true)) ;
			  		
		}
	    $updated = update_option( "event_options", $settings );
	}
	elseif ($options == "releases")
	{
		$settings = get_option('release_options');
		if($_POST['edit'])
		{
		  unset($settings['interpret'][$_POST['edit_id']]);
		  unset($settings['release'][$_POST['edit_id']]);
		  unset($settings['date'][$_POST['edit_id']]);
		  unset($settings['image'][$_POST['edit_id']]);
		  unset($settings['lastfm'][$_POST['edit_id']]);
		  unset($settings['facebook'][$_POST['edit_id']]);
		  unset($settings['more'][$_POST['edit_id']]);
		  $settings['interpret'] = array_values($settings['interpret']);
		  $settings['release'] = array_values($settings['release']);
		  $settings['date'] = array_values($settings['date']);
		  $settings['image'] = array_values($settings['image']);
		  $settings['lastfm'] = array_values($settings['lastfm']);
		  $settings['facebook'] = array_values($settings['facebook']);
		  $settings['facebook'] = array_values($settings['youtube']);
		  $settings['facebook'] = array_values($settings['soundcloud']);
		  $settings['more'] = array_values($settings['more']);
		  
			  $key = 0;
			  for($i=0; $i<count($settings['date']); $i++){
				  if(strtotime($_POST['date']) > strtotime($settings['date'][$i])) $key = $i+1;
			  }
			  
			  $settings['date'] = array_values(array_slice($settings['date'], 0, $key, true) +
			  array("x" => $_POST['date']) +
			  array_slice($settings['date'], $key, count($settings['date']), true)) ;
			  
			  $settings['interpret'] = array_values(array_slice($settings['interpret'], 0, $key, true) +
			  array("x" => $_POST['interpret']) +
			  array_slice($settings['interpret'], $key, count($settings['interpret']), true)) ;
			  
			  $settings['release'] = array_values(array_slice($settings['release'], 0, $key, true) +
			  array("x" => $_POST['release']) +
			  array_slice($settings['release'], $key, count($settings['release']), true)) ;
			  
			  $settings['image'] = array_values(array_slice($settings['image'], 0, $key, true) +
			  array("x" => $_POST['image']) +
			  array_slice($settings['image'], $key, count($settings['image']), true)) ;
			  
			  $settings['lastfm'] = array_values(array_slice($settings['lastfm'], 0, $key, true) +
			  array("x" => $_POST['lastfm']) +
			  array_slice($settings['lastfm'], $key, count($settings['lastfm']), true)) ;
			  
			  $settings['facebook'] = array_values(array_slice($settings['facebook'], 0, $key, true) +
			  array("x" => $_POST['facebook']) +
			  array_slice($settings['facebook'], $key, count($settings['facebook']), true)) ;
			  
			  $settings['youtube'] = array_values(array_slice($settings['youtube'], 0, $key, true) +
			  array("x" => $_POST['youtube']) +
			  array_slice($settings['youtube'], $key, count($settings['youtube']), true)) ;
			  
			  $settings['soundcloud'] = array_values(array_slice($settings['soundcloud'], 0, $key, true) +
			  array("x" => $_POST['soundcloud']) +
			  array_slice($settings['soundcloud'], $key, count($settings['soundcloud']), true)) ;
			  
			  $settings['more'] = array_values(array_slice($settings['more'], 0, $key, true) +
			  array("x" => $_POST['more']) +
			  array_slice($settings['more'], $key, count($settings['more']), true)) ;
		}
		else
		{
		  if(!$settings)
		  {
			  $settings['interpret'] = array();
			  $settings['release'] = array();
			  $settings['date'] = array();
			  $settings['image'] = array();
			  $settings['lastfm'] = array();
			  $settings['facebook'] = array();
			  $settings['youtube'] = array();
			  $settings['soundcloud'] = array();
			  $settings['more'] = array();
		  }
			  
			  $key = 0;
			  for($i=0; $i<count($settings['date']); $i++){
				  if(strtotime($_POST['date']) > strtotime($settings['date'][$i])) $key = $i+1;
			  }
			  
			  $settings['date'] = array_values(array_slice($settings['date'], 0, $key, true) +
			  array("x" => $_POST['date']) +
			  array_slice($settings['date'], $key, count($settings['date']), true)) ;
			  
			  $settings['interpret'] = array_values(array_slice($settings['interpret'], 0, $key, true) +
			  array("x" => $_POST['interpret']) +
			  array_slice($settings['interpret'], $key, count($settings['interpret']), true)) ;
			  
			  $settings['release'] = array_values(array_slice($settings['release'], 0, $key, true) +
			  array("x" => $_POST['release']) +
			  array_slice($settings['release'], $key, count($settings['release']), true)) ;
			  
			  $settings['image'] = array_values(array_slice($settings['image'], 0, $key, true) +
			  array("x" => $_POST['image']) +
			  array_slice($settings['image'], $key, count($settings['image']), true)) ;
			  
			  $settings['lastfm'] = array_values(array_slice($settings['lastfm'], 0, $key, true) +
			  array("x" => $_POST['lastfm']) +
			  array_slice($settings['lastfm'], $key, count($settings['lastfm']), true)) ;
			  
			  $settings['facebook'] = array_values(array_slice($settings['facebook'], 0, $key, true) +
			  array("x" => $_POST['facebook']) +
			  array_slice($settings['facebook'], $key, count($settings['facebook']), true)) ;
			  
			  $settings['youtube'] = array_values(array_slice($settings['youtube'], 0, $key, true) +
			  array("x" => $_POST['youtube']) +
			  array_slice($settings['youtube'], $key, count($settings['youtube']), true)) ;
			  
			  $settings['soundcloud'] = array_values(array_slice($settings['soundcloud'], 0, $key, true) +
			  array("x" => $_POST['soundcloud']) +
			  array_slice($settings['soundcloud'], $key, count($settings['soundcloud']), true)) ;
			  
			  $settings['more'] = array_values(array_slice($settings['more'], 0, $key, true) +
			  array("x" => $_POST['more']) +
			  array_slice($settings['more'], $key, count($settings['more']), true)) ;
			
		}
	    $updated = update_option( "release_options", $settings );
	}
}


?>