<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use Twig\Environment;

/**
 * Trait TEnvironmentTwigAware
 *
 * @package App\Core\Traits\Aware
 */
trait TEnvironmentTwigAware
{
    /** @var Environment */
    private $environment;

    /**
     *
     * @required
     * @param Environment $environment
     *
     * @return static
     */
    final public function setEnvironment(Environment $environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @return Environment
     */
    final protected function getTwigEnvironment(): Environment
    {
        return $this->environment;
    }
}