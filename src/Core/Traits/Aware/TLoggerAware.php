<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use App\Core\Interfaces\ILogger;

/**
 * Trait TLoggerAware
 *
 * @package App\Core\Traits\Aware
 */
trait TLoggerAware
{
    /** @var ILogger */
    private $logger;

    /**
     * @return ILogger
     */
    final protected function getLogger(): ILogger
    {
        return $this->logger;
    }

    /**
     * @required
     * @param ILogger $logger
     *
     * @return static
     */
    final public function setLogger(ILogger $logger): self
    {
        $this->logger = $logger;

        return $this;
    }
}