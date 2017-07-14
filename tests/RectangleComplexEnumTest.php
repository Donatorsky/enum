<?php

namespace Donatorsky\Enum\Tests;

use PHPUnit\Framework\TestCase;


class RectangleComplexEnumTest extends TestCase
{

    /**
     * @covers Rectangle::getWidth()
     * @covers Rectangle::getHeight()
     * @covers Rectangle::getArea()
     * @covers Rectangle::getColor()
     */
    public function testGetters()
    {
        $rectangle = Rectangle::SMALL();

        $this->assertEquals(2, $rectangle->getWidth());
        $this->assertEquals(3, $rectangle->getHeight());
        $this->assertEquals(6, $rectangle->getArea());

        $color = $rectangle->getColor();

        $this->assertInstanceOf(Color::class, $color);
        $this->assertSame(Color::RED(), $color);
    }


    /**
     * @covers Enum::equals()
     */
    public function testEquals()
    {
        $color = Color::RED();
        $rectangle = Rectangle::MEDIUM();

        $this->assertFalse($rectangle->equals($color));
    }


    /**
     * @covers Enum::is()
     */
    public function testIs()
    {
        $rectangle = Rectangle::MEDIUM();

        $this->assertFalse($rectangle->is('RED'));
    }


    /**
     * @covers Enum::fromValue()
     */
    public function testGetEnumFromValidValueLoose()
    {
        $color = Rectangle::fromValue([5, '8', 'GREEN'], false);

        $this->assertInstanceOf(Rectangle::class, $color);
        $this->assertSame($color, Rectangle::MEDIUM());
    }


    /**
     * @covers Enum::fromValue()
     */
    public function testGetEnumFromValidValueStrict()
    {
        $color = Rectangle::fromValue([5, 8, 'GREEN']);

        $this->assertInstanceOf(Rectangle::class, $color);
        $this->assertSame($color, Rectangle::MEDIUM());
    }


    /**
     * @covers Enum::fromValue()
     *
     * @expectedException \DomainException
     * @expectedExceptionMessage Given value does not exist
     */
    public function testGetEnumFromInvalidValueLoose()
    {
        Rectangle::fromValue([5, 8, 'RED'], false);
    }


    /**
     * @covers Enum::fromValue()
     *
     * @expectedException \DomainException
     * @expectedExceptionMessage Given value does not exist
     */
    public function testGetEnumFromInvalidValueStrict()
    {
        Rectangle::fromValue([5, '8', 'GREEN']);
    }
}