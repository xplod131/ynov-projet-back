<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hash;
    public function __construct(UserPasswordHasherInterface $hash)
    {
        $this->hash = $hash;
    }

    public function load(ObjectManager $manager)
    {
        // Create a user with the "admin" role
        $adminUser = new User();
        $adminUser->setEmail('admin@example.com');
        $adminUser->setPassword($this->hash->hashPassword($adminUser, 'password'));
        $adminUser->setRoles(['ROLE_ADMIN']);

        // Create a user with no roles
        $regularUser = new User();
        $regularUser->setEmail('user@example.com');
        $regularUser->setPassword($this->hash->hashPassword($regularUser, 'password'));
        $regularUser->setRoles(['ROLE_USER']);

        $regularUserOther = new User();
        $regularUserOther->setEmail('user1@example.com');
        $regularUserOther->setPassword($this->hash->hashPassword($regularUserOther, 'password'));
        $regularUserOther->setRoles(['ROLE_USER']);

        // Save the users to the database
        $manager->persist($adminUser);
        $manager->persist($regularUser);
        $manager->persist($regularUserOther);
        $manager->flush();
    }
}