<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Formation;

class DefaultController extends Controller
{
    /**
     * @Route("/cours/{name}/{firstname}", name="homepage")
     * @Template()
     */
    public function indexAction($name= "Juliette", $firstname = "Cabal")
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Formation');
        $formations = $repo->findAll();
        
        $repo = $this->getDoctrine()->getRepository('AppBundle:Experience');
        $experiences = $repo->findAll();
        
        $repo = $this->getDoctrine()->getRepository('AppBundle:Loisirs');
        $loisirs = $repo->findAll();
        
        $repo = $this->getDoctrine()->getRepository('AppBundle:Competences');
        $competences = $repo->findAll();
        return array(
            'name' => $name,
            'firstname' => $firstname,
            'formations' => $formations,
            'experiences' => $experiences,
            'loisirs' => $loisirs,
            'competences' => $competences,
        );
    }
    
    
    /**
     * @Route("/create/formation", name="create_formation")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $form = new Formation();
        $form->setName("Ma formation");
        $form->setDateDebut(new \DateTime());
        $form->setDateFin(new \DateTime());
        $form->setLieu("Grenoble, France");
        
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($form);
        $eManager->flush();
        return array();
    }
}
