<?php
declare(strict_types=1);

namespace App\Core\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TIdentifierModel
 *
 * @package App\Core\Traits\Entity
 */
trait TIdentifierModel
{

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
