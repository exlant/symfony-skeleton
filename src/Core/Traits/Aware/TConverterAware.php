<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use App\Core\Exception\ENullArgument;
use App\Core\Exception\ExceptionFactory;
use App\Core\Services\Converter;

/**
 * Trait TConverterAware
 * @package App\Core\Traits\Aware
 */
trait TConverterAware
{
    /** @var Converter */
    private $converter;

    /**
     * @return Converter
     * @throws ENullArgument
     */
    protected function getConverter(): Converter
    {
        if (null === $this->converter) {
            throw ExceptionFactory::nullArgument();
        }

        return $this->converter;
    }

    /**
     * @required
     * @param Converter $converter
     */
    public function setConverter(Converter $converter): void
    {
        $this->converter = $converter;
    }
}