<?php

namespace Donatorsky\Enum\Tests;

use Donatorsky\Enum\Enum;


/**
 * Class Color
 *
 * @method static Color RED()
 * @method static Color GREEN()
 * @method static Color BLUE()
 *
 * @package Donatorsky\Enum\Tests
 */
class Color extends Enum
{

    public const RED   = '#FF0000';
    public const GREEN = '#00FF00';
    public const BLUE  = '#0000FF';

    /**
     * @var string
     */
    protected $color;


    /**
     * Color constructor.
     *
     * @param string $color
     */
    protected function __construct(string $color)
    {
        if (!preg_match('/^#[0-9a-f]{6}$/im', $color)) {
            throw new \InvalidArgumentException("Color format is invalid");
        }

        $this->color = $color;
    }


    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
}