<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Entity\Subtheme;
use Blogger\BlogBundle\Form\EnquiryType;


class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->getRepository('BloggerBundle:Blog')
            ->getLatestBlogs();

        return $this->render('BloggerBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
        //return $this->render('BloggerBundle:Page:index.html.twig');
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

    public function createAction(Request $request)
    {
        $enquiry = new Subtheme();

        $form = $this->createForm(EnquiryType::class, $enquiry);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('BloggerBundle_create'));
            }
        }

        return $this->render('BloggerBundle:Page:create.html.twig', array(
            'form' => $form->createView()
        ));

       // return $this->render('BloggerBundle:Page:create.html.twig');
    }

}

