<?php

namespace My\App;

require_once '../vendor/autoload.php';


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

var_dump(Day::all());