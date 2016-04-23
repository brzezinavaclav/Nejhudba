<footer>
<div id="upper">
<div class="container">
	<div class="col-md-4">
    	<div class="row">
          <h1>Blížící se alba</h1>
          <?php 
			$albums = get_option("album_options"); 
			$key = 0;
			for($i=0; $i<count($albums['date']); $i++){
				if(strtotime($albums['date'][$i]) < Time()-3600*24*3) $key = $i+1;
			}
		  ?>
        </div>
    	<div class="row" style="margin-bottom: 7px">
        <?php if(!empty($albums['date'][$key])){ ?>
          <img src="<?php echo $albums['image'][$key] ?>" height="85"style="float: left; margin: 7px">
          <h2><?php echo $albums['interpret'][$key] ?></h2>
          <p><?php echo $albums['album'][$key] ?></p>
          <p><?php echo $albums['date'][$key] ?></p>
          <?php if(!empty($albums['facebook'][$key]))echo '<a target="_blank" class="label label-facebook" href="' . $albums['facebook'][$key] . '">facebook</a>'; ?>
          <?php if(!empty($albums['itunes'][$key]))echo '<a target="_blank" class="label label-itunes" href="' . $albums['itunes'][$key] . '">itunes</a>'; ?>
          <?php if(!empty($albums['beatport'][$key]))echo '<a target="_blank" class="label label-fbeatport" href="' . $albums['beatport'][$key] . '">beatport</a>'; ?>
          <?php if(!empty($albums['more'][$key]))echo '<a target="_blank" class="label label-default" href="' . $albums['more'][$key] . '">více</a>'; ?>
        <?php } ?>
        </div>
    	<div class="row">
        <?php if(!empty($albums['date'][$key+1])){ ?>
          <img src="<?php echo $albums['image'][$key+1] ?>" height="85"style="float: left; margin: 7px">
          <h2><?php echo $albums['interpret'][$key+1] ?></h2>
          <p><?php echo $albums['album'][$key+1] ?></p>
          <p><?php echo $albums['date'][$key+1] ?></p>
          <?php if(!empty($albums['facebook'][$key+1]))echo '<a target="_blank" class="label label-facebook" href="' . $albums['facebook'][$key+1] . '">facebook</a>'; ?>
          <?php if(!empty($albums['itunes'][$key+1]))echo '<a target="_blank" class="label label-itunes" href="' . $albums['itunes'][$key+1] . '">itunes</a>'; ?>
          <?php if(!empty($albums['beatport'][$key+1]))echo '<a target="_blank" class="label label-fbeatport" href="' . $albums['beatport'][$key+1] . '">beatport</a>'; ?>
          <?php if(!empty($albums['more'][$key+1]))echo '<a target="_blank" class="label label-default" href="' . $albums['more'][$key+1] . '">více</a>'; ?>
        <?php } ?>
        </div>
    </div>
	<div class="col-md-5">
    	<div class="row">
          <h1>Kam vyrazit</h1>
		  <?php
            $events = get_option("event_options");
            $key = 0;
            for($i=0; $i<count($events['date']); $i++){
                if(strtotime($events['date'][$i]) < Time()-3600*24*3) $key = $i+1;
            }
          ?>
        </div>
    	<div class="row" style="margin-bottom: 7px">
        <?php if(!empty($events['date'][$key])){ ?>
          <img src="<?php echo $events['image'][$key] ?>" height="85"style="float: left; margin: 7px">
          <h2><?php echo $events['event'][$key] ?></h2>
          <p><?php echo $events['place'][$key] ?></p>
          <p><?php echo $events['date'][$key] ?></p>
          <?php if(!empty($events['facebook'][$key]))echo '<a target="_blank" class="label label-facebook" href="' . $events['facebook'][$key] . '">facebook</a>'; ?>
          <?php if(!empty($events['lastfm'][$key]))echo '<a target="_blank" class="label label-lastfm" href="' . $events['lastfm'][$key] . '">last.fm</a>'; ?>
          <?php if(!empty($events['more'][$key]))echo '<a target="_blank" class="label label-default" href="' . $events['more'][$key] . '">více</a>'; ?>
        <?php } ?>
        </div>
    	<div class="row">
        <?php if(!empty($events['date'][$key+1])){ ?>
          <img src="<?php echo $events['image'][$key+1] ?>" height="85"style="float: left; margin: 7px">
          <h2><?php echo $events['event'][$key+1] ?></h2>
          <p><?php echo $events['place'][$key+1] ?></p>
          <p><?php echo $events['date'][$key+1] ?></p>
          <?php if(!empty($events['facebook'][$key+1]))echo '<a target="_blank" class="label label-facebook" href="' . $events['facebook'][$key+1] . '">facebook</a>'; ?>
          <?php if(!empty($events['lastfm'][$key+1]))echo '<a target="_blank" class="label label-lastfm" href="' . $events['lastfm'][$key+1] . '">last.fm</a>'; ?>
          <?php if(!empty($events['more'][$key+1]))echo '<a target="_blank" class="label label-default" href="' . $events['more'][$key+1] . '">více</a>'; ?>
        <?php } ?>
        </div>
    </div>
	<div class="col-md-3">
    	<div class="row">
          <h1>Future releases</h1>
		  <?php
            $releases = get_option("release_options");
            $key = 0;
            for($i=0; $i<count($releases['date']); $i++){
                if(strtotime($releases['date'][$i]) < Time()-3600*24*3) $key = $i+1;
            }
          ?>
        </div>
    	<div class="row" style="margin-bottom: 15px; min-height: 91px; padding-left: 5px">
        <?php if(!empty($releases['date'][$key])){ ?>
          <h2><?php echo $releases['interpret'][$key] ?></h2>
          <p><?php echo $releases['release'][$key] ?></p>
          <p><?php echo $releases['date'][$key] ?></p>
          <?php if(!empty($releases['facebook'][$key]))echo '<a target="_blank" class="label label-facebook" href="' . $releases['facebook'][$key] . '">facebook</a>'; ?>
          <?php if(!empty($releases['lastfm'][$key]))echo '<a target="_blank" class="label label-lastfm" href="' . $releases['lastfm'][$key] . '">last.fm</a>'; ?>
          <?php if(!empty($releases['youtube'][$key]))echo '<a target="_blank" class="label label-lastfm" href="' . $releases['youtube'][$key] . '"><font color="#121212">You</font>Tube</a>'; ?>
          <?php if(!empty($releases['soundcloud'][$key]))echo '<a target="_blank" class="label label-soundcloud" href="' . $releases['soundcloud'][$key] . '">soundcloud</a>'; ?>
          <?php if(!empty($releases['more'][$key]))echo '<a target="_blank" class="label label-default" href="' . $releases['more'][$key] . '">více</a>'; ?>
        <?php } ?>
        </div>
    	<div class="row" style="padding-left: 5px">
        <?php if(!empty($releases['date'][$key+1])){ ?>
          <h2><?php echo $releases['interpret'][$key+1] ?></h2>
          <p><?php echo $releases['release'][$key+1] ?></p>
          <p><?php echo $releases['date'][$key+1] ?></p>
          <?php if(!empty($releases['facebook'][$key+1]))echo '<a target="_blank" class="label label-facebook" href="' . $releases['facebook'][$key+1] . '">facebook</a>'; ?>
          <?php if(!empty($releases['lastfm'][$key+1]))echo '<a target="_blank" class="label label-lastfm" href="' . $releases['lastfm'][$key+1] . '">last.fm</a>'; ?>
          <?php if(!empty($releases['youtube'][$key+1]))echo '<a target="_blank" class="label label-lastfm" href="' . $releases['youtube'][$key+1] . '"><font color="#121212">You</font>Tube</a>'; ?>
          <?php if(!empty($releases['soundcloud'][$key+1]))echo '<a target="_blank" class="label label-soundcloud" href="' . $releases['soundcloud'][$key+1] . '">soundcloud</a>'; ?>
          <?php if(!empty($releases['more'][$key+1]))echo '<a target="_blank" class="label label-default" href="' . $releases['more'][$key+1] . '">více</a>'; ?>
        <?php } ?>
        </div>
    </div>
</div>
</div>
<div id="lower">
<?php $settings = get_option("general_options"); ?>
<div class="container">
<span style="float:left; padding: 13px 0px;"><?php echo $settings['copyright']; ?></span>
<span style="float:right; font-size: 28px; padding: 2px 0px;"><a target="_blank" href="<?php echo $settings['facebook']; ?>"><i class="fa fa-facebook-square" style="margin-right: 5px;"></i></a><a href="<?php echo $settings['twitter']; ?>"><i class="fa fa-twitter-square" style="margin-right: 5px;"></i></a><a target="_blank" href="<?php echo home_url() ?>/feed/"><i class="fa fa-rss-square"></i></a><a style="width:28px; height:24px; font-size: 24px; color: #707070; margin-left: 5px; position: relative; bottom: 1px" target="_blank" href="/wp-admin"><i class="fa fa-wordpress"></i></a></span>
</div>
</div>

</footer>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/bootstrap.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/responsiveslides.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/simple-lightbox.min.js"></script>
<script>
  $(document).ready(function(e) {
     $("#slider-front").responsiveSlides({
        auto: true,
        pager: true,
        speed: 500
      });
});
$(function(){
    var jQuerygallery = $('a[data-lightbox]').simpleLightbox({
        disableScroll: false,
        showCounter: false
    });
});

// Creare's 'Implied Consent' EU Cookie Law Banner v:2.4
// Conceived by Robert Kent, James Bavington & Tom Foyster
 
var dropCookie = true;                      // false disables the Cookie, allowing you to style the banner
var cookieDuration = 14;                    // Number of days before the cookie expires, and the banner reappears
var cookieName = 'complianceCookie';        // Name of our cookie
var cookieValue = 'on';                     // Value of cookie
 
function createDiv(){
    var bodytag = document.getElementsByTagName('body')[0];
    var div = document.createElement('div');
    div.setAttribute('id','cookie-law');
    div.innerHTML = '<p>Tento web používá k poskytování služeb, personalizaci reklam a analýze návštěvnosti soubory cookie. Používáním tohoto webu s tím souhlasíte <a class="close-cookie-banner btn btn-primary" href="javascript:void(0);" onclick="removeMe();">V pořádku</a></p>';  
     
    // bodytag.appendChild(div); // Adds the Cookie Law Banner just before the closing </body> tag
    // or
    bodytag.insertBefore(div,bodytag.firstChild); // Adds the Cookie Law Banner just after the opening <body> tag
     
    document.getElementsByTagName('body')[0].className+=' cookiebanner'; //Adds a class tothe <body> tag when the banner is visible
     
}
 
 
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000)); 
        var expires = "; expires="+date.toGMTString(); 
    }
    else var expires = "";
    if(window.dropCookie) { 
        document.cookie = name+"="+value+expires+"; path=/"; 
    }
}
 
function checkCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
 
function eraseCookie(name) {
    createCookie(name,"",-1);
}
 
window.onload = function(){
    if(checkCookie(window.cookieName) != window.cookieValue){
        createDiv(); 
    }
}

function removeMe(){
    createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie
	var element = document.getElementById('cookie-law');
	element.parentNode.removeChild(element);
}
</script>
<?php wp_footer(); ?> 
</body>
</html>