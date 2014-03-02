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
$patterns = "[" . implode(",", $patterns) . "]";

return '
var { url } = require("sdk/self").data;

require("sdk/page-mod").PageMod({
	include: ' . $patterns . ',
	contentScriptFile: [
		url("include.js"),
	],
	contentStyleFile: [
	],
	attachTo: ["existing", "top"]
});
';
