<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pages\PagesBundle\Form\contactType;

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

    public function contactAction($locale)
    {
        $page= array('langue'=>$locale);

        $form = $this->createForm(new contactType());

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email
                $contact =  $form->getData();

                // echo $contact['contenu'];
                // envoi du mail qui dit que la commande est bein payé

                $message = \Swift_Message::newInstance()
                    ->setSubject('Nouveau contact sur ABCS.fr')
                    ->setFrom(array($contact['email']=>$contact['nom'].' '.$contact['prenom']))
                    //->setFrom(array("megustalapaella@club-internet.fr"=>$contact['nom'].' '.$contact['prenom']))
                    //->setTo($this->container->getParameter('mailer_user'))
                        ->setTo('david.gerard@ed-creatives.fr')

                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($contact['contenu'].'<br>'.$contact['telephone']);
                //->setBody($this->renderView('GitesBundle:Default:emails/validationCommande.html.twig',array('utilisateur'=>$commande->getUtilisateur())));

                $this->get('mailer')->send($message);


                // fin d mail
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page

                //$this->get('session')->getFlashBag()->add('success','<strong>Votre message a bien été envoyé !</strong><br> Nous y répondrons dans les plus brefs délais.<br> Merci pour votre confiance,<br>ABCS');
                return $this->redirectToRoute('home', array('locale' => $locale));
            }
        }

        return $this->render('PagesBundle:Default:Pages/layout/contact.html.twig', array(
            'form' => $form->createView(), 'page'=>$page
        ));


    }

    public function homeAction($locale)
    {
        //return $this->redirect($this->generateUrl('adminPages', array('locale' => 'fr')));

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
