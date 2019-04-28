<?php
declare(strict_types=1);

namespace App\Core\Traits\Aware;

use Knp\Component\Pager\PaginatorInterface;

/**
 * Trait TPaginatorAware
 * @package App\Core\Traits\Aware
 */
trait TPaginatorAware
{
    private $paginator;

    /**
     * @required
     *
     * @param PaginatorInterface $paginator
     */
    final public function setPaginator(PaginatorInterface $paginator): void
    {
        $this->paginator = $paginator;
    }

    /**
     * @return PaginatorInterface|null
     */
    final protected function getPaginator(): ?PaginatorInterface
    {
        return $this->paginator;
    }
}