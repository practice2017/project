<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/CommentFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Entity\Blog;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setUser('Татьяна Куликова');
        $comment->setComment('Обращаю ваше внимание на то, что скоро будет тест, посвященный кинематике');
        $comment->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Анна Коваль');
        $comment->setComment('Можно на уроке еще рассмотреть несколько задач по механике Ньютона?');
        $comment->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}