<?php

namespace Donatorsky\Enum\Tests;

use Donatorsky\Enum\Enum;


/**
 * Class Rectangle
 *
 * @method static Rectangle SMALL()
 * @method static Rectangle MEDIUM()
 * @method static Rectangle LARGE()
 *
 * @package Donatorsky\Enum\Tests
 */
class Rectangle extends Enum
{

    public const SMALL  = [ 2,  3, 'RED'];
    public const MEDIUM = [ 5,  8, 'GREEN'];
    public const LARGE  = [13, 21, 'BLUE'];

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var float
     */
    protected $area;

    /**
     * @var Color
     */
    protected $color;


    /**
     * Rectangle constructor.
     *
     * @param float  $width
     * @param float  $height
     * @param string $color
     */
    protected function __construct(float $width, float $height, string $color)
    {
        $this->width = $width;
        $this->height = $height;
        $this->area = $width * $height;
        $this->color = Color::$color();
    }


    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }


    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }


    /**
     * @return Color
     */
    public function getColor(): Color
    {
        return $this->color;
    }


    /**
     * @return float
     */
    public function getArea(): float
    {
        return $this->area;
    }
}