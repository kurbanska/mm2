<?php

namespace MMBundle\Controller;

use MMBundle\Entity\Attedance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Attedance controller.
 *
 * @Route("attedance")
 */
class AttedanceController extends Controller
{
    /**
     * Lists all attedance entities.
     *
     * @Route("/", name="attedance_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attedances = $em->getRepository('MMBundle:Attedance')->findAll();

        return $this->render('attedance/index.html.twig', array(
            'attedances' => $attedances,
        ));
    }

    /**
     * Creates a new attedance entity.
     *
     * @Route("/new", name="attedance_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $attedance = new Attedance();
        $form = $this->createForm('MMBundle\Form\AttedanceType', $attedance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attedance);
            $em->flush();

            return $this->redirectToRoute('attedance_show', array('id' => $attedance->getId()));
        }

        return $this->render('attedance/new.html.twig', array(
            'attedance' => $attedance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a attedance entity.
     *
     * @Route("/{id}", name="attedance_show")
     * @Method("GET")
     */
    public function showAction(Attedance $attedance)
    {
        $deleteForm = $this->createDeleteForm($attedance);

        return $this->render('attedance/show.html.twig', array(
            'attedance' => $attedance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing attedance entity.
     *
     * @Route("/{id}/edit", name="attedance_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Attedance $attedance)
    {
        $deleteForm = $this->createDeleteForm($attedance);
        $editForm = $this->createForm('MMBundle\Form\AttedanceType', $attedance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attedance_edit', array('id' => $attedance->getId()));
        }

        return $this->render('attedance/edit.html.twig', array(
            'attedance' => $attedance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attedance entity.
     *
     * @Route("/{id}", name="attedance_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Attedance $attedance)
    {
        $form = $this->createDeleteForm($attedance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attedance);
            $em->flush();
        }

        return $this->redirectToRoute('attedance_index');
    }

    /**
     * Creates a form to delete a attedance entity.
     *
     * @param Attedance $attedance The attedance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attedance $attedance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attedance_delete', array('id' => $attedance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
