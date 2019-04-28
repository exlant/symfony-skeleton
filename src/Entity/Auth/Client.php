<?php
declare(strict_types=1);

namespace App\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * @ORM\Entity
 */
class Client extends BaseClient
{
    public const TABLE = 'client';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @var string
     */
    protected $randomId;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var array
     */
    protected $redirectUris;

    /**
     * @var array
     */
    protected $allowedGrantTypes;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}