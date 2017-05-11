<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('BloggerBundle:Page:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('BloggerBundle:Page:about.html.twig');
    }

    public function themesAction()
    {

        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->createQueryBuilder()
            ->select('b')
            ->from('BloggerBundle:Blog',  'b')
            ->addOrderBy('b.created', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('BloggerBundle:Page:themes.html.twig', array(
            'blogs' => $blogs
        ));
    }

}

