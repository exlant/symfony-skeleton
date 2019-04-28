<?php
declare(strict_types=1);

namespace App\Core\Abstracts;

use App\Core\Interfaces\IRepository;
use App\Core\Traits\Aware\TPaginatorAware;
use App\Core\Traits\Helpers\TQueryCriteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\Pagination\AbstractPagination;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class ARepository
 * @package App\Core\Abstracts
 */
abstract class ARepository extends ServiceEntityRepository implements IRepository
{
    use TQueryCriteria;
    use TPaginatorAware;

    public const ALIAS = '';

    public const EQ = 'eq';     //'='
    public const NEQ = 'neq';   //'<>'
    public const LT = 'lt';     //'<'
    public const LTE = 'lte';   //'<='
    public const LTEL = 'ltel'; //'<=' with time to 23:59:59
    public const GT = 'gt';     //'>'
    public const GTE = 'gte';   //'>='
    public const GTEF = 'gtef'; //'>=' with time to 00:00:00
    public const IN = 'in';     //'IN'
    public const NIN = 'nin';   //'NIN'

    public const PAGE = 1;
    public const LIMIT = 10;

    public const ORDER_FIELD = 'id';
    public const ORDER = 'desc';

    public const OPERATORS = [
        self::EQ, self::NEQ, self::LT, self::LTE, self::LTEL, self::GT, self::GTE, self::GTEF, self::IN, self::NIN
    ];

    /**
     * @return string
     */
    public function getAlias(): string
    {
        if (empty(static::ALIAS)) {
            throw new BadRequestHttpException('Alias can\'t be empty in repository [' . static::class . ']');
        }

        return static::ALIAS;
    }

    /**
     * @param array|null $filters
     * @param array|null $order
     * @param array|null $pagination
     *
     * @return AbstractPagination
     * @throws \Exception
     */
    public function filterBy($filters = null, $order = null, $pagination = null): AbstractPagination
    {
        $qb = $this->createQueryBuilder($this->getAlias());
        $alias = $this->getAlias();

        if ($filters) {
            $this->applyFilters($filters, $qb, $alias, $this->getClassName());
        }

        $this->applyOrder($order ?: [static::ORDER_FIELD => static::ORDER], $qb, $alias, $this->getClassName());


        return $this->applyPagination($pagination, $qb);
    }

    /**
     * @param array|null $pagination
     * @param QueryBuilder $qb
     *
     * @return AbstractPagination|PaginationInterface
     */
    public function applyPagination(?array $pagination, QueryBuilder $qb): AbstractPagination
    {
        $page = (int)($pagination['page'] ?? static::PAGE);
        $limit = (int)($pagination['limit'] ?? static::LIMIT);

        return $this->getPaginator()->paginate($qb, $page, $limit);
    }

    /**
     * @param array $order
     * @param QueryBuilder $qb
     * @param string $alias
     * @param string $className
     *
     * @throws \Exception
     */
    public function applyOrder(array $order, QueryBuilder $qb, string $alias, string $className): void
    {
        $metadata = $this->getEntityManager()->getClassMetadata($className);
        $columns = $metadata->getColumnNames();
        $relationColumns = $metadata->getAssociationMappings();
        foreach ($order as $field => $value) {
            $column = $alias . '.' . $field;
            if (isset($relationColumns[$field]) && !\in_array($field, $qb->getAllAliases(), true)) {
                $qb->leftJoin($column, $field);
                $this->applyOrder($value, $qb, $field, $relationColumns[$field]['targetEntity']);
                continue;
            }

            if (!\in_array($field, $columns, true)) {
                continue;
            }

            $qb->addOrderBy($column, $value);
        }
    }

    /**
     * @param iterable $filters
     * @param QueryBuilder $qb
     * @param string $alias
     * @param string $className
     *
     * @throws \Exception
     */
    public function applyFilters(iterable $filters, QueryBuilder $qb, string $alias, string $className): void
    {
        $metadata = $this->getEntityManager()->getClassMetadata($className);
        $columns = $metadata->getColumnNames();
        $relationColumns = $metadata->getAssociationMappings();
        foreach ($filters as $field => $value) {
            $column = $alias . '.' . $field;
            if (isset($relationColumns[$field]) && !\in_array($field, $qb->getAllAliases(), true)) {
                $qb->leftJoin($column, $field);
                $this->applyFilters($value, $qb, $field, $relationColumns[$field]['targetEntity']);
                continue;
            }

            if (!\in_array($field, $columns, true)) {
                continue;
            }
            $operator = $value['operator'] ?? (\is_array($value) ? $operator = self::IN : self::EQ);
            if (\in_array($value, self::OPERATORS, true)) {
                $msg = 'Wrong operator need [' . implode(', ', self::OPERATORS) . ']' . ', given [' . $operator . ']';
                throw new BadRequestHttpException($msg);
            }

            $value = $value['value'] ?? $value;

            switch ($operator) {
                case (self::EQ): $this->eq($qb, $column, $value); break;
                case (self::IN): $this->in($qb, $column, $value); break;
                case (self::LT): $this->lt($qb, $column, $value); break;
                case (self::LTE): $this->lte($qb, $column, $value); break;
                case (self::LTEL): $this->lte($qb, $column, $value, true); break;
                case (self::GT):  $this->gt($qb, $column, $value); break;
                case (self::GTE): $this->gte($qb, $column, $value); break;
                case (self::GTEF): $this->gte($qb, $column, $value, true); break;
                case (self::NEQ): $this->neq($qb, $column, $value); break;
                case (self::NIN): $this->nin($qb, $column, $value); break;
            }
        }
    }
}