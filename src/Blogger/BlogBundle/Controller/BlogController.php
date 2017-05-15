<?php
// src/Blogger/BlogBundle/Controller/BlogController.phpp
namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Blog;
use Symfony\Component\HttpFoundation\Request;


/**
 * BlogType controller.
 */
class BlogController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BloggerBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find BlogType post.');
        }

        $comments = $em->getRepository('BloggerBundle:Comment')
            ->getCommentsForBlog($blog->getId());

        return $this->render('BloggerBundle:Blog:show.html.twig', array(
            'blog'      => $blog,
            'comments'  => $comments
        ));
    }


}