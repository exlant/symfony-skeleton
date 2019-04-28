<?php
declare(strict_types=1);

namespace App\Core\Interfaces;

use Knp\Component\Pager\Pagination\AbstractPagination;

/**
 * Interface IRepository
 * @package App\Core\Interfaces
 */
interface IRepository
{
    /** @return string */
    public function getAlias(): string;

    /**
     * @param mixed $filters
     * @param mixed $order
     * @param mixed $pagination
     *
     * @return AbstractPagination
     */
    public function filterBy($filters = null, $order = null, $pagination = null): AbstractPagination;
}