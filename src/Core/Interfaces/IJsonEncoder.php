<?php
declare(strict_types=1);


namespace App\Core\Interfaces;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

/**
 * Interfase IJsonDecoder
 *
 * @package App\Core\Interfaces
 */
interface IJsonEncoder extends DecoderInterface, EncoderInterface
{
    /**
     * @inheritDoc
     */
    public function decode($data, $format = null, array $context = []);

    /**
     * @inheritDoc
     */
    public function supportsDecoding($format = null): bool;

    /**
     * @inheritDoc
     */
    public function encode($data, $format = null, array $context = []);

    /**
     * @inheritDoc
     */
    public function supportsEncoding($format = null): bool ;
}