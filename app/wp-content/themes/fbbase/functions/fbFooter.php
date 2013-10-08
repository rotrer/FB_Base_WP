	<div id="fb-root"></div>
	<script>
	window.fbAsyncInit = function() {
		var flag = false;
		FB.init({appId: '<?php print APP_ID; ?>', status: true, cookie: true, xfbml: true});
		
	};
	(function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol +
				'//connect.facebook.net/es_LA/all.js';
		document.getElementById('fb-root').appendChild(e);
	}());
	</script>