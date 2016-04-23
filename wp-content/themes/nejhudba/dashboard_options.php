<?php
function dashboard_options() {
if ($_POST["settings-submit"]) save_dashboard_options();
$settings = get_option("dashboard_options");
?>
<style>
#wpfooter {
	display: none;
}
</style>
	   <div style="padding: 15px">
   <form method="post">
        <h1>Info pro redaktory, akreditace</h1>
   <?php wp_editor($settings['widget_text'], 'widget_text'); ?> 
         
   <p style="clear: both;margin-top: 10px">
      <input type="submit" name="Submit"  class="button-primary" value="Uložit" />
      <input type="hidden" name="settings-submit" value="Y" />
   </p>
</form>
</div>
   </div>
<?php
}

function save_dashboard_options(){
	$settings = get_option("dashboard_options");
	$settings['widget_text'] = $_POST['widget_text'];
	update_option("dashboard_options", $settings);
}
