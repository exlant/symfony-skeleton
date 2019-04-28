<?php
declare(strict_types=1);

namespace App\Core\Extra;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Groups
 *
 * @package App\Core\Extra
 */
class Rules
{

    public const NAME_MIN_LENGTH = 1;
    public const NAME_MAX_LENGTH = 60;

    public const URL_MAX_LENGTH = 255;

    public const EMAIL_MAX_LENGTH = 180;

    public const PASSWORD_MIN_LENGTH = 6;
    public const PASSWORD_MAX_LENGTH = 64;

    public const ROLE_MAX_LENGTH = 40;

    public const PHONE_MAX_LENGTH = 20;
    public const TYPE_MAX_LENGTH = 20;
    public const KEY_MAX_LENGTH = 64;
    public const MESSAGE_MAX_LENGTH = 1024;

}