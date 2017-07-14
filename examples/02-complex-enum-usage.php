<?php

namespace My\App;

require_once '../vendor/autoload.php';


/**
 * List of all available icon sizes.
 *
 * @method static Icon SMALL()
 * @method static Icon MEDIUM()
 * @method static Icon LARGE()
 */
abstract class Icon extends \Donatorsky\Enum\Enum
{

    public const SMALL  = [16, 16];
    public const MEDIUM = [32, 32];
    public const LARGE  = [64, 64];

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
     * Rectangle constructor.
     *
     * @param float $width
     * @param float $height
     */
    protected function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->area = $width * $height;
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
     * @return float
     */
    public function getArea(): float
    {
        return $this->area;
    }


    /**
     * @return float
     */
    public function getDiagonal(): float
    {
        return $this->width * M_SQRT2;
    }
}

/**
 * List of all available user icon sizes.
 *
 * @method static UserIcon PROFILE()
 * @method static UserIcon HORIZONTAL()
 */
class UserIcon extends Icon
{

    public const PROFILE    = [128, 128];
    public const HORIZONTAL = [512, 128];


    public function getDiagonal(): float
    {
        return sqrt($this->width * $this->width + $this->height * $this->height);
    }
}

/**
 * List of all available product icon sizes.
 *
 * @method static ProductIcon TINY()
 * @method static ProductIcon HUGE()
 */
class ProductIcon extends Icon
{

    public const TINY = [ 8,  8];   // Well, not really useful i guess
    public const HUGE = [96, 96];
}

// Just for example to work
class Image /* extends SomeGraphicProcessingLibrary */
{

    public static function open($image)
    {
        // ...
        return new static($image);
    }


    public function resize($width, $height)
    {
        // ...

        return $this;
    }
}

class UploadController /* extends Controller */
{

    public function uploadUserAvatar($request, int $user_id, UserIcon $size)
    {
        // Parse request

        $image = Image::open($request)->resize($size->getWidth(), $size->getHeight());

        // Further processing...

        // Continue saving...
    }


    public function prepareUserAllImages($request, int $user_id)
    {
        // Parse request

        /**
         * @var UserIcon $icon
         */
        foreach (UserIcon::all() as $icon) {
            $image = Image::open($request)->resize($icon->getWidth(), $icon->getHeight());

            // Further processing...
        }

        // Continue saving...
    }


    public function uploadProductIcon($request, int $product_id, ProductIcon $size)
    {
        // Parse request

        $image = Image::open($request)->resize($size->getWidth(), $size->getHeight());

        // Further processing...

        // Continue saving...
    }
}