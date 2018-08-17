<?php

namespace MMBundle\Controller;

use MMBundle\Entity\Equimpment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MMBundle\Form\EquimpmentSearchType;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

/**
 * Equimpment controller.
 *
 * @Route("equimpment")
 */
class EquimpmentController extends Controller
{
    /**
     * Lists all equimpment entities.
     *
     * @Route("/", name="equimpment_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_PRACOWNIK')) {
            throw new \LogicException('This code should not be reached!');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new EquimpmentSearchType());
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $equimpment = $em->getRepository('MMBundle:Equimpment')->search($form);

            return $this->render('equimpment/index.html.twig', array(
                'equimpment' => $equimpment,
                'form' => $form->createView(),
            ));


        }



        $dql   = "SELECT a FROM MMBundle:Equimpment a";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');

        $equimpment = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10
        );

        return $this->render('equimpment/index.html.twig', array(
            'equimpment' => $equimpment,
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a new equimpment entity.
     *
     * @Route("/new", name="equimpment_new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request)
    {
        $equimpment = new Equimpment();
        $form = $this->createForm('MMBundle\Form\EquimpmentType', $equimpment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equimpment);
            $em->flush();

            return $this->redirectToRoute('equimpment_show', array('id' => $equimpment->getId()));
        }

        return $this->render('equimpment/new.html.twig', array(
            'equimpment' => $equimpment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equimpment entity.
     *
     * @Route("/{id}", name="equimpment_show")
     * @Method("GET")
     */
    public function showAction(Equimpment $equimpment)
    {
        $deleteForm = $this->createDeleteForm($equimpment);

        return $this->render('equimpment/show.html.twig', array(
            'equimpment' => $equimpment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equimpment entity.
     *
     * @Route("/{id}/edit", name="equimpment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Equimpment $equimpment)
    {
        $deleteForm = $this->createDeleteForm($equimpment);
        $editForm = $this->createForm('MMBundle\Form\EquimpmentType', $equimpment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equimpment_edit', array('id' => $equimpment->getId()));
        }

        return $this->render('equimpment/edit.html.twig', array(
            'equimpment' => $equimpment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equimpment entity.
     *
     * @Route("/{id}", name="equimpment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Equimpment $equimpment)
    {
        $form = $this->createDeleteForm($equimpment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equimpment);
            $em->flush();
        }

        return $this->redirectToRoute('equimpment_index');
    }

    /**
     * Creates a form to delete a equimpment entity.
     *
     * @param Equimpment $equimpment The equimpment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equimpment $equimpment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equimpment_delete', array('id' => $equimpment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
