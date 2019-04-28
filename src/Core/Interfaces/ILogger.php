<?php
declare(strict_types=1);

namespace App\Core\Interfaces;

use Psr\Log\LoggerInterface;

/**
 * Interface ILogger
 *
 * @package App\Core\Interfaces\Fasades
 */
interface ILogger extends LoggerInterface
{
    /**
     * @param mixed $item
     * @param bool $toJson
     *
     * @return mixed
     */
    public function makeMessage($item, bool $toJson = true);
}