<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Auth\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use OAuth2\OAuth2;

/**
 * Class UserData
 *
 * @package AppBundle\DataFixtures
 */
class ClientFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return $this
     */
    public function load(ObjectManager $manager): self
    {
        $client = new Client();
        $client->setRandomId(getenv('OAUTH2_CLIENT_ID'));
        $client->setSecret(getenv('OAUTH2_CLIENT_SECRET'));
        $client->setAllowedGrantTypes([OAuth2::GRANT_TYPE_USER_CREDENTIALS, OAuth2::GRANT_TYPE_REFRESH_TOKEN]);
        $manager->persist($client);
        $manager->flush();
        $manager->getConnection()->exec('UPDATE ' . Client::TABLE . ' SET id = 1;');
        $manager->flush();

        return $this;
    }
}