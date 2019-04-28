<?php
declare(strict_types=1);

namespace App\Core\Extra;

/**
 * Class EGroups
 * @package App\Core\Extra
 */
class EGroups
{
    public const ALL = [self::ITEM, self::LIST, self::POST, self::PUSH];
    public const READ = [self::ITEM, self::LIST];
    public const WRITE = [self::POST, self::PUSH];
    public const READ_POST = [self::ITEM, self::LIST, self::POST];
    public const READ_PUSH = [self::ITEM, self::LIST, self::PUSH];
    public const WRITE_ITEM = [self::ITEM, self::PUSH, self::POST];
    public const WRITE_LIST = [self::LIST, self::PUSH, self::POST];

    public const PROFILE = 'profile';
    public const ITEM = 'item';
    public const LIST = 'list';
    public const POST = 'post';
    public const PUSH = 'push';

    public const AUTH_IN = 'auth:in';
    public const AUTH_OUT = 'auth:out';

}