<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use App\Core\Decorators\DJsonEncoder;
use App\Core\Exception\ENullArgument;
use App\Core\Exception\ExceptionFactory;
use App\Core\Interfaces\IJsonEncoder;

/**
 * Trait TJsonEncoderAware
 * @package App\Core\Traits\Aware
 */
trait TJsonEncoderAware
{
    /** @var IJsonEncoder */
    private $jsonEncoder;

    /**
     * @return IJsonEncoder
     * @throws ENullArgument
     */
    protected function getJsonEncoder(): IJsonEncoder
    {
        if (null === $this->jsonEncoder) {
            throw ExceptionFactory::nullArgument();
        }

        return $this->jsonEncoder;
    }

    /**
     * @required
     * @param IJsonEncoder $jsonEncoder
     */
    public function setJsonEncoder(IJsonEncoder $jsonEncoder): void
    {
        $this->jsonEncoder = $jsonEncoder;
    }
}