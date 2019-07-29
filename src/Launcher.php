<?php

namespace Shotify;

use ChromeDevtoolsProtocol\Context;
use ChromeDevtoolsProtocol\Model\DOM\GetDocumentRequest;
use ChromeDevtoolsProtocol\Model\DOM\GetOuterHTMLRequest;
use ChromeDevtoolsProtocol\Model\DOM\SetOuterHTMLRequest;
use ChromeDevtoolsProtocol\Model\Page\CaptureScreenshotRequest;
use ChromeDevtoolsProtocol\Model\Page\NavigateRequest;
use ChromeDevtoolsProtocol\Model\Page\PrintToPDFRequest;
use Shotify\Options\PdfPrintOptions;
use Shotify\Options\ScreenshotOptions;
use \Exception;


/**
 * Chrome Browser Launcher.
 *
 * @author Akram Alberkawi <a@akram.me>
 */
class Launcher
{
    /**
     * @var \ChromeDevtoolsProtocol\ContextInterface
     */
    private $ctx;
    /**
     * @var \ChromeDevtoolsProtocol\Instance\ProcessInstance
     */
    private $instance;
    /**
     * @var \ChromeDevtoolsProtocol\DevtoolsClientInterface
     */
    private $devtools;

    /**
     * @var string
     */
    private $html;
    private $url;
    private $executablePath;


    /**
     * @param string $url
     * @return Launcher
     */
    static function fromUrl(string $url)
    {
        $launcher = (new static());
        $launcher->url = $url;
        return $launcher;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setChromeExePath(string $path){
        $this->executablePath = $path;
        return $this;
    }

    /**
     * @param string $html
     * @return Launcher
     */
    static function withHtml(string $html)
    {
        $launcher = (new static());
        $launcher->html = $html;
        return $launcher;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function outerHtml()
    {
        $this->init(30);
        $doc = $this->devtools->dom()->getDocument($this->ctx, GetDocumentRequest::make());
        $nodeId = $doc->root->nodeId;

        $outerHtmlResp = $this->devtools->dom()->getOuterHTML($this->ctx, GetOuterHTMLRequest::builder()->setNodeId($nodeId)->build());
        $this->cleanUp();
        return $outerHtmlResp->outerHTML;
    }

    /**
     * @param string $path
     * @param ScreenshotOptions|null $screenshotOptions
     * @return bool
     */
    public function captureScreenshot($path = 'screenshot.jpg', ScreenshotOptions $screenshotOptions = null){
        try {
            $this->init(30);
            $request = is_null($screenshotOptions) ? CaptureScreenshotRequest::make() : CaptureScreenshotRequest::fromJson($screenshotOptions);
            $resp = $this->devtools->page()->captureScreenshot($this->ctx, $request);
            file_put_contents($path, base64_decode($resp->data));
            $this->cleanUp();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param string $path
     * @param PdfPrintOptions|null $pdfOptions
     * @return bool
     */
    public function saveToPDF($path = 'sample.pdf', PdfPrintOptions $pdfOptions = null)
    {
        try {
            $this->init(30);
            $request = is_null($pdfOptions) ? PrintToPDFRequest::make() : PrintToPDFRequest::fromJson($pdfOptions);
            $resp = $this->devtools->page()->printToPDF($this->ctx, $request);
            file_put_contents($path, base64_decode($resp->data));
            $this->cleanUp();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * @param int $timeout
     * @return $this
     * @throws Exception
     */
    private function init(int $timeout)
    {
        $this->ctx = Context::withTimeout(Context::background(), $timeout /* seconds */);
        $launcher = new \ChromeDevtoolsProtocol\Instance\Launcher();

        if (!empty($this->executablePath))
            $launcher->setExecutable($this->executablePath);

        $this->instance = $launcher->launch($this->ctx);
        // work with new tab
        $tab = $this->instance->open($this->ctx);
        $tab->activate($this->ctx);

        $this->devtools = $tab->devtools();
        $this->devtools->page()->enable($this->ctx);



        if(isset($this->url)){
            $this->navigate($this->url);
        }elseif(isset($this->html)){
            $this->setDocumentHtml($this->html);
        }
        return $this;
    }

    /**
     * @param string $url
     * @throws \Exception
     */
    private function navigate(string $url)
    {
        try {
            $this->devtools->page()->navigate($this->ctx, NavigateRequest::builder()->setUrl($url)->build());

            $this->devtools->page()->awaitLoadEventFired($this->ctx);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $html
     */
    private function setDocumentHtml($html)
    {
        $doc = $this->devtools->dom()->getDocument($this->ctx, GetDocumentRequest::make());
        $nodeId = $doc->root->nodeId;
        $this->devtools->dom()->setOuterHTML($this->ctx,
            SetOuterHTMLRequest::builder()
                ->setNodeId($nodeId)
                ->setOuterHTML($html)
                ->build());
    }

    /**
     * Close devtools and Chrome Instance
     */
    public function cleanUp()
    {
        $this->devtools->close();
        $this->instance->close();
    }

}