<?php

namespace TravelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use TravelBundle\Entity\Room;
use TravelBundle\Repository\HotelRepository;
use TravelBundle\Repository;


class DefaultController extends Controller
{
    /**
     * @Route("/travel")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm('TravelBundle\Form\SearchType');
        $form->handleRequest($request);
        $hotels = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
//            $nbRoom = $form['nbRoom']->getData();
//            $city = $form['city']->getData();
//            $stars = $form['stars']->getData();

            $hotels = $em->getRepository('TravelBundle:Hotel')->findByHotelAttributs($data['nbRoom'], $data['city'], $data['stars']);
        }

        return $this->render('TravelBundle:Default:index.html.twig', array(
            'hotels' => $hotels,
            'form' => $form->createView(),
        ));
    }

//    /**
//     * @Route("/listehotels", name="liste_hotels")
//     */
//    public function listeHotelsAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
////        Utiliser findAll avec un if dans le twif for pour ne trouver que les chambre sans réservations
////        $rooms = $em->getRepository('TravelBundle:Room')->findAll(array('id' => 'ASC'));
//
//        //        Récupère la liste des chambre sans reservation
//        $rooms = $em->getRepository('TravelBundle:Room')->findBy(array('book' => 0), array('id' => 'ASC'));
//
//        return $this->render('TravelBundle::liste.html.twig', array(
//            'rooms' => $rooms,
//        ));
//    }
}
