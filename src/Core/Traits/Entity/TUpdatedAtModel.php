<?php
declare(strict_types=1);

namespace App\Core\Traits\Entity;

use App\Core\Extra\EGroups;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait TUpdatedAtModel
 *
 * @package App\Core\Traits\Entity
 */
trait TUpdatedAtModel
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups(EGroups::READ)
     */
    protected $updatedAt;

    /**
     * Returns updatedAt.
     *
     * @return null|\DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
}