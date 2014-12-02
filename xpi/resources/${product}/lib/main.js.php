<?php

$convertPattern = function($pattern) {
	$containsMoreAsterisks = function($str) {
		return 1 < preg_match_all('~\*~', $str);
	};
	
	$convertToRegex = function($str) {
		$quoteRegexPart = function($str) {
			return preg_quote($str, '/');
		};
		
		$parts = explode("*", $str);
		$parts = array_map($quoteRegexPart, $parts);
		return implode(".*", $parts);
	};
	
	if (!$containsMoreAsterisks($pattern))
		return json_encode($pattern);
	
	return "/" . $convertToRegex($pattern) . "/";
};

$patterns = array();
foreach ($config['patterns'] as $pattern)
	$patterns[] = $convertPattern($pattern);

return '
var { url } = require("sdk/self").data;
var pagemod = {};

(function() {
	var window = { pagemod: pagemod };
	' . file_get_contents($config['files']['background-js']) . '
}());

require("sdk/page-mod").PageMod({
	include: [' . implode(",", $patterns) . '],
	contentScriptFile: [
		url("include.js"),
	],
	contentStyleFile: [
	],
	attachTo: ["existing", "top"],
	onAttach: pagemod.onAttach
});
';
