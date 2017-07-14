<?php

namespace Donatorsky\Enum;

use DomainException;
use ReflectionClass;


/**
 * Class Enum
 *
 * PHP's Enum implementation.
 *
 * @author Maciej Kudas <maciejkudas@gmail.com>
 * @link   https://github.com/Donatorsky/enum
 */
abstract class Enum implements Enumerable
{

    /**
     * @var array[]
     */
    protected static $__cache = [];

    /**
     * @var array[]
     */
    protected static $__constants = [];

    /**
     * @var string
     */
    protected $__name;


    /**
     * Enum constructor.
     */
    protected function __construct()
    {

    }


    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return (string) $this->hashCode();
    }


    /**
     * @inheritdoc
     */
    function __clone()
    {
        self::__prepareCache();
    }


    /**
     * Creates new enum instance.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return Enum
     *
     * @throws InvalidSymbolException
     */
    public static function __callStatic(string $name, array $arguments = []): self
    {
        $class = get_called_class();

        self::__prepareCache();

        if (!array_key_exists($name, static::$__constants[$class])) {
            throw new InvalidSymbolException($name, "Symbol $name is invalid.");
        }

        if (array_key_exists($name, static::$__cache[$class])) {
            return static::$__cache[$class][$name];
        }

        static::$__cache[$class][$name] = new static(...self::__toArray(static::$__constants[$class][$name]));

        static::$__cache[$class][$name]->setName($name);

        return static::$__cache[$class][$name];
    }


    /**
     * @inheritdoc
     */
    public static function all(): array
    {
        return array_map(function ($symbol) {
            return static::$symbol();
        }, self::keys());
    }


    /**
     * @inheritdoc
     */
    public static function keys(): array
    {
        self::__prepareCache();

        return array_keys(static::$__constants[get_called_class()]);
    }


    /**
     * @inheritdoc
     */
    public static function exists(string $symbol): bool
    {
        self::__prepareCache();

        return array_key_exists($symbol, static::$__constants[get_called_class()]);
    }


    /**
     * @inheritdoc
     */
    public static function has($value, bool $strict = true): bool
    {
        self::__prepareCache();

        return in_array($value, static::$__constants[get_called_class()], $strict);
    }


    /**
     * @inheritdoc
     */
    public static function valueOf(string $class, string $symbol): Enumerable
    {
        return forward_static_call([$class, $symbol]);
    }


    /**
     * @inheritdoc
     */
    public static function fromValue($value, bool $strict = true): Enumerable
    {
        self::__prepareCache();

        $class = get_called_class();
        $symbol = array_search($value, static::$__constants[$class], $strict);

        if ($symbol === false) {
            throw new DomainException("Given value does not exist in " . $class);
        }

        return self::__callStatic($symbol);
    }


    /**
     * Prepares cache for later use.
     */
    protected static function __prepareCache(): void
    {
        $class = get_called_class();

        if (array_key_exists($class, static::$__cache)) {
            return;
        }

        $reflection = new ReflectionClass($class);

        static::$__cache[$class] = [];
        static::$__constants[$class] = $reflection->getConstants();
    }


    /**
     * Converts given data to an array.
     *
     * @param mixed $mixed Data to be converted
     *
     * @return array
     */
    private static function __toArray($mixed): array
    {
        if (is_array($mixed)) {
            return $mixed;
        }

        return [$mixed];
    }


    /**
     * @inheritdoc
     */
    public function equals(Enumerable $object): bool
    {
        return $this->hashCode() == $object->hashCode();
    }


    /**
     * Returns true if the specified symbol is equal to this enum constant name.
     *
     * @param string $symbol Name of the constant to compare with
     *
     * @return bool
     */
    public function is(string $symbol): bool
    {
        return $this->__name == $symbol;
    }


    /**
     * @inheritdoc
     */
    public function name(): string
    {
        return $this->__name;
    }


    /**
     * @inheritdoc
     */
    public function hashCode(): string
    {
        return get_called_class() . '::' . $this->__name;
    }


    /**
     * Sets name for an Enum object.
     *
     * @param string $name Assign name to an object
     */
    protected function setName(string $name): void
    {
        $this->__name = $name;
    }
}