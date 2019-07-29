<?php


namespace Shotify\Options;


class ScreenshotOptions
{
    /**
     * Image compression format (defaults to png).
     *
     * @var string|null
     */
    public $format;

    /**
     * Compression quality from range [0..100] (jpeg only).
     *
     * @var int|null
     */
    public $quality;

    /**
     * Capture the screenshot of a given region only.
     *
     * @var Viewport|null
     */
    public $clip;

    /**
     * Capture the screenshot from the surface, rather than the view. Defaults to true.
     *
     * @var bool|null
     */
    public $fromSurface;

    /**
     * @param string|null $format
     *
     * @return self
     */
    public function setFormat($format): self
    {
        $this->format = $format;
        return $this;
    }


    /**
     * @param int|null $quality
     *
     * @return self
     */
    public function setQuality($quality): self
    {
        $this->quality = $quality;
        return $this;
    }


    /**
     * @param Viewport|null $clip
     *
     * @return self
     */
    public function setClip($clip): self
    {
        $this->clip = $clip;
        return $this;
    }


    /**
     * @param bool|null $fromSurface
     *
     * @return self
     */
    public function setFromSurface($fromSurface): self
    {
        $this->fromSurface = $fromSurface;
        return $this;
    }
}