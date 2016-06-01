<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CC\UserBundle\Entity\User;


/**
 * User controller.
 *
 * @Route("/information")
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route("/", name="information_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('CCUserBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }
   
    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="information_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {  
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
             // success message
            $this->addFlash('notice', 'Informaiton Updated');

            return $this->redirectToRoute('information_index');
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),  
        ));
    }
}
