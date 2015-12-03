<!doctype html>
<html class="no-js" lang="">
<head>
	<% base_tag %>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Russian Fudge</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="apple-touch-icon" href="$ThemeDir/apple-touch-icon.png">
	<!-- Place favicon.ico in the root directory -->

	<link rel="stylesheet" href="$ThemeDir/css/normalize.css">
	<link rel="stylesheet" href="$ThemeDir/css/main.css">
	<script src="$ThemeDir/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

$Layout

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="$ThemeDir/js/vendor/underscore-1.8.3.min.js"></script>
<script>window.jQuery || document.write('<script src="$ThemeDir/js/vendor/jquery-1.11.3.min.js"><\\/script>')</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GMapsAPIKey}&libraries=places"></script>
<script src="$ThemeDir/js/plugins.js"></script>
<script src="$ThemeDir/js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='https://www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
