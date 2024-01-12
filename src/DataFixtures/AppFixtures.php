<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setUsername('user')
            ->setPassword('password');

        $article = new Article();
        $article
            ->setName('article 1');

        $manager->persist($user);
        $manager->persist($article);


        $manager->flush();
    }
}
