<?php

namespace TravelBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TravelBundle\Entity\Hotel;
use TravelBundle\Form\HotelType;

/**
 * Hotel controller.
 *
 * @Route("/hotel")
 */
class HotelController extends Controller
{
    /**
     * Lists all Hotel entities.
     *
     * @Route("/", name="hotel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hotels = $em->getRepository('TravelBundle:Hotel')->findAll();

        return $this->render('hotel/index.html.twig', array(
            'hotels' => $hotels,
        ));
    }

    /**
     * Creates a new Hotel entity.
     *
     * @Route("/new", name="hotel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hotel = new Hotel();
        $form = $this->createForm('TravelBundle\Form\HotelType', $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('hotel_show', array('id' => $hotel->getId()));
        }

        return $this->render('hotel/new.html.twig', array(
            'hotel' => $hotel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Hotel entity.
     *
     * @Route("/{id}", name="hotel_show")
     * @Method("GET")
     */
    public function showAction(Hotel $hotel)
    {
        $deleteForm = $this->createDeleteForm($hotel);

        return $this->render('hotel/show.html.twig', array(
            'hotel' => $hotel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Hotel entity.
     *
     * @Route("/{id}/edit", name="hotel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hotel $hotel)
    {
        $deleteForm = $this->createDeleteForm($hotel);
        $editForm = $this->createForm('TravelBundle\Form\HotelType', $hotel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('hotel_edit', array('id' => $hotel->getId()));
        }

        return $this->render('hotel/edit.html.twig', array(
            'hotel' => $hotel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Hotel entity.
     *
     * @Route("/{id}", name="hotel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hotel $hotel)
    {
        $form = $this->createDeleteForm($hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotel);
            $em->flush();
        }

        return $this->redirectToRoute('hotel_index');
    }

    /**
     * Creates a form to delete a Hotel entity.
     *
     * @param Hotel $hotel The Hotel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hotel $hotel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hotel_delete', array('id' => $hotel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
