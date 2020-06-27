Twig MJML extension
===================

This package is a Twig extension that provides the following:
* mjml_to_html filter: processes a mjml email template.

```twig
{% apply mjml_to_html %}
<mjml>
    <mj-body>
        <mj-section>
            <mj-column>
                <mj-text>Hello {{ username }}</mj-text>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
{% endapply %}
```

Because we have two ways for rendering MJML to HML, the extension depends on a renderer:
* **BinaryRenderer**: using the MJML library. You will have to provide the location of the MJML binary. Don’t forget to install it with the Node package manager.
* **ApiRenderer**: using the MJML API. Nothing to install. You will have to provide the credentials to access of the API.

Thanks to the library [MJML in PHP](https://github.com/qferr/mjml-php) for make easier the integration of MJML in PHP. 
Read the article [Rendering MJML in PHP](https://medium.com/@qferrer/rendering-mjml-in-php-982d703aa703?source=friends_link&sk=7c5553ae7fcfcdde889bdd3b776c90a9) for more informations.

Installation
------------

`composer require qferr/mjml-twig`

Usage
-----

```php
<?php
require_once 'vendor/autoload.php';

use \Qferrer\Mjml\Renderer\ApiRenderer;
use \Qferrer\Mjml\Renderer\BinaryRenderer;
use \Qferrer\Mjml\Twig\MjmlExtension;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

$renderer = new BinaryRenderer(__DIR__ . '/node_modules/.bin/mjml');
// $renderer = new ApiRenderer('my-app-id','my-secret-key');
$twig->addExtension(new MjmlExtension($renderer));

$html = $twig->render('newsletter.mjml.twig', [
    'username' => 'Quentin'
]);
```

You can now start using MJML in any Twig template.

Integrating in Symfony
----------------------
Register the MJML extension as a service and tag it with `twig.extension`.

```yaml
# config/services.yaml
services:
  # mjml_renderer:
  #  class: Qferrer\Mjml\Renderer\ApiRenderer
  #  arguments:
  #    - '%env(MJML_APP_ID)%'
  #    - '%env(MJML_SECRET_KEY)%'

  mjml_renderer:
    class: Qferrer\Mjml\Renderer\BinaryRenderer
    arguments:
      - '%kernel.project_dir%/node_modules/.bin/mjml'

  Qferrer\Mjml\Twig\MjmlExtension:
    arguments: ['@mjml_renderer']
    tags: ['twig.extension']
```

Source: [Using MJML with Twig](https://medium.com/@qferrer/using-mjml-with-twig-cccea9af0086?source=friends_link&sk=0271c98a6225ff216cec5faefd6d7267)
