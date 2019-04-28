<?php
declare(strict_types=1);

namespace App\Core\Exception;

/**
 * Class ENullArgument
 *
 * @package App\Core\Exception
 */
class ENullArgument extends AException
{
    /**
     * ENullArgument constructor.
     * @param mixed $message
     */
    public function __construct($message = null)
    {
        if (null === $message) {
            $message = 'exception.null_argument.trait_aware';
        }
        parent::__construct($message);
    }
}