<?php
declare(strict_types=1);

namespace App\Entity\AirTransport;

use App\Core\Traits\Entity\TCreatedAtModel;
use App\Core\Traits\Entity\TUpdatedAtModel;
use App\Core\Traits\Entity\TUuidModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Airport
 * @package App\Entity\AirTransport
 *
 */
class Airport
{
    use TUuidModel;
    use TCreatedAtModel;
    use TUpdatedAtModel;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="iata", type="string", length=3, nullable=false)
     */
    private $iata;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;
}