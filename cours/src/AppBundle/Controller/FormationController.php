<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\FormationType;
use AppBundle\Entity\Formation;

/**
 * @Route("/Formation")
 */
 
class FormationController extends Controller
{
    
    /**
     * @Route("/create", name="create_formation")
     * @Template()
     */
     
    public function createAction()
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        return array(
            'entity' => $formation,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/create_valid", name="validate_create_formation")
     * @Method("POST")
     */
     
    public function validateFormationAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($formation);
            $eManager->flush();
            
            return $this->redirectToRoute('homepage');
        }
        
        return $this->redirectToRoute(
            'create_formation', 
            array(
                'entity' => $formation,
                'form' => $form->createView(),
            )
        );
    }
    
    /**
     * @Route("/edit/{id}", name="edit_formation")
     * @Template()
     */
     
    public function editAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $formation = $eManager->getRepository("AppBundle:Formation")->FindOneBy(["id" => $id]);
        $form = $this->createForm(FormationType::class, $formation);
        
        return array(
            'entity' => $formation,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/edit_valid/{id}", name="validate_edit_formation")
     * @Method("POST")
     */
    public function validateEditFormationAction(Request $request, $id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $formation = $eManager->getRepository("AppBundle:Formation")->FindOneBy(["id" => $id]);
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager->persist($formation);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_formation', array(
            'entity' => $formation,
            'form' => $form->createView(),
        ));
    }
    
    
    /**
     * @Route("/remove/{id}", name="remove_formation")
     */
    public function removeFormationAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $formation = $eManager->getRepository("AppBundle:Formation")->FindOneBy(["id" => $id]);
        $eManager->remove($formation);
        $eManager->flush();
        return $this->redirectToRoute('homepage');
    }
}
