<style>
.widefat td{
	vertical-align: middle;
}
.label{
	text-align: center;
white-space: nowrap;
vertical-align: baseline;
border-radius: 0.25em;
	padding: 2px 5px;
}
.label-itunes, .label-itunes:hover, .label-itunes:focus{
	background-color: #333;
	color: #FFF;
}

.label-beatport, a.label-beatport:hover, a.label-beatport:focus{
	background-color: #060606;
	color: rgb(179,237,0);
}

.label-facebook, a.label-facebook:hover, a.label-facebook:focus{
	background-color: #3B5998;
	color: #fff;
border-color: #3B5998;
}


.label-default, a.label-default:hover, a.label-default:focus{
background-color: #020202;
border-color: #F90;    
color: #FFF;
text-decoration: none;
}

</style>
<div style="padding: 15px">
   <form method="post" action="edit.php?page=footer_options&tab=albums">
             <h1>Blížící se alba</h1>
         <div id="col-container">
         <div id="col-right">
         <h3>Alba</h3>
         <table class="wp-list-table widefat fixed">
         <thead>
         	<th>Interpret</th>
            <th>Album</th>
            <th>Datum vydání</th>
            <th>Obrázek</th>
            <th>Štítky</th>
            <th>Akce</th>
         </thead>
         <tbody>
         <?php
		 	$settings = get_option("album_options");
		 	for($i = 1; $i <= count($settings["interpret"]); $i++)
			{
				if($i % 2) echo '<tr class="alternate">'; else echo '<tr>';
				echo '<td>' . $settings["interpret"][$i-1] . '</td>';
				echo '<td>' . $settings["album"][$i-1] . '</td>';
				echo '<td>' . $settings["date"][$i-1] . '</td>';
				echo '<td><img src="' . $settings["image"][$i-1] . '" height="50"></td>';
				echo '<td style="padding-top: 12px">';
				if(!empty($settings["itunes"][$i-1])) echo '<p><a class="label label-itunes" href="' . $settings["itunes"][$i-1] . '">iTunes</a><p>';
				if(!empty($settings["beatport"][$i-1])) echo '<p><a class="label label-beatport" href="' . $settings["beatport"][$i-1] . '">beatport</a><p>';
				if(!empty($settings["facebook"][$i-1])) echo '<p><a class="label label-facebook" href="' . $settings["facebook"][$i-1] . '">facebook</a><p>';
				if(!empty($settings["more"][$i-1])) echo '<p><a class="label label-default" href="' . $settings["more"][$i-1] . '">Více</a><p>';
				echo '</td>';
				echo '<td>' . '<i> <a href="?page=footer_options&tab=albums&edit=true&item=' . ($i-1) . '"><span class="dashicons dashicons-edit"></span></a> <a href="?page=footer_options&tab=albums&delete=true&item=' . ($i-1) . '"><span class="dashicons dashicons-trash"></span></a></i>' . '</td>';
				echo '</tr>';
			}
		 
		 ?>
         </tbody>
         </table>
         </div>
         
         <div id="col-left">
         <h3><?php if(empty($_GET['edit'])){ ?>Přidat<?php } else{ ?>Upravit<?php } ?></h3>
         <p>Interpret</p>
         <input type="text" name="interpret" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['interpret'][$_GET['item']].'"' ?>  />
 		 <p>Album</p>
         <input type="text" name="album" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['album'][$_GET['item']].'"' ?>  />
 		<p>Datum vydání</p>
         <input type="date" name="date" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['date'][$_GET['item']].'"' ?>  />
 		<p>Obrázek</p>
         <input type="text" placeholder="http://" name="image" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['image'][$_GET['item']].'"' ?>  />
 		<p><a class="label label-facebook">facebook</a></p>
         <input type="text" placeholder="http://" name="facebook" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['facebook'][$_GET['item']].'"' ?>  />
 		<p><a class="label label-itunes">iTunes</a></p>
         <input type="text" placeholder="http://" name="itunes" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['itunes'][$_GET['item']].'"' ?>  />
 		<p><a class="label label-beatport">beatport</a></p>
         <input type="text" placeholder="http://" name="beatport" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['beatport'][$_GET['item']].'"' ?>  />
         
 		<p><a class="label label-default">Více</a></p>
        <input type="text" placeholder="http://" name="more" <?php if(!empty($_GET['edit'])) echo 'value="'.$settings['more'][$_GET['item']].'"' ?>  />
         </div>
         </div>
   <p class="submit" style="clear: both;">
      <input type="submit" name="Submit"  class="button-primary" value="<?php if(empty($_GET['edit'])){ ?>Přidat album<?php } else{ ?>Upravit album<?php } ?>" />
      <input type="hidden" name="album-submit" value="true" />
      <?php if($_GET['edit']) echo '<input type="hidden" name="edit" value="true" /><input type="hidden" name="edit_id" value="'.$_GET['item'].'" />'; ?>
   </p>
</form>
</div>
   </div>