<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBag;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Trait TParameterContainerAware
 *
 * @package App\Core\Traits\Aware
 */
trait TParameterContainerAware
{
    /** @var ContainerBag */
    private $parameterContainer;

    /**
     * @required
     * @param ContainerBagInterface $bag
     *
     * @return static
     */
    final public function setParameterContainer(ContainerBagInterface $bag): self
    {
        $this->parameterContainer = $bag;

        return $this;
    }

    /**
     * @return ContainerBag|ParameterBag
     */
    final protected function parameter(): ContainerBag
    {
        return $this->parameterContainer;
    }
}