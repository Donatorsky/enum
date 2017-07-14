<?php

namespace Donatorsky\Enum\Tests;

use Donatorsky\Enum\Enum;
use PHPUnit\Framework\TestCase;


class ColorSimpleEnumTest extends TestCase
{

    /**
     * @covers Enum::all()
     */
    public function testGetAllValues()
    {
        $colors = Color::all();

        $excepted = [
            Color::RED(),
            Color::GREEN(),
            Color::BLUE(),
        ];

        $this->assertSame($excepted, $colors);
    }

    /**
     * @covers Enum::keys()
     */
    public function testGetAllAvailableKeys()
    {
        $keys = Color::keys();

        $excepted = [
            'RED',
            'GREEN',
            'BLUE',
        ];

        $this->assertSame($excepted, $keys);
    }


    /**
     * @covers Enum::exists()
     */
    public function testIfSymbolExists()
    {
        $this->assertTrue(Color::exists('BLUE'));
    }


    /**
     * @covers Enum::exists()
     */
    public function testIfSymbolNotExists()
    {
        $this->assertFalse(Color::exists('ORANGE'));
    }


    /**
     * @covers Enum::has()
     */
    public function testIfEnumHasValue()
    {
        $this->assertTrue(Color::has('#00FF00'));
    }


    /**
     * @covers Enum::has()
     */
    public function testIfEnumDoesNotHaveValue()
    {
        $this->assertFalse(Color::has('#012abc'));
    }


    /**
     * @covers Enum::__callStatic()
     * @covers Enum::name()
     */
    public function testGetSymbol()
    {
        $color = Color::BLUE();

        $this->assertInstanceOf(Color::class, $color);
        $this->assertSame($color->name(), 'BLUE');
    }


    /**
     * @covers Enum::valueOf()
     * @covers Enum::name()
     */
    public function testValueOf()
    {
        $color = Enum::valueOf(Color::class, 'GREEN');

        $this->assertInstanceOf(Color::class, $color);
        $this->assertSame($color->name(), 'GREEN');
    }


    /**
     * @covers Enum::fromValue()
     */
    public function testGetEnumFromValidValueLoose()
    {
        $color = Color::fromValue('#0000FF', false);

        $this->assertInstanceOf(Color::class, $color);
        $this->assertSame($color, Color::BLUE());
    }


    /**
     * @covers Enum::fromValue()
     */
    public function testGetEnumFromValidValueStrict()
    {
        $color = Color::fromValue('#0000FF');

        $this->assertInstanceOf(Color::class, $color);
        $this->assertSame($color, Color::BLUE());
    }


    /**
     * @covers Enum::fromValue()
     *
     * @expectedException \DomainException
     * @expectedExceptionMessage Given value does not exist
     */
    public function testGetEnumFromInvalidValueLoose()
    {
        Color::fromValue('#012abc', false);
    }


    /**
     * @covers Enum::fromValue()
     *
     * @expectedException \DomainException
     * @expectedExceptionMessage Given value does not exist
     */
    public function testGetEnumFromInvalidValueStrict()
    {
        Color::fromValue('#012abc');
    }


    /**
     * @covers Enum::equals()
     */
    public function testEquals()
    {
        $color1 = Color::BLUE();
        $color2 = Enum::valueOf(Color::class, 'BLUE');

        $this->assertTrue($color1->equals($color2));
    }


    /**
     * @covers Enum::is()
     */
    public function testIs()
    {
        $color = Color::BLUE();

        $this->assertTrue($color->is('BLUE'));
    }


    /**
     * @covers Enum::hashCode()
     */
    public function testHashCode()
    {
        $color = Color::BLUE();

        $this->assertSame(Color::class . '::BLUE', $color->hashCode());
    }


    /**
     * @covers Color::getColor()
     */
    public function testGetColor()
    {
        $color = Color::BLUE();

        $this->assertSame($color->getColor(), '#0000FF');
    }


    /**
     * @expectedException \Donatorsky\Enum\InvalidSymbolException
     * @expectedExceptionMessage Symbol ORANGE is invalid.
     */
    public function testInvalidKey1()
    {
        Color::ORANGE();
    }


    /**
     * @expectedException \Donatorsky\Enum\InvalidSymbolException
     * @expectedExceptionMessage Symbol blue is invalid.
     */
    public function testInvalidKey2()
    {
        Color::blue();
    }


    /**
     * @expectedException \Donatorsky\Enum\InvalidSymbolException
     * @expectedExceptionMessage Symbol green is invalid.
     */
    public function testInvalidKey3()
    {
        Enum::valueOf(Color::class, 'green');
    }
}