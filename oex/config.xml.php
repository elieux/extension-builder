<?php

return '
<?xml version="1.0" encoding="utf-8" ?>
<widget xmlns="http://www.w3.org/ns/widgets" id="' . htmlspecialchars($config['namespace'], ENT_QUOTES, 'UTF-8') . '/" version="' . htmlspecialchars($config['version'], ENT_QUOTES, 'UTF-8') . '">
	<name>' . htmlspecialchars($config['name'], ENT_QUOTES, 'UTF-8') . '</name>
	<author href="' . htmlspecialchars($config['namespace'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($config['author'], ENT_QUOTES, 'UTF-8') . '</author>
	<description xml:lang="en">' . htmlspecialchars($config['description'], ENT_QUOTES, 'UTF-8') . '</description>

	<access origin="' . htmlspecialchars($config['namespace'], ENT_QUOTES, 'UTF-8') . '" />
	<feature name="opera:share-cookies" required="false" />

	<icon src="icon.png" />
	<update-description href="' . htmlspecialchars($config['namespace'], ENT_QUOTES, 'UTF-8') . '/download/opera-update" />
</widget>
';
