<?php

namespace Donatorsky\Enum;

use LogicException;
use Throwable;


/**
 * Class InvalidSymbolException
 */
class InvalidSymbolException extends LogicException
{

    /**
     * @var string
     */
    public $symbol;


    /**
     * InvalidSymbolException constructor.
     *
     * @inheritdoc
     */
    public function __construct($symbol = "", $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->symbol = $symbol;
    }
}