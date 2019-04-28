<?php
declare(strict_types=1);

namespace App\Core\Traits\Helpers;

use Symfony\Component\DependencyInjection\Container;

/**
 * Trait TClassHelper
 * @package App\Core\Traits\Helpers
 */
trait TClassHelper
{
    /**
     * @return string
     */
    protected static function makeAlias(): string
    {
        $className = static::class;

        return Container::underscore(strrchr($className, '\\'));
    }
}