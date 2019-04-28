<?php
declare(strict_types=1);

namespace App\Core\Exception;

use Symfony\Component\Form\Form;

/**
 * Interfase IFormWrongRequest
 *
 * @package App\Core\Exception
 */
interface IFormWrongRequest
{
    /**
     * @return Form
     */
    public function getForm(): Form;
    
    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @return array
     */
    public function getGroups(): array;
}