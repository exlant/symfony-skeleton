<?php
declare(strict_types=1);

namespace App\Core\Services;

use App\Core\Services\Parsers\ExceptionParser;
use App\Core\Services\Parsers\FormErrorParser;
use App\Core\Traits\Aware\TJsonEncoderAware;
use Symfony\Component\Form\FormErrorIterator;

/**
 * Class Converter
 *
 * @package App\Core\Services
 */
class Converter
{
    use TJsonEncoderAware;

    /** @var ExceptionParser  */
    private $exceptionParser;

    /** @var FormErrorParser  */
    private $formErrorParser;

    /**
     * Converter constructor.
     * @param ExceptionParser $exceptionParser
     * @param FormErrorParser $formErrorParser
     */
    public function __construct(
        ExceptionParser $exceptionParser,
        FormErrorParser $formErrorParser
    ) {
        $this->exceptionParser = $exceptionParser;
        $this->formErrorParser = $formErrorParser;
    }

    /**
     * @param $data
     * @param array $context
     *
     * @return string
     * @throws \App\Core\Exception\ENullArgument
     */
    public function jsonEncode($data, array $context): string
    {
        return $this->getJsonEncoder()->encode($data, $context);
    }

    /**
     * @param string $data
     * @param array $context
     *
     * @return mixed
     * @throws \App\Core\Exception\ENullArgument
     */
    public function jsonDecode(string $data, array $context)
    {
        return $this->getJsonEncoder()->decode($data, $context);
    }

    /**
     * @param \Exception $exception
     * @param null|int $options
     *
     * @return array|string
     * @throws \App\Core\Exception\ENullArgument
     */
    public function parseException(\Exception $exception, $options = null)
    {
        return $this->exceptionParser->parse($exception, $options);
    }

    /**
     * @param FormErrorIterator $formError
     * @param int|null $options
     *
     * @return array|string
     * @throws \App\Core\Exception\ENullArgument
     */
    public function parseFormErrors(FormErrorIterator $formError, $options = null)
    {
        return $this->formErrorParser->parse($formError, $options);
    }
}