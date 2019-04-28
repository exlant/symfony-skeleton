<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Trait TEntityManagerAware
 *
 * @package App\Core\Traits\Aware
 */
trait TEntityManagerAware
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * @return EntityManagerInterface
     */
    final protected function getEm(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @required
     * @param EntityManagerInterface $em
     *
     * @return static
     */
    final public function setEm(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}