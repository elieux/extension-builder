<?php

return'
var { url } = require("sdk/self").data;

require("sdk/page-mod").PageMod({
	include: ' . json_encode($config['patterns']) . ',
	contentScriptFile: [
		url("include.js"),
	],
	contentStyleFile: [
	],
	attachTo: ["existing", "top"]
});
';
