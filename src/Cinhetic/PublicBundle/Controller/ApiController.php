<?php

namespace Cinhetic\PublicBundle\Controller;

use Guzzle\Http\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Api controller.
 * Using Guzzle HTTP Frameworks
 *
 */
class ApiController extends Controller
{

    /**
     * @var \AlloHelper
     */
    protected $helper;

    /**
     * Constructor of APIController
     */
    public function __construct(){
        $this->helper = new \AlloHelper;
    }

    /**
     * Lists all Movies using API Allocine
     */
    public function indexAction()
    {
        $movies = $this->helper->movielist();

//        exit(var_dump($movies['movie']));
        return $this->render('CinheticPublicBundle:Api:index.html.twig', array(
            'movies' => $movies['movie'],
        ));
    }

    /**
     * Search Movies by word using API Allocine
     */
    public function searchAction()
    {
        $request = $this->get('request');
        $word = $request->query->get('search');
        $ajax = $request->query->get('ajax');

        
        $movies = $this->helper->search($word);

        if(!$ajax){
            if(isset($movies['movie']) && is_object($movies['movie'])){
    //            exit(var_dump($movies['movie']->getArray()));
                $movies =  $movies['movie']->getArray();
            }
            return $this->render('CinheticPublicBundle:Api:search.html.twig', array(
                'movies' => $movies
            ));
        }else{

            $results_final = array();
            if (!empty($movies))
                if(isset($movies['movie']) && is_object($movies['movie'])){
                    foreach ($movies['movie'] as $movie)
                    $results_final[] = array(
                        'nom' => utf8_encode($movie['originalTitle'])
                    );
                }
//            exit(var_dump($results_final));
            return new JsonResponse($results_final);
        }
    }


    /**
     * Show a movie using API Allocine
     */
    public function showAction($code = null)
        {
           $profile = 'long';
            $movie = $this->helper->movie($code, $profile );
//            exit(var_dump($movie));

            return $this->render('CinheticPublicBundle:Api:show.html.twig', array(
                'entity' => $movie,
            ));
        }



    /**
     * Show a movie using API Allocine
     */
    public function actorAction($code = null)
        {
           $profile = 'long';
            $actor = $this->helper->person($code, $profile);
//            exit(var_dump($actor));

            return $this->render('CinheticPublicBundle:Api:actor.html.twig', array(
                'entity' => $actor,
                'movies' => $actor['participation']->getArray()
            ));
        }



    /**
     * Show a movie using API Allocine
     */
    public function filmographyAction($code = null)
        {
           $profile = 'long';
           $filmography = $this->helper->filmography($code, $profile);
//            exit(var_dump($filmography['participation'][2]['movie']['originalTitle']));

            return $this->render('CinheticPublicBundle:Api:filmography.html.twig', array(
                'entity' => $filmography,
                'movies' => $filmography['participation']->getArray()
            ));
        }



    /**
     * All cinemas using API Allocine
     */
    public function cinemasAction($zipcode = "75000")
        {
            $cinemas = $this->helper->showtimesByZip($zipcode);
//            exit(var_dump($cinemas));

            return $this->render('CinheticPublicBundle:Api:cinemas.html.twig', array(
                'cinemas' => $cinemas['theaterShowtimes']->getArray(),
            ));
        }



    /**
     * All cinemas using API Allocine
     */
    public function cinemasyPositionAction($long = null, $lat = null)
        {
            $profile = 'long';
            $actor = $this->helper->showtimesByPosition(12.5655,12.3532, $profile);

            return $this->render('CinheticPublicBundle:Api:actor.html.twig', array(
                'entity' => $actor,
            ));

           /* $client = $this->get('guzzle.client');

            $req = $client->get('http://api.allocine.fr/rest/v3/showtimelist?code=61282&partner=yW5kcm9pZC12M3M');
            $response = $req->send();
            $status = $response->getStatusCode();
            $cinemas = json_decode($response->getBody(), true);
            exit(var_dump($response->getBody()));
            */
            return $this->render('CinheticPublicBundle:Api:cinemas.html.twig', array(
                'movies' => $cinemas["feed"]['movie'],
            ));
        }



    /**
     * All cinemas using API Allocine
     */
    public function cinemasyZipAction($zipcode=  null)
        {

            $profile = 'long';
            $actor = $this->helper->showtimesByZip(75002, $profile);

            return $this->render('CinheticPublicBundle:Api:actor.html.twig', array(
                'entity' => $actor,
            ));

           /* $client = $this->get('guzzle.client');

            $req = $client->get('http://api.allocine.fr/rest/v3/showtimelist?code=61282&partner=yW5kcm9pZC12M3M');
            $response = $req->send();
            $status = $response->getStatusCode();
            $cinemas = json_decode($response->getBody(), true);
            exit(var_dump($response->getBody()));
            */
            return $this->render('CinheticPublicBundle:Api:cinemas.html.twig', array(
                'movies' => $cinemas["feed"]['movie'],
            ));
        }


}
