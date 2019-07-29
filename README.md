# Shotify
Html to PDF and web page screenshots using headless Chrome with no need for Nodejs/npm.

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
            ->setChromeExePath('/path/to/chrome')
            ->saveToPDF('example.pdf');

// Screenshot
Shotify\Launcher::fromUrl('http://example.com')
            ->setChromeExePath('/path/to/chrome')
            ->captureScreenshot('hello.png',
                (new ScreenshotOptions)
                    ->setQuality(70)
                    ->setFormat('png')
            );
            
// Get document outer HTML
$html = Shotify\Launcher::fromUrl('http://example.com')
            ->setChromeExePath('/path/to/chrome')
            ->outerHtml();
            
```


<a name="license"></a>
## License

Shotify is licensed under the terms of the **GNU General Public License v3.0**
(See LICENSE file for details).

---

