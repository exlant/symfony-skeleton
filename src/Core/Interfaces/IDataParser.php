<?php
declare(strict_types=1);


namespace App\Core\Interfaces;

/**
 * Interfase IDataParser
 *
 * @package App\Core\Interfaces
 */
interface IDataParser
{
    public const TO_JSON = 1;

    /**
     * @param mixed $data
     * @param $options
     *
     * @return mixed
     */
    public function parse($data, $options);
}