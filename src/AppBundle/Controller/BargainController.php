<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Bargain;
use AppBundle\Form\BargainType;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Bargain controller.
 *
 * @Route("/admin/bargain")
 */
class BargainController extends Controller
{
    /**
     * Lists all Bargain entities.
     *
     * @Route("/", name="admin_bargain_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bargains = $em->getRepository('AppBundle:Bargain')->findAll();

        return $this->render('bargain/index.html.twig', array(
            'bargains' => $bargains,
        ));
    }

    /**
     * Creates a new Bargain entity.
     *
     * @Route("/new", name="admin_bargain_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bargain = new Bargain();
        $form = $this->createForm('AppBundle\Form\BargainType', $bargain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $bargain->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images'),
                $fileName
            );
            $bargain->setPhoto($fileName);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($bargain);
            $em->flush();

            return $this->redirectToRoute('admin_bargain_show', array('id' => $bargain->getId()));
        }

        return $this->render('bargain/new.html.twig', array(
            'bargain' => $bargain,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bargain entity.
     *
     * @Route("/{id}", name="admin_bargain_show")
     * @Method("GET")
     */
    public function showAction(Bargain $bargain)
    {
        $deleteForm = $this->createDeleteForm($bargain);

        return $this->render('bargain/show.html.twig', array(
            'bargain' => $bargain,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bargain entity.
     *
     * @Route("/{id}/edit", name="admin_bargain_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bargain $bargain)
    {
        $bargain->setPhoto(new File($this->getParameter('images').'/'.$bargain->getPhoto()));
        $deleteForm = $this->createDeleteForm($bargain);
        $editForm = $this->createForm('AppBundle\Form\BargainType', $bargain);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $file = $bargain->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images'),
                $fileName
            );
            $bargain->setPhoto($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($bargain);
            $em->flush();

            return $this->redirectToRoute('admin_bargain_edit', array('id' => $bargain->getId()));
        }

        return $this->render('bargain/edit.html.twig', array(
            'bargain' => $bargain,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Bargain entity.
     *
     * @Route("/{id}", name="admin_bargain_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bargain $bargain)
    {
        $form = $this->createDeleteForm($bargain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bargain);
            $em->flush();
        }

        return $this->redirectToRoute('admin_bargain_index');
    }

    /**
     * Creates a form to delete a Bargain entity.
     *
     * @param Bargain $bargain The Bargain entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bargain $bargain)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bargain_delete', array('id' => $bargain->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
}
