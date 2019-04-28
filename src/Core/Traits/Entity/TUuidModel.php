<?php
declare(strict_types=1);

namespace App\Core\Traits\Entity;

use Ramsey\Uuid\Uuid;
use App\Core\Extra\EGroups;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TUuidModel
 * @package App\Core\Traits\Entity
 */
trait TUuidModel
{
    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @Groups({EGroups::LIST,EGroups::ITEM,EGroups::PROFILE})
     */
    protected $uuid;

    /**
     * @return mixed
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @return static
     * @throws \Exception
     */
    public function setUuid()
    {
        $this->uuid = (string) Uuid::uuid4();

        return $this;
    }
}