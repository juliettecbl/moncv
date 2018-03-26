<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ExperienceType;
use AppBundle\Entity\Experience;

/**
 * @Route("/Experience")
 */
 
class ExperienceController extends Controller
{
    
    /**
     * @Route("/create", name="create_experience")
     * @Template()
     */
     
    public function createAction()
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        return array(
            'entity' => $experience,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/create_valid", name="validate_create_experience")
     * @Method("POST")
     */
     
    public function validateExperienceAction(Request $request)
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($experience);
            $eManager->flush();
            
            return $this->redirectToRoute('homepage');
        }
        
        return $this->redirectToRoute('create_experience', array(
            'entity' => $experience,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="edit_experience")
     * @Template()
     */
     
    public function editAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $experience = $eManager->getRepository("AppBundle:Experience")->FindOneBy(["id" => $id]);
        $form = $this->createForm(ExperienceType::class, $experience);
        
        return array(
            'entity' => $experience,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/edit_valid/{id}", name="validate_edit_experience")
     * @Method("POST")
     */
    public function validateEditExperienceAction(Request $request, $id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $experience = $eManager->getRepository("AppBundle:Experience")->FindOneBy(["id" => $id]);
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager->persist($experience);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_experience', array(
            'entity' => $experience,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/remove/{id}", name="remove_experience")
     */
    public function removeExperienceAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $experience = $eManager->getRepository("AppBundle:Experience")->FindOneBy(["id" => $id]);
        $eManager->remove($experience);
        $eManager->flush();
        return $this->redirectToRoute('homepage');
    }
}
