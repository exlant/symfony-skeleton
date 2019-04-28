<?php
declare(strict_types=1);

namespace App\Entity\User;

use App\Core\Traits\Entity\TCreatedAtModel;
use App\Core\Traits\Entity\TIdentifierModel;
use App\Core\Traits\Entity\TUpdatedAtModel;
use App\Core\Traits\Entity\TUuidModel;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package App\Entity\User
 *
 * @ORM\Entity(repositoryClass="App\Reposytory\User\UserReposytory")
 */
class User extends BaseUser
{
    use TUuidModel;
    use TCreatedAtModel;
    use TUpdatedAtModel;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}