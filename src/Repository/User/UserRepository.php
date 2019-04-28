<?php
declare(strict_types=1);

namespace App\Repository\User;

use App\Core\Abstracts\ARepository;
use App\Entity\User\User;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserRepository
 *
 * @package App\Repository\User
 *
 * @method User|null findOneByEmail(string $email)
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ARepository
{
    public const ALIAS = 'user';

    /**
     * UserRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
}