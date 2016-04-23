<?php $settings = get_option("general_options"); ?>
   <div style="padding: 15px">
   <form method="post" action="<?php admin_url( '?page=footer_options' ); ?>">
        <h1>Hlavní</h1>
        <p>Copyright</p>
         <input type="text" placeholder="&copy; 2015" name="copyright" value="<?php echo $settings['copyright'] ?>" />
 		 <p>Facebook page URI</p>
         <input type="text" placeholder="http://" name="facebook" value="<?php echo $settings['facebook'] ?>" />
 		<p>Twitter page URI</p>
         <input type="text" placeholder="http://" name="twitter" value="<?php echo $settings['twitter'] ?>" />
         
   <p class="submit" style="clear: both;">
      <input type="submit" name="Submit"  class="button-primary" value="Uložit" />
      <input type="hidden" name="general-submit" value="Y" />
   </p>
</form>
</div>
   </div>