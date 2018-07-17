<?php

namespace MMBundle\Controller;

use MMBundle\Entity\SaleInvoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Saleinvoice controller.
 *
 * @Route("saleinvoice")
 */
class SaleInvoiceController extends Controller
{
    /**
     * Lists all saleInvoice entities.
     *
     * @Route("/", name="saleinvoice_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $saleInvoices = $em->getRepository('MMBundle:SaleInvoice')->findAll();

        return $this->render('saleinvoice/index.html.twig', array(
            'saleInvoices' => $saleInvoices,
        ));
    }

    /**
     * Creates a new saleInvoice entity.
     *
     * @Route("/new", name="saleinvoice_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $saleInvoice = new Saleinvoice();
        $form = $this->createForm('MMBundle\Form\SaleInvoiceType', $saleInvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($saleInvoice);
            $em->flush();

            return $this->redirectToRoute('saleinvoice_show', array('id' => $saleInvoice->getId()));
        }

        return $this->render('saleinvoice/new.html.twig', array(
            'saleInvoice' => $saleInvoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a saleInvoice entity.
     *
     * @Route("/{id}", name="saleinvoice_show")
     * @Method("GET")
     */
    public function showAction(SaleInvoice $saleInvoice)
    {
        $deleteForm = $this->createDeleteForm($saleInvoice);

        return $this->render('saleinvoice/show.html.twig', array(
            'saleInvoice' => $saleInvoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing saleInvoice entity.
     *
     * @Route("/{id}/edit", name="saleinvoice_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SaleInvoice $saleInvoice)
    {
        $deleteForm = $this->createDeleteForm($saleInvoice);
        $editForm = $this->createForm('MMBundle\Form\SaleInvoiceType', $saleInvoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('saleinvoice_edit', array('id' => $saleInvoice->getId()));
        }

        return $this->render('saleinvoice/edit.html.twig', array(
            'saleInvoice' => $saleInvoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a saleInvoice entity.
     *
     * @Route("/{id}", name="saleinvoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SaleInvoice $saleInvoice)
    {
        $form = $this->createDeleteForm($saleInvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($saleInvoice);
            $em->flush();
        }

        return $this->redirectToRoute('saleinvoice_index');
    }

    /**
     * Creates a form to delete a saleInvoice entity.
     *
     * @param SaleInvoice $saleInvoice The saleInvoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SaleInvoice $saleInvoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('saleinvoice_delete', array('id' => $saleInvoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
