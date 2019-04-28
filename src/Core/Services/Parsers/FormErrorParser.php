<?php
declare(strict_types=1);

namespace App\Core\Services\Parsers;

use App\Core\Abstracts\AParser;
use App\Core\Exception\ENullArgument;
use Symfony\Component\Form\FormError;

/**
 * Class FormErrorParser
 *
 * @package App\Core\Services\Parsers
 */
final class FormErrorParser extends AParser
{
    /**
     * @return ExceptionParser
     * @throws ENullArgument
     */
    protected function handle(): AParser
    {
        $data = [];
        /** @var FormError $error */
        foreach ($this->input as $error){
            $data[] = $error->getChildren();
        }

        return $this;
    }
}