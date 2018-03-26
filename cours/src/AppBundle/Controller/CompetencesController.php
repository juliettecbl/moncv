<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CompetencesType;
use AppBundle\Entity\Competences;

/**
 * @Route("/Competences")
 */
 
class CompetencesController extends Controller
{
    
    /**
     * @Route("/create", name="create_competences")
     * @Template()
     */
     
    public function createAction()
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);
        return array(
            'entity' => $competences,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/create_valid", name="validate_create_competences")
     * @Method("POST")
     */
     
    public function validateCompetencesAction(Request $request)
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($competences);
            $eManager->flush();
            
            return $this->redirectToRoute('homepage');
        }
        
        return $this->redirectToRoute('create_competences', array(
            'entity' => $competences,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="edit_competences")
     * @Template()
     */
     
    public function editAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $competences = $eManager->getRepository("AppBundle:Competences")->FindOneBy(["id" => $id]);
        $form = $this->createForm(CompetencesType::class, $competences);
        
        return array(
            'entity' => $competences,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/edit_valid/{id}", name="validate_edit_competences")
     * @Method("POST")
     */
    public function validateEditCompetencesAction(Request $request, $id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $competences = $eManager->getRepository("AppBundle:Competences")->FindOneBy(["id" => $id]);
        $form = $this->createForm(CompetencesType::class, $competences);
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager->persist($competences);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_competences', array(
            'entity' => $competences,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/remove/{id}", name="remove_competences")
     */
    public function removeCompetencesAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $competences = $eManager->getRepository("AppBundle:Competences")->FindOneBy(["id" => $id]);
            $eManager->remove($competences);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
    }
}