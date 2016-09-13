<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PagesBundle:Pages')->findBy(
            array('genre'=> 'Page'),
            array('ordre' => 'ASC')
        );

        return $this->render('PagesBundle:Default:pages/modulesUsed/menu.html.twig',array('pages'=>$pages));
    }

    public function pageAction($locale,$slug)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->findOneBy(array('slug'=>$slug)); // ou findonebyslug
        $slides = $em->getRepository('PagesBundle:Pages')->findBy(array('genre'=>'Slide', 'langue'=>$locale)); // ou findonebyslug

        if (!$page) throw $this->createNotFoundException('la page n\'�xiste pas');

        return $this->render('PagesBundle:Default:pages/layout/pages.html.twig',array('page'=>$page,'slides'=>$slides) );
    }

    public function homeAction($locale)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->findOneBy(array('genre'=>'Page','ordre'=>1));
        $slides = $em->getRepository('PagesBundle:Pages')->findBy(array('genre'=>'Slide'));

        if (!$page) throw $this->createNotFoundException('la page n\'�xiste pas');

        return $this->render('PagesBundle:Default:pages/layout/pages.html.twig',array('page'=>$page,'slides'=>$slides) );
    }


    public function enteteAction($locale)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->findOneBy(array('genre'=>'Entete', 'langue'=>$locale)); // ou findonebyslug

        if (!$page) throw $this->createNotFoundException('ENTETE EXISTE pas');

        return $this->render('PagesBundle:Default:pages/modulesUsed/entete.html.twig',array('page'=>$page) );
    }
}
