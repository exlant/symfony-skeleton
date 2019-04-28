<?php
declare(strict_types=1);

namespace App\Core\Traits\Helpers;

use Doctrine\ORM\QueryBuilder;

/**
 * Trait TQueryCriteria
 *
 * @package EssayLancers\ApiBundle\Core\Traits
 */
trait TQueryCriteria
{
    private $placeholderCounter = 0;

    /**
     * @param QueryBuilder $qb
     * @param array $fields
     * @param $value
     *
     * @return self
     */
    public function search(QueryBuilder $qb, array $fields, $value): self
    {
        foreach ($fields as $key => $field) {
            $sql = $field . ' LIKE :search';
            if (0 === $key) {
                $qb->andWhere($sql);
                continue;
            }
            $qb->orWhere($sql);
        }
        $qb->setParameter('search', '%' . $value . '%');

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param int|float|string| $value
     *
     * @return self
     */
    public function gt(QueryBuilder $qb, string $column, $value): self
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' > :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param int|float|string| $value
     * @param bool $first
     *
     * @return self
     * @throws \Exception
     */
    public function gte(QueryBuilder $qb, string $column, $value, bool $first = false): self
    {
        if ($first) {
            $value = (new \DateTime($value))->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        }
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' >= :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param int|float|string $value
     *
     * @return self
     */
    public function lt(QueryBuilder $qb, string $column, $value): self
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' < :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param int|float|string $value
     * @param bool $last
     *
     * @return self
     * @throws \Exception
     */
    public function lte(QueryBuilder $qb, string $column, $value, bool $last = false): self
    {
        if ($last) {
            $value = (new \DateTime($value))->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        }
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' <= :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param int|float|string $value
     *
     * @return self
     */
    public function eq(QueryBuilder $qb, string $column, $value): self
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' = :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param int|float|string $value
     *
     * @return self
     */
    public function neq(QueryBuilder $qb, string $column, $value): self
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' <> :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param array $value
     *
     * @return self
     */
    public function in(QueryBuilder $qb, string $column, array $value): self
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' IN (:' . $placeholder . ')')
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param array $value
     *
     * @return self
     */
    public function nin(QueryBuilder $qb, string $column, array $value): self
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' NOT IN (:' . $placeholder . ')')
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function createPlaceholder(string $name): string
    {
        return (str_replace('.', '_', $name) . ++$this->placeholderCounter);
    }
}