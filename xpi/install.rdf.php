<?php

return '<?xml version="1.0" encoding="utf-8"?>
<!-- This Source Code Form is subject to the terms of the Mozilla Public
   - License, v. 2.0. If a copy of the MPL was not distributed with this
   - file, You can obtain one at http://mozilla.org/MPL/2.0/. -->
<RDF xmlns="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:em="http://www.mozilla.org/2004/em-rdf#">
    <Description about="urn:mozilla:install-manifest">
        <em:id>' . htmlspecialchars($config['product'], ENT_QUOTES, 'UTF-8') . '@jetpack</em:id>
        <em:version>' . htmlspecialchars($config['version'], ENT_QUOTES, 'UTF-8') . '</em:version>
        <em:type>2</em:type>
        <em:bootstrap>true</em:bootstrap>
        <em:unpack>false</em:unpack>

        <!-- Firefox -->
        <em:targetApplication>
            <Description>
                <em:id>{ec8030f7-c20a-464f-9b0e-13a3a9e97384}</em:id>
                <em:minVersion>26.0</em:minVersion>
                <em:maxVersion>32.*</em:maxVersion>
            </Description>
        </em:targetApplication>

        <!-- Front End MetaData -->
        <em:name>' . htmlspecialchars($config['name'], ENT_QUOTES, 'UTF-8') . '</em:name>
        <em:description>' . htmlspecialchars($config['description'], ENT_QUOTES, 'UTF-8') . '</em:description>
        <em:creator>' . htmlspecialchars($config['author'], ENT_QUOTES, 'UTF-8') . '</em:creator>
    </Description>
</RDF>
';
