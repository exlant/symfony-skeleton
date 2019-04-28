<?php
declare(strict_types=1);

namespace App\Core\Abstracts;

use App\Core\Exception\ENullArgument;
use App\Core\Interfaces\IDataParser;
use App\Core\Traits\Aware\TJsonEncoderAware;
use Symfony\Component\Form\FormErrorIterator;

/**
 * Class AParser
 *
 * @package App\Core\Abstracts
 */
abstract class AParser implements IDataParser
{
    use TJsonEncoderAware;

    /** @var \Exception|array|FormErrorIterator */
    protected $input;

    /** @var array|string */
    protected $output;

    /**
     * @param \Exception|FormErrorIterator $data
     * @param $options
     *
     * @return array|string
     * @throws ENullArgument
     */
    public function parse($data, $options)
    {
        $this->input = $data;

        return $this->handle()->applyOptions($options)->getAndClear();
    }

    /**
     * @return AParser
     */
    abstract protected function handle(): AParser;

    /**
     * @param $options
     *
     * @return AParser
     * @throws ENullArgument
     */
    protected function applyOptions(?int $options): AParser
    {
        if ($options & self::TO_JSON) {
            $this->output = $this->getJsonEncoder()->encode($this->output);
        }

        return $this;
    }

    /**
     * @return array|string
     */
    private function getAndClear()
    {
        $prepared = $this->output;
        $this->input = null;
        $this->output = null;

        return $prepared;
    }
}