<?php

return json_encode(array(
    'check_memory' => false,
    'enable_e10s' => false,
    'is-sdk-bundled' => false,
    'jetpackID' => "{$config['product']}@jetpack",
    'loader' => 'addon-sdk/lib/sdk/loader/cuddlefish.js',
    'main' => 'main',
    'mainPath' => "{$config['product']}/main",
    'manifest' => array(
        "{$config['product']}/main" => array(
            'jsSHA256' => hash('sha256', require(__DIR__ . '/resources/${product}/lib/main.js.php')),
            'moduleName' => 'main',
            'packageName' => $config['product'],
            'requirements' => array(
                'sdk/page-mod' => 'sdk/page-mod',
                'sdk/self' => 'sdk/self',
            ),
            'sectionName' => 'lib',
        )
    ),
    'metadata' => array(
        'addon-sdk' => array(
            'description' => 'Add-on development made easy.',
            'keywords' => array(
                'javascript',
                'engine',
                'addon',
                'extension',
                'xulrunner',
                'firefox',
                'browser',
            ),
            'license' => 'MPL 2.0',
            'name' => 'addon-sdk',
        ),
        $config['product'] => array(
            'author' => $config['author'],
            'description' => $config['description'],
            'main' => 'main',
            'name' => $config['product'],
            'version' => $config['version'],
        ),
    ),
    'name' => $config['product'],
    'parseable' => false,
    'preferencesBranch' => "{$config['product']}@jetpack",
    'sdkVersion' => 'firefox-24-06-12-2013-677-gd4f3f35',
    'staticArgs' => new StdClass(),
    'verbose' => false,
));
