<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        
        $em = $this->getDoctrine()->getManager();

        $bargains = $em->getRepository('AppBundle:Bargain')->findAll();
        
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'bargains' => $bargains,
        ));
    }
    /**
     * @Route("/pasze", name="pasze")
     */
    public function paszeAction(Request $request)
    {
        // replace this example code with whatever you need
        
        $em = $this->getDoctrine()->getManager();
        
        $bargains = $em->getRepository('AppBundle:Bargain')->findAll();
        
        return $this->render('default/pasze.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'bargains' => $bargains,
        ));
    }
    /**
     * @Route("/admin/", name="admin")
     */
    public function adminAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
    
}
