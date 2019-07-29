# Shotify: Html to PDF and web page screenshots using headless Chrome 
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
[![Build Status](https://travis-ci.com/AkramBerkawy/shotify.svg?branch=master)](https://travis-ci.com/AkramBerkawy/shotify)
![Packagist Version](https://img.shields.io/packagist/v/akrambe/shotify)
![PHP from Packagist](https://img.shields.io/packagist/php-v/akrambe/shotify)

No need for Nodejs/npm!

# Documentation
* [Installation](#installation)
* [Usage](#usage)

<a name="installation"></a>
# Installation
The best way to install this package is through your terminal via Composer.
```
composer require akrambe/shotify
```

<a name="usage"></a>
# Usage
```php
<?php

require('vendor/autoload.php');

// PDF print from url
Shotify\Launcher::fromUrl('http://example.com')
            ->saveToPDF('example.pdf');

// Screenshot
Shotify\Launcher::fromUrl('http://example.com')
            ->captureScreenshot('hello.png',
                (new Shotify\Options\ScreenshotOptions)
                    ->setQuality(70)
                    ->setFormat('png')
            );
            
// Get document outer HTML
$html = Shotify\Launcher::fromUrl('http://example.com')
            ->outerHtml();
            
```


<a name="license"></a>
## License

Shotify is licensed under the terms of the **GNU General Public License v3.0**
(See LICENSE file for details).

---

