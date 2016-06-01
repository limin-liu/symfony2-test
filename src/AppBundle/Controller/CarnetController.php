<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Carnet;




/**
 * Carnet controller.
 *
 * @Route("/carnet")
 */
class CarnetController extends Controller
{
    /**
     * Lists all Carnet entities.
     *
     * @Route("/", name="carnet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        //$user = $this->container->get('security.context')->getToken()->getUser();
        //$username=$user->getUsername();
        
        $em = $this->getDoctrine()->getManager();

        $carnets = $em->getRepository('AppBundle:Carnet')->findAll();   //findByUsername($username);

        return $this->render('carnet/index.html.twig', array(
            'carnets' => $carnets,
        ));
    }

    /**
     * Creates a new Carnet entity.
     *
     * @Route("/new", name="carnet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {   
        $user = $this->container->get('security.context')->getToken()->getUser();
        $username=$user->getUsername();
        
        $carnet= new Carnet;       
       
        $form = $this->createForm( 'AppBundle\Form\CarnetType', $carnet);
        $form->get('username')->setData($username); 
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {          
            $em = $this->getDoctrine()->getManager();
            $em->persist($carnet);
            $em->flush();

            return $this->redirectToRoute('carnet_show', array('id' => $carnet->getId()));
        }

        return $this->render('carnet/new.html.twig', array(
            'carnet' => $carnet,   
           
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Carnet entity.
     *
     * @Route("/{id}", name="carnet_show")
     * @Method("GET")
     */
    public function showAction(Carnet $carnet)
    {
        $deleteForm = $this->createDeleteForm($carnet);
        $user= $this->getUser();

        return $this->render('carnet/show.html.twig', array(
            'carnet' => $carnet,
            'user'=>$user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Carnet entity.
     *
     * @Route("/{id}/edit", name="carnet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Carnet $carnet)
    {
        $deleteForm = $this->createDeleteForm($carnet);
        $editForm = $this->createForm('AppBundle\Form\CarnetType', $carnet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carnet);
            $em->flush();

            return $this->redirectToRoute('carnet_index');
        }

        return $this->render('carnet/edit.html.twig', array(
            'carnet' => $carnet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Carnet entity.
     *
     * @Route("/{id}", name="carnet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Carnet $carnet)
    {
        $form = $this->createDeleteForm($carnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carnet);
            $em->flush();
        }

        return $this->redirectToRoute('carnet_index');
    }

    /**
     * Creates a form to delete a Carnet entity.
     *
     * @param Carnet $carnet The Carnet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Carnet $carnet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carnet_delete', array('id' => $carnet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
