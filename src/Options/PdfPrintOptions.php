<?php


namespace Shotify\Options;


class PdfPrintOptions
{
    private $landscape;

    private $displayHeaderFooter;

    private $printBackground;

    private $scale;

    private $paperWidth;

    private $paperHeight;

    private $marginTop;

    private $marginBottom;

    private $marginLeft;

    private $marginRight;

    private $pageRanges;

    private $ignoreInvalidPageRanges;

    private $headerTemplate;

    private $footerTemplate;

    private $preferCSSPageSize;



    /**
     * @param bool|null $landscape
     *
     * @return self
     */
    public function setLandscape($landscape): self
    {
        $this->landscape = $landscape;
        return $this;
    }


    /**
     * @param bool|null $displayHeaderFooter
     *
     * @return self
     */
    public function setDisplayHeaderFooter($displayHeaderFooter): self
    {
        $this->displayHeaderFooter = $displayHeaderFooter;
        return $this;
    }


    /**
     * @param bool|null $printBackground
     *
     * @return self
     */
    public function setPrintBackground($printBackground): self
    {
        $this->printBackground = $printBackground;
        return $this;
    }


    /**
     * @param int|float|null $scale
     *
     * @return self
     */
    public function setScale($scale): self
    {
        $this->scale = $scale;
        return $this;
    }


    /**
     * @param int|float|null $paperWidth
     *
     * @return self
     */
    public function setPaperWidth($paperWidth): self
    {
        $this->paperWidth = $paperWidth;
        return $this;
    }


    /**
     * @param int|float|null $paperHeight
     *
     * @return self
     */
    public function setPaperHeight($paperHeight): self
    {
        $this->paperHeight = $paperHeight;
        return $this;
    }


    /**
     * @param int|float|null $marginTop
     *
     * @return self
     */
    public function setMarginTop($marginTop): self
    {
        $this->marginTop = $marginTop;
        return $this;
    }


    /**
     * @param int|float|null $marginBottom
     *
     * @return self
     */
    public function setMarginBottom($marginBottom): self
    {
        $this->marginBottom = $marginBottom;
        return $this;
    }


    /**
     * @param int|float|null $marginLeft
     *
     * @return self
     */
    public function setMarginLeft($marginLeft): self
    {
        $this->marginLeft = $marginLeft;
        return $this;
    }


    /**
     * @param int|float|null $marginRight
     *
     * @return self
     */
    public function setMarginRight($marginRight): self
    {
        $this->marginRight = $marginRight;
        return $this;
    }


    /**
     * @param string|null $pageRanges
     *
     * @return self
     */
    public function setPageRanges($pageRanges): self
    {
        $this->pageRanges = $pageRanges;
        return $this;
    }


    /**
     * @param bool|null $ignoreInvalidPageRanges
     *
     * @return self
     */
    public function setIgnoreInvalidPageRanges($ignoreInvalidPageRanges): self
    {
        $this->ignoreInvalidPageRanges = $ignoreInvalidPageRanges;
        return $this;
    }


    /**
     * @param string|null $headerTemplate
     *
     * @return self
     */
    public function setHeaderTemplate($headerTemplate): self
    {
        $this->headerTemplate = $headerTemplate;
        return $this;
    }


    /**
     * @param string|null $footerTemplate
     *
     * @return self
     */
    public function setFooterTemplate($footerTemplate): self
    {
        $this->footerTemplate = $footerTemplate;
        return $this;
    }


    /**
     * @param bool|null $preferCSSPageSize
     *
     * @return self
     */
    public function setPreferCSSPageSize($preferCSSPageSize): self
    {
        $this->preferCSSPageSize = $preferCSSPageSize;
        return $this;
    }
}