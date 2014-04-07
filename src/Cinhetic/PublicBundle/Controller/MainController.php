<?php

namespace Cinhetic\PublicBundle\Controller;

use Doctrine\Common\Util\Debug;
use Cinhetic\PublicBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class MainController extends Controller
{
    /**
     * Main Dashboard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
        $movies = $em->getRepository('CinheticPublicBundle:Movies')->findAll();

        $pagination = $paginator->paginate(
            $movies,
            $this->get('request')->query->get('pageone', 1) /*page number*/,
            5,
            array('pageParameterName' => 'pageone')
        );

        return $this->render('CinheticPublicBundle:Main:index.html.twig',  array('movies' => $pagination));

    }

   /**
     * Search Action in AJAX or HTTP
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction()
    {
        $form = $this->createForm(new SearchType(), null, array(
            'action' => $this->generateUrl('Cinhetic_public_search'),
            'method' => 'GET',
        ));

        $form->add('submit', 'submit', array("attr" => array('class' => "btn btn-warning"), 'label' => 'Rechercher'));


        return $this->render('CinheticPublicBundle:Main:search.html.twig',
            array('form' => $form->createView())
        );
    }



    /**
     * Login Authentification
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render('CinheticPublicBundle:Main:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

}