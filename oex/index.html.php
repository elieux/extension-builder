<?php

return '
<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>' . htmlspecialchars($config['name'], ENT_QUOTES, 'UTF-8') . '</title>
		<script type="text/javascript" src="background.js"></script>
	</head>
	<body>
	</body>
</html>
';
