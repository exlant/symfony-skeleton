<?php
declare(strict_types=1);

namespace App\Core\Decorators;

use App\Core\Interfaces\IJsonEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class DJsonDecoder
 *
 * @package App\Core\Decorators
 */
class DJsonEncoder implements IJsonEncoder
{
    /** @var JsonEncoder */
    private $jsonEncoder;

    /**
     * DJsonDecoder constructor.
     * @param JsonEncoder $jsonEncoder
     */
    public function __construct(JsonEncoder $jsonEncoder)
    {
        $this->jsonEncoder = $jsonEncoder;
    }

    /**
     * @param string $data
     * @param string $format
     * @param array $context
     *
     * @return mixed
     */
    public function decode($data, $format = null, array $context = [])
    {
        return $this->jsonEncoder->decode($data, $format, $context);
    }

    /**
     * @param string $format
     *
     * @return bool
     */
    public function supportsDecoding($format = null): bool
    {
        return $this->jsonEncoder->supportsDecoding($format);
    }


    /**
     * @param mixed $data
     * @param string $format
     * @param array $context
     *
     * @return string
     */
    public function encode($data, $format = null, array $context = []): string
    {

        return $this->jsonEncoder->encode($data, $format, $context);
    }

    /**
     * @param string $format
     *
     * @return bool
     */
    public function supportsEncoding($format = null): bool
    {
        return $this->jsonEncoder->supportsEncoding($format);
    }
}