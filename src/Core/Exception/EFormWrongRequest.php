<?php
declare(strict_types=1);

namespace App\Core\Exception;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EWrongRequestData
 *
 * @package App\Core\Exception
 */
class EFormWrongRequest extends AException implements IFormWrongRequest
{
    /** @var Form */
    private $form;
    
    /** @var int */
    private $status;

    /** @var array */
    private $groups;

    /**
     * EFormWrongRequest constructor.
     * @param Form $form
     * @param int|null $status
     * @param array $groups
     */
    public function __construct(Form $form, int $status, array $groups)
    {
        $this->groups = $groups;
        $this->form = $form;
        $this->status = $status ?: Response::HTTP_OK;
        
        parent::__construct();
    }
    
    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }
    
    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }
}