<?php

namespace Donatorsky\Enum;

use DomainException;


interface Enumerable
{

    /**
     * @inheritdoc
     */
    public function __toString(): string;


    /**
     * Returns all values.
     *
     * @return Enumerable[]
     */
    public static function all(): array;


    /**
     * Returns all available enum symbols.
     *
     * @return array
     */
    public static function keys(): array;


    /**
     * Checks if given symbol is valid Enum symbol.
     *
     * @param string $symbol Name of the constant to check if exists
     *
     * @return bool
     */
    public static function exists(string $symbol): bool;


    /**
     * Checks if given value is valid for enum.
     *
     * @param mixed $value  Value to check
     * @param bool  $strict Use strict matching
     *
     * @return bool
     */
    public static function has($value, bool $strict = true): bool;


    /**
     * Returns the enum constant of the specified enum type with the specified name.
     *
     * @param string $class  Class name of the enum type from which to return a constant
     * @param string $symbol Name of the constant to return
     *
     * @return Enumerable
     */
    public static function valueOf(string $class, string $symbol): Enumerable;


    /**
     * Creates enum instance for valid symbol value, otherwise fails.
     *
     * @param mixed $value  Value to search for
     * @param bool  $strict Use strict matching
     *
     * @return Enumerable
     *
     * @throws DomainException
     */
    public static function fromValue($value, bool $strict): Enumerable;


    /**
     * Returns true if the specified object is equal to this enum constant.
     *
     * @param Enumerable $object Object to be compared for equality with this object
     *
     * @return bool
     */
    public function equals(Enumerable $object): bool;


    /**
     * Gets original Enum name.
     *
     * @return string
     */
    public function name(): string;


    /**
     * Returns a hash code for this enum constant.
     *
     * @return string
     */
    public function hashCode(): string;
}