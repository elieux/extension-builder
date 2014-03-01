<?php

$config = json_decode(file_get_contents('build.json'), true);

$config['templateDir'] = __DIR__;

$file = file_get_contents($config['files']['js']);

preg_match('~@version\s+(.*)$~m', $file, $matches);
$config['version'] = $matches[1];

preg_match('~@name\s+(.*)$~m', $file, $matches);
$config['name'] = $matches[1];

preg_match('~@author\s+(.*)$~m', $file, $matches);
$config['author'] = $matches[1];

preg_match('~@description\s+(.*)$~m', $file, $matches);
$config['description'] = $matches[1];

preg_match('~@namespace\s+(.*)$~m', $file, $matches);
$config['namespace'] = $matches[1];

preg_match_all('~@include\s+(.*)$~m', $file, $matches, PREG_PATTERN_ORDER);
$config['patterns'] = $matches[1];

$config['outputs'] = array(
	'ujs' => "{$config['product']}-{$config['version']}.user.js",
	'xpi' => "{$config['product']}-{$config['version']}.xpi",
	'crx' => "{$config['product']}-{$config['version']}.crx",
	'oex' => "{$config['product']}-{$config['version']}.oex",
);

function file_from_template($__file, $config) {
	return include($__file);
}

function zipall($file, $path, $config) {
	$zip = new ZipArchive();
	$zip->open($file, ZipArchive::CREATE | ZIPARCHIVE::OVERWRITE);

	$names = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	foreach ($names as $name_from => $_)
	{
		$name_from = str_replace('\\', '/', $name_from);
		if (1 === preg_match("~(^|/)\.\.?$~", $name_from))
			continue;

		$name_from = realpath($name_from);
		$name_from = str_replace('\\', '/', $name_from);
		$name_to = $name_from;
		$name_to = str_replace(str_replace('\\', '/', realpath($path)), '', $name_to);
		$name_to = preg_replace("~^/~", '', $name_to);
		$name_to = preg_replace_callback("~\\$\{([^}]+)\}~", function($matches) use($config) { return $config[$matches[1]]; }, $name_to);

		if (is_dir($name_from))
		{
			$zip->addEmptyDir($name_to);
			continue;
		}

		if (1 === preg_match("~\.php$~", $name_from))
		{
			$name_to = preg_replace("~\.php$~", '', $name_to);
			$contents_to = file_from_template($name_from, $config);
		}
		else
			$contents_to = file_get_contents($name_from);

		$zip->addFromString($name_to, $contents_to);
	}

	$zip->close();
}

function build_ujs($file, $config) {
	file_put_contents($file, file_get_contents($config['files']['js']));
}

function build_crx($file, $config) {
	zipall($file, "{$config['templateDir']}/crx", $config);

	// Source: http://code.google.com/chrome/extensions/crx.html
	`openssl sha1 -sha1 -binary -sign "{$config['key']}" < "{$file}" > "{$file}.sig" 2> "{$file}.log"`;
	`openssl rsa -pubout -outform DER < "{$config['key']}" > "{$file}.pub" 2> "{$file}.log"`;

	$sig = file_get_contents("{$file}.sig");
	$pub = file_get_contents("{$file}.pub");

	unlink("{$file}.sig");
	unlink("{$file}.pub");
	unlink("{$file}.log");

	$header = array();
	$header[] = 'Cr24';
	$header[] = pack('V', 2);
	$header[] = pack('V', strlen($pub));
	$header[] = pack('V', strlen($sig));
	$header[] = $pub;
	$header[] = $sig;

	file_put_contents("{$file}", implode('', $header) . file_get_contents("{$file}"));
}

function build_oex($file, $config) {
	zipall($file, "{$config['templateDir']}/oex", $config);
}

function build_xpi($file, $config) {
	zipall($file, "{$config['templateDir']}/xpi", $config);
}

foreach ($config['outputs'] as $method => $file)
{
	$build = "build_{$method}";
	$build("{$config['outputDir']}/{$file}", $config);
}
