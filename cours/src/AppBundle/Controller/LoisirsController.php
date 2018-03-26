<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\LoisirsType;
use AppBundle\Entity\Loisirs;

/**
 * @Route("/loisirs")
 */
 
class LoisirsController extends Controller
{
    
    /**
     * @Route("/create", name="create_loisirs")
     * @Template()
     */
     
    public function createAction()
    {
        $loisirs = new Loisirs();
        $form = $this->createForm(LoisirsType::class, $loisirs);
        return array(
            'entity' => $loisirs,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/create_valid", name="validate_create_loisirs")
     * @Method("POST")
     */
     
    public function validateLoisirsAction(Request $request)
    {
        $loisirs = new Loisirs();
        $form = $this->createForm(LoisirsType::class, $loisirs);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($loisirs);
            $eManager->flush();
            
            return $this->redirectToRoute('homepage');
        }
        
        return $this->redirectToRoute('create_loisirs', array(
            'entity' => $loisirs,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="edit_loisirs")
     * @Template()
     */
     
    public function editAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $loisirs = $eManager->getRepository("AppBundle:Loisirs")->FindOneBy(["id" => $id]);
        $form = $this->createForm(LoisirsType::class, $loisirs);
        
        return array(
            'entity' => $loisirs,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/edit_valid/{id}", name="validate_edit_loisirs")
     * @Method("POST")
     */
    public function validateEditLoisirsAction(Request $request, $id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $loisirs = $eManager->getRepository("AppBundle:Loisirs")->FindOneBy(["id" => $id]);
        $form = $this->createForm(LoisirsType::class, $loisirs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager->persist($loisirs);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_loisirs', array(
            'entity' => $loisirs,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/remove/{id}", name="remove_loisirs")
     */
    public function removeLoisirsAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $loisirs = $eManager->getRepository("AppBundle:Loisirs")->FindOneBy(["id" => $id]);
        $eManager->remove($loisirs);
        $eManager->flush();
        return $this->redirectToRoute('homepage');
    }
}
