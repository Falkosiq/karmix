<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\offer;
use AppBundle\Form\offerType;
use Symfony\Component\HttpFoundation\File\File;

/**
 * offer controller.
 *
 */
class offerController extends Controller
{
    /**
     * Lists all offer entities.
     *
     * @Route("/admin/offer/index/{category}", name="admin_offer_index")
     * @Method("GET")
     */
    public function indexAction($category)
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('AppBundle:offer')->findBy(
                    array('category' => $category)
                );

        return $this->render('offer/index.html.twig', array(
            'offers' => $offers,
        ));
    }

    /**
     * Creates a new offer entity.
     *
     * @Route("/admin/offer/new", name="admin_offer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $offer = new offer();
        $form = $this->createForm('AppBundle\Form\offerType', $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $offer->getPhoto1();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('images'),
                    $fileName
                );
                $offer->setPhoto1($fileName);
            }
            $file = $offer->getPhoto2();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('images'),
                    $fileName
                );
                $offer->setPhoto2($fileName);
            }
            
            $file = $offer->getPhoto3();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('images'),
                    $fileName
                );
                $offer->setPhoto3($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('admin_offer_show', array('id' => $offer->getId()));
        }

        return $this->render('offer/new.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a offer entity.
     *
     * @Route("/admin/offer/{id}", name="admin_offer_show")
     * @Method("GET")
     */
    public function showAction(offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);

        return $this->render('offer/show.html.twig', array(
            'offer' => $offer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing offer entity.
     *
     * @Route("/admin/offer/{id}/edit", name="admin_offer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, offer $offer)
    {
        /*$offer->setPhoto1(new File($this->getParameter('images').'/'.$offer->getPhoto1()));
        $offer->setPhoto2(new File($this->getParameter('images').'/'.$offer->getPhoto2()));
        $offer->setPhoto3(new File($this->getParameter('images').'/'.$offer->getPhoto3()));*/
        $deleteForm = $this->createDeleteForm($offer);
        $editForm = $this->createForm('AppBundle\Form\offerType', $offer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $file = $offer->getPhoto1();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('images'),
                    $fileName
                );
                $offer->setPhoto1($fileName);
            }
            $file = $offer->getPhoto2();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('images'),
                    $fileName
                );
                $offer->setPhoto2($fileName);
            }
            $file = $offer->getPhoto3();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('images'),
                    $fileName
                );
                $offer->setPhoto3($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('admin_offer_edit', array('id' => $offer->getId()));
        }

        return $this->render('offer/edit.html.twig', array(
            'offer' => $offer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offer entity.
     *
     * @Route("/admin/offer/{id}", name="admin_offer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, offer $offer)
    {
        $form = $this->createDeleteForm($offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush();
        }

        return $this->redirectToRoute('admin_offer_index');
    }

    /**
     * Creates a form to delete a offer entity.
     *
     * @param offer $offer The offer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(offer $offer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_offer_delete', array('id' => $offer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Lists offer entities by category.
     *
     * @Route("/offer/{category}", name="offer_list")
     * @Method("GET")
     */
    public function listAction($category)
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('AppBundle:offer')->findBy(
                    array('category' => $category)
                );

        return $this->render('offer/list.html.twig', array(
            'offers' => $offers,
        ));
    }
    
    /**
     * Finds and displays a offer entity.
     *
     * @Route("/offer/display/{id}", name="offer_display")
     * @Method("GET")
     */
    public function displayAction(offer $offer)
    {
        return $this->render('offer/display.html.twig', array(
            'offer' => $offer,
        ));
    }
}
