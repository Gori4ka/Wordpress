<?php

?>

<div class="fb_boxe">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.0&appId=403973163381963&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb_like like-boxe">
        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo get_permalink(); ?>&width=70&layout=button_count&action=like&size=small&show_faces=true&share=false&height=21&appId" width="100" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div>
    <div class="fb-share-button" data-href="<?php echo get_permalink(); ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="fb-xfbml-parse-ignore">Поделиться</a></div>
</div>