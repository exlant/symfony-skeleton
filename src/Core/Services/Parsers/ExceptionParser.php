<?php
declare(strict_types=1);

namespace App\Core\Services\Parsers;

use App\Core\Abstracts\AParser;
use App\Core\Exception\ENullArgument;

/**
 * Class ExceptionParser
 *
 * @package App\Core\Services\Parsers
 */
final class ExceptionParser extends AParser
{
    /**
     * @return ExceptionParser
     * @throws ENullArgument
     */
    protected function handle(): AParser
    {
        $message = $this->input->getMessage();
        if (!\is_string($message)) {
            $message = $this->getJsonEncoder()->decode($message);
        }

        $this->output = [
            'message' => $message,
            'file' => $this->input->getFile(),
            'line' => $this->input->getLine(),
            'code' => $this->input->getCode(),
        ];

        return $this;
    }
}