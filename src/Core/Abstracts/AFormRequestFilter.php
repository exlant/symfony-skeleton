<?php
declare(strict_types=1);

namespace App\Core\Abstracts;

use App\Core\Interfaces\IFormRequestFilter;

/**
 * Class AFormRequestFilter
 *
 * @package App\Core\Abstracts
 */
abstract class AFormRequestFilter implements IFormRequestFilter
{
    private $filters;
    
    private $pagination;
    
    private $order;
    
    public function getFilters(): array
    {
        $filters = [];
        foreach ($this->filterFields() as $field) {
            $filters[$field] = $this->$field;
        }
        
        return $filters;
    }
    
    public function getPagination(): array
    {
        // TODO: Implement getPagination() method.
    }
    
    public function getOrder(): array
    {
        // TODO: Implement getOrder() method.
    }
    
    abstract protected function filterFields(): array;
    
    abstract protected function paginationFields(): array;
    
    abstract protected function orderFields(): array;
    
    private function parseFields(array $nameList): array
    {
        $fields = [];
        foreach ($nameList as $name) {
            $fields[$name] = $this->$name;
        }
    
        return $fields;
    }
    
}