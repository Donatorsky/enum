# enum
Enumeration library for a PHP 7.1+

An enum type is useful when there is need to allow only one of limited set of values to be accepted. It also helps logically group them in one place.

Its interface is mostly based on [java.lang.Enum](https://docs.oracle.com/javase/7/docs/api/java/lang/Enum.html), but implementation adds some more magic to it.

A basic usage:
```php
namespace My\App;


/**
 * List of all available days.
 *
 * @method static Day MONDAY()
 * @method static Day TUESDAY()
 * @method static Day WEDNESDAY()
 * @method static Day THURSDAY()
 * @method static Day FRIDAY()
 * @method static Day SATURDAY()
 * @method static Day SUNDAY()
 */
class Day extends \Donatorsky\Enum\Enum
{

    // Make available values private/protected if You want to force using getters
    private const MONDAY    = 1;
    private const TUESDAY   = 2;
    private const WEDNESDAY = 3;
    private const THURSDAY  = 4;
    private const FRIDAY    = 5;
    private const SATURDAY  = 6;
    private const SUNDAY    = 7;

    /**
     * @var int
     */
    protected $value;


    /**
     * Day constructor.
     *
     * @param int $value
     */
    protected function __construct(int $value)
    {
        $this->value = $value;
    }


    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}

// Somewhere deep in code...

function getDeveloperState(Day $day): string
{
    switch ($day) {
        case Day::MONDAY():
            return 'Get redy to work';
        break;

        case Day::TUESDAY():
        case Day::WEDNESDAY():
        case Day::THURSDAY():
            return 'Work hard';
        break;

        case Day::FRIDAY():
            return 'Save all work';
        break;

        case Day::SATURDAY():
        case Day::SUNDAY():
            return 'Save all work';
        break;

        // If You add new constants
        default:
            return 'Where am I?!';
        break;
    }
}

// Let's see what to do on friday...
echo getDeveloperState(Day::FRIDAY()) . PHP_EOL;

// Or today
/**
 * In fact fromValue() will always return object of type that was called on
 * @var Day $today
 */
$today = Day::fromValue(date('N'), false);

echo getDeveloperState($today) . PHP_EOL;

// Get constant name of current day
echo $today->name() . PHP_EOL;

// Or check if it is specified day
echo 'Is monday today? ' . ($today->is('MONDAY') ? 'Yes' : 'No') . PHP_EOL;

// Or check it in other way
echo 'Is monday today? ' . ($today->equals(Day::MONDAY()) ? 'Yes' : 'No') . PHP_EOL;

// Tell me who am I...
// Note: Also __toString() uses hashCode(), so "$today" will work unless hashcode() is overwritten
echo $today->hashCode() . PHP_EOL;

// Call (optional) getter of value
echo 'Value of current day is ' . $today->getValue();

// Let's see if there is a day named...
echo 'Is NON_EXISTING_DAY real? ' . (Day::has('NON_EXISTING_DAY') ? 'Yes' : 'No') . PHP_EOL;

// So which days are true?
echo 'Please, choose one of following days: ' . implode(', ', Day::keys()) . PHP_EOL;

// Ok, last question
// Note: valueOf() returns object of Day class
echo 'What is the value of WEDNESDAY? ' . Day::valueOf(Day::class, 'WEDNESDAY')->getValue();
```

Main difference with other implementations is that it is allowed for constants to have complex value:
```php
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
```