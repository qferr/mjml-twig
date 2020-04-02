MJML in PHP
===========

A simple PHP library to render MJML to HTML.

There are two ways for integrating MJML in PHP:
* using the MJML API
* using the MJML library

### Installation

```shell script
composer require qferr/mjml-php
```

### Using MJML library

Install the MJML library:

```shell script
npm install mjml
```

```php
<?php
require_once 'vendor/autoload.php';

$renderer = new \Qferrer\Mjml\Renderer\BinaryRenderer(__DIR__ . '/node_modules/.bin/mjml');

$html = $renderer->render('
    <mjml>
        <mj-body>
            <mj-section>
                <mj-column>
                    <mj-text>Hello world</mj-text>
                </mj-column>
            </mj-section>
        </mj-body>
    </mjml>
');
```

### Using MJML API

```php
<?php
require_once 'vendor/autoload.php';

$apiId = 'd052fd96-16cb-495a-a385-ddea636f8bcf';
$secretKey = '18f8feef-09e6-4218-8d08-6e532061ec88';

$renderer = new \Qferrer\Mjml\Renderer\ApiRenderer($apiId, $secretKey);

$html = $renderer->render('
    <mjml>
        <mj-body>
            <mj-section>
                <mj-column>
                    <mj-text>Hello world</mj-text>
                </mj-column>
            </mj-section>
        </mj-body>
    </mjml>
');
```