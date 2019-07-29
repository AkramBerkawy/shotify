<?php

namespace Shotify\Tests;

use PHPUnit\Framework\TestCase;
use Shotify\Launcher;
use Shotify\Options\ScreenshotOptions;

class LauncherTest extends TestCase
{
    var $testHtml = '<html lang="en"><head><title>Welcome HTML</title></head><body></body></html>';
    var $testHtmlTitleAssert = '<title>Welcome HTML</title>';
    var $testUrl = 'http://example.com/';
    var $testUrlTitleAssert = '<title>Example Domain</title>';
    var $exePath = 'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe';

    public function test_from_url()
    {
        $html = Launcher::fromUrl($this->testUrl)
            ->setChromeExePath($this->exePath)
            ->outerHtml();

        self::assertStringContainsString($this->testUrlTitleAssert, $html);
    }

    public function test_with_html()
    {
        $html = Launcher::withHtml($this->testHtml)
            ->setChromeExePath($this->exePath)
            ->outerHtml();

        self::assertStringContainsString($this->testHtmlTitleAssert, $html);
    }

    public function test_outer_html()
    {
        $html = Launcher::withHtml($this->testHtml)
            ->setChromeExePath($this->exePath)
            ->outerHtml();

        self::assertStringContainsString($this->testHtml, $html);
    }

    public function test_print_to_pdf_from_url()
    {
        $result = Launcher::fromUrl($this->testUrl)
            ->setChromeExePath($this->exePath)
            ->saveToPDF('hello.pdf');

        self::assertTrue($result);
        self::assertFileExists('hello.pdf');
    }

    public function test_screenshot()
    {
        $result = Launcher::fromUrl($this->testUrl)
            ->setChromeExePath($this->exePath)
            ->captureScreenshot('hello.jpg');
        self::assertTrue($result);
        self::assertFileExists('hello.jpg');
    }

    public function test_screenshot_with_options()
    {
        $result = Launcher::fromUrl($this->testUrl)
            ->setChromeExePath($this->exePath)
            ->captureScreenshot('hello.png',
                (new ScreenshotOptions)
                    ->setQuality(70)
                    ->setFormat('png')
            );

        self::assertTrue($result);
        self::assertFileExists('hello.png');
    }

}
