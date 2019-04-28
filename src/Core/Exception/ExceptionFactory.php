<?php
declare(strict_types=1);

namespace App\Core\Exception;

use Symfony\Component\Form\Form;

/**
 * Class ExceptionFactory
 *
 * @package App\Core\Exception
 */
class ExceptionFactory
{
    /**
     * @param Form $form
     * @param int|null $status
     * @param array $group
     *
     * @return EFormWrongRequest
     */
    public static function wrongRequestData(Form $form, int $status, array $group): EFormWrongRequest
    {
        return new EFormWrongRequest($form, $status, $group);
    }

    /**
     * @param mixed $message
     *
     * @return ENullArgument
     */
    public static function nullArgument($message = null): ENullArgument
    {
        return new ENullArgument($message);
    }
}