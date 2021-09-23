<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title>Error</title>
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<div style="border:1px solid #990000;padding:20px;margin:10px;text-align: center;">
			<h4><?php echo (isset($error)) ? ucfirst($error) : 'Error Occured' ; ?></h4>
			<p><?php echo (isset($message)) ? ucfirst($message) : 'If you think this is an error, please contact system administrator' ; ?></p>
		</div>
	</body>
</html>